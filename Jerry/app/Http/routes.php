<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('auth/login', 'AuthController@postLogin');

Route::resource('api/customer', 'Api\customerController');
Route::resource('api/payment', 'Api\paymentController');
Route::resource('api/social', 'Api\socialController');


Route::get('get/code/{id}', function ($id) {
    return QrCode::size(300)->generate($id);
});

Route::get('mastercard/transaction', 'MastercardController@transaction');