<?php

use Illuminate\Http\Request;

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

    Route::get('/status', 'Api\PlaceController@status');
    Route::namespace('Api')->group( function() {
    Route::post('/place/add', 'PlaceController@add');
    Route::get('/place', 'PlaceController@list');
    Route::get('/place/{id}', 'PlaceController@select');
    Route::put('/place/{id}', 'PlaceController@update');
    Route::delete('/place/{id}', 'PlaceController@delete');
