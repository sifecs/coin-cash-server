<?php

use App\User;
use Illuminate\Http\Request;

Route::group(['prefix'=>'V1', 'namespace'=>'Api\V1', 'middleware' =>'auth:api'], function (){
    Route::GET('/balans', 'ApiControler@getBalans');
    Route::GET('/finance', 'FinanceController@index');
    Route::POST('/finance', 'FinanceController@store');
    Route::PUT('/finance/{financ}', 'FinanceController@update');
    Route::DELETE('/finance/{financ}', 'FinanceController@destroy');
//    Route::resource('/finance', 'FinanceController');
    Route::POST('/income', 'FinanceController@income');
    Route::POST('/expenses', 'FinanceController@expenses');
});