<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth')->group(function () {
    Route::post('store-client', [ProjectController::class, 'storeClient'])->name('api.store-client');
    Route::post('store-project', [ProjectController::class, 'storeProject'])->name('api.store-project');
    Route::post('store-task', [ProjectController::class, 'storeTask'])->name('api.store-task');
    Route::post('store-payment', [ProjectController::class, 'storePayment'])->name('api.store-payment');
    Route::post('store-inspection', [ProjectController::class, 'storeInspection'])->name('api.store-inspection');
});
