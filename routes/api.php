<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DailyStatisticsController;
use App\Http\Controllers\DailyPlusStatisticsController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/daily-statistics', [DailyStatisticsController::class, 'index']);
Route::get('/daily-plus-statistics', [DailyPlusStatisticsController::class, 'index']);