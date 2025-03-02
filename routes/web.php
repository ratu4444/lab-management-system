<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ControlCenterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ReportController;

Route::middleware('auth')->group(function () {
//  CLIENT DASHBOARD
    Route::get('project/dashboard', [DashboardController::class, 'clientIndex'])->name('dashboard.client-index'); // client dashboard

    Route::get('/dashboard', function () {
        return redirect()->route('dashboard.admin-index');
    });

    Route::middleware('auth.superadmin')->prefix('control')->name('control.')->group(function () {
        Route::get('/', [ControlCenterController::class, 'index'])->name('index');
        Route::resource('admin', AdminController::class);

        Route::get('admin/{admin_id}/researcher', [ControlCenterController::class, 'researcherIndex'] )->name('researcher.index');

    });

//      PROJECT
    Route::resource('project', ProjectController::class);

//  Task
    Route::prefix('project/{project_id}')->group(function () {
        Route::resource('task', TaskController::class);
        Route::resource('report', ReportController::class);

    });


    Route::middleware('auth.admin')->group(function () {
//      ADMIN DASHBOARD
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.admin-index');

        Route::prefix('project/{project_id}')->group(function () {
//          TASK
            Route::get('default-task', [ProjectController::class, 'defaultTask'])->name('project.default-task');
            Route::post('default-task', [ProjectController::class, 'defaultTaskStore'])->name('project.default-task.store');
            Route::post('report/{report_id}/toggle-visibility', [ReportController::class, 'toggleVisibility'])->name('report.toggle-visibility');
        });


//      SETTINGS
        Route::prefix('settings')->name('settings.')->group(function () {
//          SETTINGS TASK
            Route::post('task/store', [SettingsController::class, 'taskStore'])->name('task.store');
            Route::get('task/show', [SettingsController::class, 'taskShow'])->name('task.show');
            Route::get('task/{default_task_id}/edit', [SettingsController::class, 'taskEdit'])->name('task.edit');
            Route::put('task/{default_task_id}/update', [SettingsController::class, 'taskUpdate'])->name('task.update');
});

//      CLIENT
        Route::resource('client', ClientController::class);
});

    Route::middleware('auth.client')->prefix('client-project/{project_id}')->name('client-project.')->group(function () {
        Route::put('update-status', [ProjectController::class, 'clientUpdateStatus'])->name('update-status');
        Route::post('store-report', [ReportController::class, 'clientStore'])->name('report.store');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('edit', [ControlCenterController::class, 'editProfile'])->name('edit');
        Route::put('update', [ControlCenterController::class, 'updateProfile'])->name('update');
    });
});

require __DIR__.'/auth.php';

Route::get('register', function () {
    return redirect()->route('login');
});
