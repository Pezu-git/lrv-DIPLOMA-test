<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post(
    '/token/create',
    [\App\Http\Controllers\ApiTokenController::class, 'createToken']
);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource(
        '/hall',
        \App\Http\Controllers\HallController::class
    );

    Route::post(
        '/hall/{id}/active/{is_active}',
        [\App\Http\Controllers\HallController::class, 'setActive']
    );

    Route::apiResource(
        '/hall_conf',
        \App\Http\Controllers\HallConfController::class
    );

    Route::apiResource(
        '/seat',
        \App\Http\Controllers\SeatController::class
    );

    Route::apiResource(
        '/price_list',
        \App\Http\Controllers\PriceListController::class
    );

    Route::apiResource(
        '/movie',
        \App\Http\Controllers\MovieController::class
    );

    Route::apiResource(
        '/movie_schedule',
        \App\Http\Controllers\MovieScheduleController::class
    );

    
      
});