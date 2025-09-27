<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GeneralSettingsController;
use App\Http\Controllers\Admin\LoanManagementController;
use App\Http\Controllers\Admin\LoanPlanController;
use App\Http\Controllers\Admin\LoanTypeController;
use App\Http\Controllers\Admin\PartyMasterController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\AdminAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/pass', function () {
    dd(Hash::make('123456'));
});
Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('home');
Route::get('coming-soon', function () {
    return view('errors.coming-soon');
});


Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    Toastr::success('Cache cleared successfully!', 'Success');
    return back();
})->name('clear.cache');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.auth');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

});

Route::middleware([IsAdmin::class, 'maintenance.bypass'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::post('user/status_enable_disable', [UsersController::class, 'status_enable_disable'])
        ->name('user.status_enable_disable')
        ->middleware('permission:edit-user'); // or change-status if you have it

    Route::post('user/delete', [UsersController::class, 'destroyUser'])
        ->name('user.delete')
        ->middleware('permission:delete-user');

    Route::resource('users', UsersController::class);

    Route::resource('roles', RoleController::class);

    Route::post('roles/delete', [RoleController::class, 'destroyRole'])
        ->name('roles.delete');

    Route::post('roles/status_enable_disable', [RoleController::class, 'status_enable_disable'])
        ->name('roles.status_enable_disable');

    Route::resource('permissions', PermissionController::class);
});



Route::group(['middleware' => ['isAdmin', 'maintenance.bypass'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/party-master', [PartyMasterController::class, 'index'])->name('party-master.index');
    Route::get('/party-master/create', [PartyMasterController::class, 'create'])->name('party-master.create');
    Route::post('/party-master/store', [PartyMasterController::class, 'store'])->name('party-master.store');
    Route::get('/party-master/edit/{id}', [PartyMasterController::class, 'edit'])->name('party-master.edit');


    Route::get('daily-loans', [LoanManagementController::class, 'index'])->name('daily.loans');
    Route::get('daily-loans/create', [LoanManagementController::class, 'create'])->name('daily.loans.create');
    Route::post('daily-loans/store', [LoanManagementController::class, 'create'])->name('daily.loans.store');
    Route::post('daily-loans/update', [LoanManagementController::class, 'create'])->name('daily.loans.update');

    Route::resource('generalsettings', GeneralSettingsController::class)->names('generalsettings');

});

