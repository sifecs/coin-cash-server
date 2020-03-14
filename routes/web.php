<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'HomeController@index');

Route::group(['middleware' =>'auth'], function (){
    Route::get('/loguot', 'AuthControler@loguot');
    Route::get('/profile', 'profileController@index');
    Route::post('/profile', 'profileController@store');
});

Route::group(['middleware' =>'guest'], function (){
    Route::get('/register', 'AuthControler@registrForm');
    Route::post('/register', 'AuthControler@register');
    Route::get('/login', 'AuthControler@loginForm')->name('login');
    Route::post('/login', 'AuthControler@login');
});

Route::group(['prefix'=>'admin','namespace'=>'Admin', 'middleware' =>'admin'], function (){
    Route::get('/', 'DashboardController@index');
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/currencies', 'CurrenciesController');
    Route::resource('/users', 'UsersController');
    Route::resource('/finance', 'FinanceController');
});

