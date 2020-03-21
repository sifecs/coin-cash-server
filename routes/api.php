<?php

use App\User;
use Illuminate\Http\Request;

Route::group(['prefix'=>'V1/auth', 'namespace'=>'Api'], function (){
    Route::POST('/register', 'AuthControler@register');
    Route::POST('/login', 'AuthControler@login');
});

Route::group(['prefix'=>'V1/categories', 'namespace'=>'Api'], function (){
    Route::GET('/list', 'ApiControler@listCaterories');
});

Route::group(['prefix'=>'V1', 'namespace'=>'Api', 'middleware' =>'auth:api'], function (){

    Route::group(['prefix'=>'/payments'], function (){
        Route::GET('/all', 'FinanceController@index');
        Route::POST('/payment', 'FinanceController@store');
        Route::PUT('/payment/{financ}', 'FinanceController@update');
        Route::DELETE('/payment/{financ}', 'FinanceController@destroy');

        //сделал на всякий случай
        Route::POST('/income', 'FinanceController@income');
        Route::POST('/expenses', 'FinanceController@expenses');

    });

    Route::GET('/balans', 'ApiControler@getBalans');

});