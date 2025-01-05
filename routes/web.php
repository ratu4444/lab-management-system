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
    });

    Route::middleware('auth.admin')->group(function () {
//      ADMIN DASHBOARD
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.admin-index');

//      PROJECT
        Route::resource('project', ProjectController::class);
        Route::prefix('project/{project_id}')->group(function () {
//          TASK
            Route::resource('task', TaskController::class);
            Route::get('default-task', [ProjectController::class, 'defaultTask'])->name('project.default-task');
            Route::post('default-task', [ProjectController::class, 'defaultTaskStore'])->name('project.default-task.store');
//          PAYMENT
//            Route::resource('payment', PaymentController::class);
//            Route::get('default-payment', [ProjectController::class, 'defaultPayment'])->name('project.default-payment');
//            Route::post('default-payment', [ProjectController::class, 'defaultPaymentStore'])->name('project.default-payment.store');
//          INSPECTION
//            Route::resource('inspection', InspectionController::class);
//            Route::get('default-inspection', [ProjectController::class, 'defaultInspection'])->name('project.default-inspection');
//            Route::post('default-inspection', [ProjectController::class, 'defaultInspectionStore'])->name('project.default-inspection.store');

            Route::resource('report', ReportController::class);
            Route::post('report/{report_id}/toggle-visibility', [ReportController::class, 'toggleVisibility'])->name('report.toggle-visibility');
        });

//      SETTINGS
        Route::prefix('settings')->name('settings.')->group(function () {
//          SETTINGS TASK
            Route::post('task/store', [SettingsController::class, 'taskStore'])->name('task.store');
            Route::get('task/show', [SettingsController::class, 'taskShow'])->name('task.show');
            Route::get('task/{default_task_id}/edit', [SettingsController::class, 'taskEdit'])->name('task.edit');
            Route::put('task/{default_task_id}/update', [SettingsController::class, 'taskUpdate'])->name('task.update');
//          SETTINGS PAYMENTS
//            Route::post('payment/store', [SettingsController::class, 'paymentStore'])->name('payment.store');
//            Route::get('payment/show', [SettingsController::class, 'paymentShow'])->name('payment.show');
//            Route::get('payment/{default_payment_id}/edit', [SettingsController::class, 'paymentEdit'])->name('payment.edit');
//            Route::put('payment/{default_payment_id}/update', [SettingsController::class, 'paymentUpdate'])->name('payment.update');
//          SETTINGS INSPECTION
//            Route::post('inspection/store', [SettingsController::class, 'inspectionStore'])->name('inspection.store');
//            Route::get('inspection/show', [SettingsController::class, 'inspectionShow'])->name('inspection.show');
//            Route::get('inspection/{default_inspection_id}/edit', [SettingsController::class, 'inspectionEdit'])->name('inspection.edit');
//            Route::put('inspection/{default_inspection_id}/update', [SettingsController::class, 'inspectionUpdate'])->name('inspection.update');
//          SETTINGS ELEMENT
//            Route::get('element/show',[SettingsController::class, 'elementShow'])->name('element');
//            Route::post('project/{project_id}/element/store',[SettingsController::class, 'elementStore'])->name('element.store');
//          OUTLOOK CONFIGURATION
//            Route::get('outlook-configuration',[SettingsController::class, 'outlookConfiguration'])->name('outlook-configuration');
//            Route::post('mail-configuration',[SettingsController::class, 'mailConfiguration'])->name('mail-configuration');
        });

//      CLIENT
        Route::resource('client', ClientController::class);

//        Route::get('oauth/{app_name}/authorize', [OauthController::class, 'oauthAuthorize'])->name('oauth.authorize');
//        Route::any('oauth/{app_name}/redirect', [OauthController::class, 'oauthRedirect'])->name('oauth.redirect');
//        Route::get('oauth/{app_name}/refresh', [OauthController::class, 'oauthRefresh'])->name('oauth.refresh');
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
