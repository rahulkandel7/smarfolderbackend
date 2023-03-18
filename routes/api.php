<?php

use App\Http\Controllers\Api\V1\AssetController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CodeCheckController;
use App\Http\Controllers\Api\V1\ForgetPasswordController;
use App\Http\Controllers\Api\V1\ItemController;
use App\Http\Controllers\Api\V1\NoteController;
use App\Http\Controllers\Api\V1\ResetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // For Password Resetting
    Route::post('password/email',  ForgetPasswordController::class);
    Route::post('password/code/check', CodeCheckController::class);
    Route::post('password/reset', ResetPasswordController::class);
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Asset Controller
    Route::apiResource('assets', AssetController::class);

    // Asset Items Controller
    Route::apiResource('items', ItemController::class);
    Route::get('assets/{asset_id}/items', [ItemController::class, 'getItem']);

    // Asset Item Notes Controller
    Route::apiResource('notes', NoteController::class);
    Route::get('items/{item_id}/notes', [NoteController::class, 'getNote']);
});
