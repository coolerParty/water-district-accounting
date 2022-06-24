<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Livewire\AccountChart\AccountChartAddComponent;
use App\Http\Livewire\AccountChart\AccountChartComponent;
use App\Http\Livewire\AccountChart\AccountChartEditComponent;
use App\Http\Livewire\AccountGroup\AccountGroupAddComponent;
use App\Http\Livewire\AccountGroup\AccountGroupComponent;
use App\Http\Livewire\AccountGroup\AccountGroupEditComponent;
use App\Http\Livewire\BeginningBalance\BeginningBalanceComponent;
use App\Http\Livewire\ChangePasswordComponent;
use App\Http\Livewire\ProfileComponent;
use App\Http\Livewire\Users\UserAddComponent;
use App\Http\Livewire\Users\UserComponent;
use App\Http\Livewire\Users\UserEditComponent;
// use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified', 'role_or_permission:super-admin|dashboard-access'])
->group(function () {


    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    // Route::resource('users', UserController::class);

    Route::get('/users', UserComponent::class)->name('users.index');
    Route::get('/users/create', UserAddComponent::class)->name('users.create');
    Route::get('/users/{user_id}/edit', UserEditComponent::class)->name('users.edit');

    Route::get('/profile', ProfileComponent::class)->name('profile');
    Route::get('/password', ChangePasswordComponent::class)->name('password');

    Route::get('/account-group', AccountGroupComponent::class)->name('accountgroup.index');
    Route::get('/account-group/create', AccountGroupAddComponent::class)->name('accountgroup.create');
    Route::get('/account-group/{id}/edit', AccountGroupEditComponent::class)->name('accountgroup.edit');

    Route::get('/account-chart', AccountChartComponent::class)->name('accountchart.index');
    Route::get('/account-chart/create', AccountChartAddComponent::class)->name('accountchart.create');
    Route::get('/account-chart/{id}/edit', AccountChartEditComponent::class)->name('accountchart.edit');

    Route::get('/beginning-balance', BeginningBalanceComponent::class)->name('beginningbalance.index');


});
