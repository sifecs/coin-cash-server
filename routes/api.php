<?php

use App\User;
use Illuminate\Http\Request;

Route::group(['middleware' =>'auth:api'], function (){
    Route::GET('/balans', 'Api\V1\ApiControler@getBalans');
    Route::GET('/posts', 'Api\V1\PostsController@index');
    Route::POST('/posts', 'Api\V1\PostsController@store');
    Route::PUT('/posts/{post}', 'Api\V1\PostsController@update');
    Route::DELETE('/posts/{post}', 'Api\V1\PostsController@destroy');
//    Route::resource('/posts', 'Api\V1\PostsController');
});