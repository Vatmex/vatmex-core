<?php

use App\Http\Controllers\ApiControllers\RosterController;
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
Route::group(['prefix' => 'roster'], function () {
    Route::get('/', [RosterController::class, 'index']);
    Route::get('/{cid}', [RosterController::class, 'show']);
});
