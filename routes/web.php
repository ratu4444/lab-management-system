<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ClientController;

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
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');
    Route::get('/client', [ClientController::class, 'index'])->name('client.index');
    Route::get('/client/create', [ClientController::class, 'create'])->name('client.create');
    Route::get('/create-project', [ProjectController::class, 'createProject'])->name('create.project');
    Route::get('/create-task/{project-id}', [ProjectController::class, 'createTask'])->name('create.task');
    Route::get('/create-payment/{project-id}', [ProjectController::class, 'createPayment'])->name('create.payment');
    Route::get('/create-inspection/{project-id}', [ProjectController::class, 'createInspection'])->name('create.inspection');
});

require __DIR__.'/auth.php';

Route::get('register', function () {
    return redirect()->route('login');
});
