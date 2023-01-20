<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

// Auth

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Dashboard

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// Users

Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('auth');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');

// Organizations

Route::get('organizations', [OrganizationsController::class, 'index'])
    ->name('organizations')
    ->middleware('auth');

Route::get('organizations/create', [OrganizationsController::class, 'create'])
    ->name('organizations.create')
    ->middleware('auth');

Route::post('organizations', [OrganizationsController::class, 'store'])
    ->name('organizations.store')
    ->middleware('auth');

Route::get('organizations/{organization}/edit', [OrganizationsController::class, 'edit'])
    ->name('organizations.edit')
    ->middleware('auth');

Route::put('organizations/{organization}', [OrganizationsController::class, 'update'])
    ->name('organizations.update')
    ->middleware('auth');

Route::delete('organizations/{organization}', [OrganizationsController::class, 'destroy'])
    ->name('organizations.destroy')
    ->middleware('auth');

Route::put('organizations/{organization}/restore', [OrganizationsController::class, 'restore'])
    ->name('organizations.restore')
    ->middleware('auth');

// Contacts

Route::get('contacts', [ContactsController::class, 'index'])
    ->name('contacts')
    ->middleware('auth');

Route::get('contacts/create', [ContactsController::class, 'create'])
    ->name('contacts.create')
    ->middleware('auth');

Route::post('contacts', [ContactsController::class, 'store'])
    ->name('contacts.store')
    ->middleware('auth');

Route::get('contacts/{contact}/edit', [ContactsController::class, 'edit'])
    ->name('contacts.edit')
    ->middleware('auth');

Route::put('contacts/{contact}', [ContactsController::class, 'update'])
    ->name('contacts.update')
    ->middleware('auth');

Route::delete('contacts/{contact}', [ContactsController::class, 'destroy'])
    ->name('contacts.destroy')
    ->middleware('auth');

Route::put('contacts/{contact}/restore', [ContactsController::class, 'restore'])
    ->name('contacts.restore')
    ->middleware('auth');

// Customers
Route::get('customers', [CustomerController::class, 'index'])
    ->name('customers')
    ->middleware('auth');

Route::get('customers/create', [CustomerController::class, 'create'])
    ->name('customers.create')
    ->middleware('auth');

Route::post('customers', [CustomerController::class, 'store'])
    ->name('customers.store')
    ->middleware('auth');

Route::get('customers/{customer}/edit', [CustomerController::class, 'edit'])
    ->name('customers.edit')
    ->middleware('auth');

Route::put('customers/{customer}', [CustomerController::class, 'update'])
    ->name('customers.update')
    ->middleware('auth');

Route::delete('customers/{customer}', [CustomerController::class, 'destroy'])
    ->name('customers.destroy')
    ->middleware('auth');

Route::put('customers/{customer}/restore', [CustomerController::class, 'restore'])
    ->name('customers.restore')
    ->middleware('auth');

//Projects
Route::get('projects', [ProjectController::class, 'index'])
    ->name('projects')
    ->middleware('auth');

Route::get('projects/create', [ProjectController::class, 'create'])
    ->name('projects.create')
    ->middleware('auth');

Route::post('projects', [ProjectController::class, 'store'])
    ->name('projects.store')
    ->middleware('auth');

Route::get('projects/{project}/edit', [ProjectController::class, 'edit'])
    ->name('projects.edit')
    ->middleware('auth');

Route::put('projects/{project}', [ProjectController::class, 'update'])
    ->name('projects.update')
    ->middleware('auth');

Route::delete('projects/{project}', [ProjectController::class, 'destroy'])
    ->name('projects.destroy')
    ->middleware('auth');

Route::put('projects/{project}/restore', [ProjectController::class, 'restore'])
    ->name('projects.restore')
    ->middleware('auth');

//Tasks
Route::get('tasks', [TaskController::class, 'index'])
    ->name('tasks')
    ->middleware('auth');

Route::get('tasks/create', [TaskController::class, 'create'])
    ->name('tasks.create')
    ->middleware('auth');

Route::post('tasks', [TaskController::class, 'store'])
    ->name('tasks.store')
    ->middleware('auth');

Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])
    ->name('tasks.edit')
    ->middleware('auth');

Route::put('tasks/{task}', [TaskController::class, 'update'])
    ->name('tasks.update')
    ->middleware('auth');

Route::delete('tasks/{task}', [TaskController::class, 'destroy'])
    ->name('tasks.destroy')
    ->middleware('auth');

Route::put('tasks/{task}/restore', [TaskController::class, 'restore'])
    ->name('tasks.restore')
    ->middleware('auth');


// Reports

Route::get('reports', [ReportsController::class, 'index'])
    ->name('reports')
    ->middleware('auth');

// Images

Route::get('/img/{path}', [ImagesController::class, 'show'])
    ->where('path', '.*')
    ->name('image');
