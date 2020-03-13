<?php

use App\User;
use Illuminate\Http\Request;

Route::group(['prefix'=>'V1', 'namespace'=>'Api\V1', 'middleware' =>'auth:api'], function (){
    Route::GET('/balans', 'ApiControler@getBalans');
    Route::GET('/posts', 'PostsController@index');
    Route::POST('/posts', 'PostsController@store');
    Route::PUT('/posts/{post}', 'PostsController@update');
    Route::DELETE('/posts/{post}', 'PostsController@destroy');
//    Route::resource('/posts', 'Api\V1\PostsController');
});