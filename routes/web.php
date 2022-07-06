<?php

use App\Http\Controllers\Admin\CategoriesController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\ColorsController;
use App\Http\Controllers\Admin\SizesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Manage Roles
    Route::resource('roles', RolesController::class);

    // Manage Users
    Route::resource('users', UsersController::class);
    Route::get('/users-data', [UsersController::class, 'getData'])->name('users-data');
    Route::post('/users/{id}/password', [UsersController::class, 'changePassword'])->name('users-change-password');
    
    // Manage Categories
    Route::resource('categories', CategoriesController::class);
    Route::get('categories-data', [CategoriesController::class, 'getData'])->name('categories-data');
    Route::get('categories-check-slug', [CategoriesController::class, 'checkSlug'])->name('categories-check-slug');

    // Manage Brands
    Route::resource('brands', BrandsController::class);
    Route::get('brands-data', [BrandsController::class, 'getData'])->name('brands-data');
    Route::get('brands-check-slug', [BrandsController::class, 'checkSlug'])->name('brands-check-slug');

    // Manage Sizes
    Route::resource('sizes', SizesController::class);
    Route::get('sizes-data', [SizesController::class, 'getData'])->name('sizes-data');
    Route::get('sizes-check-slug', [SizesController::class, 'checkSlug'])->name('sizes-check-slug');

    // Manage Colors
    Route::resource('colors', ColorsController::class);
    Route::get('colors-data', [ColorsController::class, 'getData'])->name('colors-data');
    Route::get('colors-check-slug', [ColorsController::class, 'checkSlug'])->name('colors-check-slug');

});

require __DIR__.'/auth.php';
