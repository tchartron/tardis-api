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

Route::get('/', 'FrontController@index')->name('front');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Resources
Route::resource('companies', 'CompanyController');

//Don't need full resource controller for times
Route::post('/times', 'TimeController@store');
Route::get('/times', 'TimeController@index');
Route::delete('/times/{time}', 'TimeController@destroy');
