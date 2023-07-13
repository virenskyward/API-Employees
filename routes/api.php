<?php

use App\Http\Controllers\Api\CashAdvanceSettingController;
use App\Http\Controllers\Api\PayrollSettingController;
use App\Http\Controllers\Api\PermissionActionController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PermissionModuleController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware(['auth:api'])->group(function () {

Route::group(['prefix' => 'user'], function () {
    Route::post('/list', [UserController::class, 'list'])->name('user.list');
    Route::post('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::group(['prefix' => 'role'], function () {
    Route::get('/list', [RoleController::class, 'list'])->name('role.list');
    Route::post('/create', [RoleController::class, 'create'])->name('role.create');
    Route::put('/update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/delete/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
});

Route::group(['prefix' => 'cash-advance-setting'], function () {
    Route::get('/list', [CashAdvanceSettingController::class, 'list'])->name('cash.advance.setting.list');
    Route::post('/create', [CashAdvanceSettingController::class, 'create'])->name('cash.advance.setting.create');
    Route::post('/update', [CashAdvanceSettingController::class, 'update'])->name('cash.advance.setting.update');
    Route::delete('/delete/{id}', [CashAdvanceSettingController::class, 'destroy'])->name('cash.advance.setting.destroy');
});

Route::group(['prefix' => 'permission'], function () {

    Route::post('/list', [PermissionController::class, 'list'])->name('permission.list');
    Route::post('/create', [PermissionController::class, 'create'])->name('permission.create');

    Route::group(['prefix' => 'module'], function () {
        Route::post('/list', [PermissionModuleController::class, 'list'])->name('permission.module.list');
        Route::post('/create', [PermissionModuleController::class, 'create'])->name('permission.module.create');
        Route::post('/update/{id}', [PermissionModuleController::class, 'update'])->name('permission.module.update');
        Route::delete('/delete/{id}', [PermissionModuleController::class, 'destroy'])->name('permission.module.destroy');
    });

    Route::group(['prefix' => 'action'], function () {
        Route::post('/list', [PermissionActionController::class, 'list'])->name('permission.action.list');
        Route::post('/create', [PermissionActionController::class, 'create'])->name('permission.action.create');
        Route::post('/update/{id}', [PermissionActionController::class, 'update'])->name('permission.action.update');
        Route::delete('/delete/{id}', [PermissionActionController::class, 'destroy'])->name('permission.action.destroy');
    });

});

Route::group(['prefix' => 'payroll-setting'], function () {
    Route::get('/list', [PayrollSettingController::class, 'list'])->name('payroll.setting.list');
    Route::post('/create', [PayrollSettingController::class, 'create'])->name('payroll.setting.create');
    Route::post('/update', [PayrollSettingController::class, 'update'])->name('payroll.setting.update');
    Route::delete('/delete/{id}', [PayrollSettingController::class, 'destroy'])->name('payroll.setting.destroy');
});
// });