<?php

use App\Http\Controllers\CheckInCheckOutController;
use App\Models\Department;
use Laragear\WebAuthn\WebAuthn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CompanySettingController;




// Auth::routes();
Auth::routes(['register' => false]);

WebAuthn::routes();

Route::get('checkin-checkout', [CheckInCheckOutController::class, 'CheckInCheckOut']);

Route::controller(PageController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'home')->name('home');
    });

Route::controller(ProfileController::class)
    ->middleware('auth')
    ->group(function () {
        Route::get('profile', 'profile')->name('profile');
        Route::get('profile/biometric-data', 'biometricDataRender');
        Route::delete('profile/biometric-data/{id}', 'biometricDataDestroy');
    });

Route::resource('employees', EmployeeController::class)->middleware('auth');

Route::resource('department', DepartmentController::class)->middleware('auth');

Route::resource('role', RoleController::class)->middleware('auth');

Route::resource('permission', PermissionController::class)->middleware('auth');

Route::resource('company-setting', CompanySettingController::class)
    ->only(['edit', 'update', 'show'])
    ->middleware('auth');
