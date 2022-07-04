<?php

use App\Http\Controllers\Admin\CategoriesController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;

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
    Route::get('categories-check-slug', [CategoriesController::class, 'checkSlug'])->name('categories-check-slug');

});

require __DIR__.'/auth.php';
