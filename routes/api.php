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

Route::namespace('App\Http\Controllers\API')->group(function () {
    Route::get('/getSliders', 'APISliderController@getSliders');
    Route::prefix('auth')->group(function () {
        Route::post('/login', 'APIAuthController@login');
        Route::post('/register', 'APIAuthController@register');
        Route::get('/getVersion', 'APIAuthController@getVersion');
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('auth')->group(function(){
            Route::get('/getUser', 'APIAuthController@getUser');
        });
        Route::prefix('efilling')->group(function () {
            Route::get('/GetServiceList', 'APIEfillingController@GetServiceList');
            Route::post('/SubmitEfilling', 'APIEfillingController@SubmitEfilling');
            Route::get('/GetPermohonan', 'APIEfillingController@GetPermohonan');
        });

        Route::prefix('news')->group(function () {
            Route::get('/list', 'APINewsController@GetNews');
        });
    });
});

