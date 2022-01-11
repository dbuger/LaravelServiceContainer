<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('brands')->group(function () {
    Route::get('/', [BrandController::class, 'all']);
    Route::post('/', [BrandController::class, 'save']);
    Route::get('/{id}', [BrandController::class, 'find'])->where('id', '[0-9]+');
    Route::delete('/{id}', [BrandController::class, 'delete'])->where('id', '[0-9]+');
});

Route::prefix('cars')->group(function () {
    Route::get('/', [CarController::class, 'all']);
    Route::post('/', [CarController::class, 'save']);
    Route::get('/{id}', [CarController::class, 'find'])->where('id', '[0-9]+');
    Route::get('/get-brand/{id}', [CarController::class, 'getBrand'])->where('id', '[0-9]+');
    Route::delete('/{id}', [CarController::class, 'delete'])->where('id', '[0-9]+');
});

