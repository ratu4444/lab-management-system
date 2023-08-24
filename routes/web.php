<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\OauthController;

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
            Route::get('default-task', [ProjectController::class, 'defaultTask'])->name('project.default-task');
            Route::post('default-task', [ProjectController::class, 'defaultTaskStore'])->name('project.default-task.store');
//          PAYMENT
            Route::resource('payment', PaymentController::class);
            Route::get('default-payment', [ProjectController::class, 'defaultPayment'])->name('project.default-payment');
            Route::post('default-payment', [ProjectController::class, 'defaultPaymentStore'])->name('project.default-payment.store');
//          INSPECTION
            Route::resource('inspection', InspectionController::class);
            Route::get('default-inspection', [ProjectController::class, 'defaultInspection'])->name('project.default-inspection');
            Route::post('default-inspection', [ProjectController::class, 'defaultInspectionStore'])->name('project.default-inspection.store');
        });

//      SETTINGS
        Route::prefix('settings')->group(function () {
//          SETTINGS TASK
            Route::post('task/store', [SettingsController::class, 'taskStore'])->name('settings.task.store');
            Route::get('task/show', [SettingsController::class, 'taskShow'])->name('settings.task.show');
            Route::get('task/{default_task_id}/edit', [SettingsController::class, 'taskEdit'])->name('settings.task.edit');
            Route::put('task/{default_task_id}/update', [SettingsController::class, 'taskUpdate'])->name('settings.task.update');
//          SETTINGS PAYMENTS
            Route::post('payment/store', [SettingsController::class, 'paymentStore'])->name('settings.payment.store');
            Route::get('payment/show', [SettingsController::class, 'paymentShow'])->name('settings.payment.show');
            Route::get('payment/{default_payment_id}/edit', [SettingsController::class, 'paymentEdit'])->name('settings.payment.edit');
            Route::put('payment/{default_payment_id}/update', [SettingsController::class, 'paymentUpdate'])->name('settings.payment.update');
//          SETTINGS INSPECTION
            Route::post('inspection/store', [SettingsController::class, 'inspectionStore'])->name('settings.inspection.store');
            Route::get('inspection/show', [SettingsController::class, 'inspectionShow'])->name('settings.inspection.show');
            Route::get('inspection/{default_inspection_id}/edit', [SettingsController::class, 'inspectionEdit'])->name('settings.inspection.edit');
            Route::put('inspection/{default_inspection_id}/update', [SettingsController::class, 'inspectionUpdate'])->name('settings.inspection.update');
//          SETTINGS ELEMENT
            Route::get('element/show',[SettingsController::class, 'elementShow'])->name('settings.element');
            Route::post('project/{project_id}/element/store',[SettingsController::class, 'elementStore'])->name('settings.element.store');
//          OUTLOOK CONFIGURATION
            Route::get('outlook-configuration',[SettingsController::class, 'outlookConfiguration'])->name('settings.outlook-configuration');
            Route::post('mail-configuration',[SettingsController::class, 'mailConfiguration'])->name('settings.mail-configuration');
        });

//      CLIENT
        Route::resource('client', ClientController::class);

        Route::get('oauth/{app_name}/authorize', [OauthController::class, 'oauthAuthorize'])->name('oauth.authorize');
        Route::any('oauth/{app_name}/redirect', [OauthController::class, 'oauthRedirect'])->name('oauth.redirect');
        Route::get('oauth/{app_name}/refresh', [OauthController::class, 'oauthRefresh'])->name('oauth.refresh');
    });
});

require __DIR__.'/auth.php';

Route::get('register', function () {
    return redirect()->route('login');
});
