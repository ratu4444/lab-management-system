<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\SettingsController;

Route::middleware('auth')->group(function () {
//  CLIENT DASHBOARD
    Route::get('project/dashboard', [DashboardController::class, 'clientIndex'])->name('dashboard.client-index'); // client dashboard

    Route::get('/dashboard', function () {
        return redirect()->route('dashboard.index');
    });

    Route::middleware('auth.admin')->group(function () {
//      ADMIN DASHBOARD
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

//      PROJECT
        Route::resource('project', ProjectController::class);
        Route::prefix('project/{project_id}')->group(function () {
//          TASK
            Route::resource('task', TaskController::class);
//          PAYMENT
            Route::resource('payment', PaymentController::class);
//          INSPECTION
            Route::resource('inspection', InspectionController::class);
        });

//      SETTINGS
        Route::prefix('settings')->group(function () {
//          SETTINGS TASK
            Route::post('task/store', [SettingsController::class, 'taskStore'])->name('settings.task.store');
            Route::get('task/show', [SettingsController::class, 'taskShow'])->name('settings.task.show');
//          SETTINGS PAYMENTS
            Route::post('payment/store', [SettingsController::class, 'paymentStore'])->name('settings.payment.store');
            Route::get('payment/show', [SettingsController::class, 'paymentShow'])->name('settings.payment.show');
//          SETTINGS INSPECTION
            Route::post('inspection/store', [SettingsController::class, 'inspectionStore'])->name('settings.inspection.store');
            Route::get('inspection/show', [SettingsController::class, 'inspectionShow'])->name('settings.inspection.show');
//          SETTINGS ELEMENT
            Route::get('element/show',[SettingsController::class, 'elementShow'])->name('settings.element');

        });

//      CLIENT
        Route::resource('client', ClientController::class);
    });
});

require __DIR__.'/auth.php';

Route::get('register', function () {
    return redirect()->route('login');
});
