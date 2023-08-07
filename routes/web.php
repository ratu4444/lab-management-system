<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TaskController;

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
//  DASHBOARD
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
//  PROJECT
    Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');
    Route::post('/project', [ProjectController::class, 'store'])->name('project.store');

    Route::get('/create-payment/{project-id}', [ProjectController::class, 'createPayment'])->name('create.payment');
    Route::get('/create-inspection/{project-id}', [ProjectController::class, 'createInspection'])->name('create.inspection');
//  TASK
    Route::get('/project/{project_id}/task/create', [TaskController::class, 'create'])->name('task.create');
    Route::get('/project/{project_id}/task/create', [TaskController::class, 'create'])->name('task.create');
//  CLIENT

    Route::prefix('project')->group(function () {
        Route::get('', [ProjectController::class, 'index'])->name('project.index');
        Route::get('create', [ProjectController::class, 'create'])->name('project.create');
        Route::post('', [ProjectController::class, 'store'])->name('project.store');

        Route::get('{project_id}/task/create', [TaskController::class, 'create'])->name('task.create');
        Route::post('{project_id}/task', [TaskController::class, 'store'])->name('task.store');
    });

    Route::get('/client', [ClientController::class, 'index'])->name('client.index');
    Route::get('/client/create', [ClientController::class, 'create'])->name('client.create');
//    Route::get('/create-project', [ProjectController::class, 'createProject'])->name('create.project');
    Route::get('/create-payment/{project-id}', [ProjectController::class, 'createPayment'])->name('create.payment');
    Route::get('/create-inspection/{project-id}', [ProjectController::class, 'createInspection'])->name('create.inspection');
});

require __DIR__.'/auth.php';

Route::get('register', function () {
    return redirect()->route('login');
});
