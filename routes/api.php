<?php

use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\Api\RegisterUserController;
use App\Http\Controllers\Api\UserPointsController;
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
Route::post('auth/tokens', [AccessTokensController::class, 'store']);
Route::post('auth/update_profile', [AccessTokensController::class, 'update'])->middleware('auth:sanctum');
Route::post('auth/notfications', [UserPointsController::class, 'notfications'])->middleware('auth:sanctum');
Route::post('auth/register', [RegisterUserController::class, 'store']);
Route::post('auth/global_data', [UserPointsController::class, 'userData'])->middleware('auth:sanctum');
Route::post('auth/transfer', [UserPointsController::class, 'transfer'])->middleware('auth:sanctum');
Route::post('auth/sendgooglereview', [UserPointsController::class, 'sendGoogleReview'])->middleware('auth:sanctum');
Route::post('auth/sendfacebookreview', [UserPointsController::class, 'sendFacebookReview'])->middleware('auth:sanctum');
Route::post('auth/sendfacebookcheckin', [UserPointsController::class, 'sendFacebookCheckin'])->middleware('auth:sanctum');
Route::post('auth/connectfacebook', [UserPointsController::class, 'connectFacebook'])->middleware('auth:sanctum');
Route::post('auth/connectgoogle', [UserPointsController::class, 'connectGoogle'])->middleware('auth:sanctum');
Route::post('auth/getfacebookinfo', [UserPointsController::class, 'getfacebookinfo'])->middleware('auth:sanctum');
Route::post('auth/getgoogleinfo', [UserPointsController::class, 'getgoogleinfo'])->middleware('auth:sanctum');
Route::post('auth/transactions', [UserPointsController::class, 'transactions'])->middleware('auth:sanctum');
Route::post('auth/disable', [UserPointsController::class, 'disableAcc'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
