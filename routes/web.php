<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InspectionController;

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

Route::middleware('auth')->group(function () {

//      DASHBOARD
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('project/dashboard', [ProjectController::class, 'dashboard'])->name('dashboard.client-index'); // client dashboard

    Route::middleware('auth.admin')->group(function (){
        Route::prefix('project')->group(function () {
//      PROJECT
            Route::get('', [ProjectController::class, 'index'])->name('project.index');
            Route::get('create', [ProjectController::class, 'create'])->name('project.create');
            Route::post('', [ProjectController::class, 'store'])->name('project.store');
            Route::get('{project_id}', [ProjectController::class, 'show'])->name('project.show');
            Route::get('{project_id}/edit', [ProjectController::class, 'edit'])->name('project.edit');
            Route::post('{project_id}/edit', [ProjectController::class, 'editStore'])->name('project.edit.store');
//      TASK
            Route::get('{project_id}/task/create', [TaskController::class, 'create'])->name('task.create');
            Route::post('{project_id}/task', [TaskController::class, 'store'])->name('task.store');
//      PAYMENT
            Route::get('{project_id}/payment/create', [PaymentController::class, 'create'])->name('payment.create');
            Route::post('{project_id}/payment', [PaymentController::class, 'store'])->name('payment.store');
//      INSPECTION
            Route::get('{project_id}/inspection/create', [InspectionController::class, 'create'])->name('inspection.create');
            Route::post('{project_id}/inspection', [InspectionController::class, 'store'])->name('inspection.store');
        });
//  CLIENT
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
