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

        Route::prefix('project')->group(function () {
//          PROJECT
            Route::get('', [ProjectController::class, 'index'])->name('project.index');
            Route::get('create', [ProjectController::class, 'create'])->name('project.create');
            Route::post('', [ProjectController::class, 'store'])->name('project.store');
            Route::get('{project_id}', [ProjectController::class, 'show'])->name('project.show');
            Route::get('{project_id}/edit', [ProjectController::class, 'edit'])->name('project.edit');
            Route::post('{project_id}/update', [ProjectController::class, 'update'])->name('project.update');
//          TASK
            Route::get('{project_id}/task/create', [TaskController::class, 'create'])->name('task.create');
            Route::post('{project_id}/task', [TaskController::class, 'store'])->name('task.store');
            Route::get('task/{task_id}/edit', [TaskController::class, 'edit'])->name('task.edit');
            Route::post('task/{task_id}/update', [TaskController::class, 'update'])->name('task.update');
//          PAYMENT
            Route::get('{project_id}/payment/create', [PaymentController::class, 'create'])->name('payment.create');
            Route::post('{project_id}/payment', [PaymentController::class, 'store'])->name('payment.store');
            Route::get('payment/{payment_id}/edit', [PaymentController::class, 'edit'])->name('payment.edit');
            Route::post('payment/{payment_id}/update', [PaymentController::class, 'update'])->name('payment.update');
//          INSPECTION
            Route::get('{project_id}/inspection/create', [InspectionController::class, 'create'])->name('inspection.create');
            Route::post('{project_id}/inspection', [InspectionController::class, 'store'])->name('inspection.store');
            Route::get('inspection/{inspection_id}/edit', [InspectionController::class, 'edit'])->name('inspection.edit');
            Route::post('inspection/{inspection_id}/update', [InspectionController::class, 'update'])->name('inspection.update');
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
        });

//      CLIENT
        Route::prefix('client')->group(function () {
            Route::get('/', [ClientController::class, 'index'])->name('client.index');
            Route::get('create', [ClientController::class, 'create'])->name('client.create');
            Route::post('', [ClientController::class, 'store'])->name('client.store');
        });
    });
});

require __DIR__.'/auth.php';

Route::get('register', function () {
    return redirect()->route('login');
});
