<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Size;
use App\Models\Color;

/* Admin breadcrumbs */

// Dashboard
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('admin.dashboard'));
});

// Roles Index
Breadcrumbs::for('admin.roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Roles', route('admin.roles.index'));
});

// Roles Create
Breadcrumbs::for('admin.roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.roles.index');
    $trail->push('Create Role', route('admin.roles.create'));
});

// Roles Edit
Breadcrumbs::for('admin.roles.edit', function (BreadcrumbTrail $trail, Role $role) {
    $trail->parent('admin.roles.index');
    $trail->push('Edit Role', route('admin.roles.edit', $role->id));
});

// Users Index
Breadcrumbs::for('admin.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Users', route('admin.users.index'));
});

// Users Create
Breadcrumbs::for('admin.users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.users.index');
    $trail->push('Create User', route('admin.users.create'));
});

// Users Edit
Breadcrumbs::for('admin.users.edit', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('admin.users.index');
    $trail->push('Edit User', route('admin.users.edit', $user->id));
});

// Categories Index
Breadcrumbs::for('admin.categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Categories', route('admin.categories.index'));
});

// Categories Create
Breadcrumbs::for('admin.categories.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.categories.index');
    $trail->push('Create Category', route('admin.categories.create'));
});

// Categories Edit
Breadcrumbs::for('admin.categories.edit', function (BreadcrumbTrail $trail, Category $category) {
    $trail->parent('admin.categories.index');
    $trail->push('Edit Category', route('admin.categories.edit', $category->id));
});

// Brands Index
Breadcrumbs::for('admin.brands.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Brands', route('admin.brands.index'));
});

// Brands Create
Breadcrumbs::for('admin.brands.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.brands.index');
    $trail->push('Create Brand', route('admin.brands.create'));
});

// Brands Edit
Breadcrumbs::for('admin.brands.edit', function (BreadcrumbTrail $trail, Brand $brand) {
    $trail->parent('admin.brands.index');
    $trail->push('Edit Brand', route('admin.brands.edit', $brand->id));
});

// Sizes Index
Breadcrumbs::for('admin.sizes.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Sizes', route('admin.sizes.index'));
});

// Sizes Create
Breadcrumbs::for('admin.sizes.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.sizes.index');
    $trail->push('Create Size', route('admin.sizes.create'));
});

// Sizes Edit
Breadcrumbs::for('admin.sizes.edit', function (BreadcrumbTrail $trail, Size $size) {
    $trail->parent('admin.sizes.index');
    $trail->push('Edit Size', route('admin.sizes.edit', $size->id));
});

// Colors Index
Breadcrumbs::for('admin.colors.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Colors', route('admin.colors.index'));
});

// Colors Create
Breadcrumbs::for('admin.colors.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.colors.index');
    $trail->push('Create Color', route('admin.colors.create'));
});

// Colors Edit
Breadcrumbs::for('admin.colors.edit', function (BreadcrumbTrail $trail, Color $color) {
    $trail->parent('admin.colors.index');
    $trail->push('Edit Color', route('admin.colors.edit', $color->id));
});