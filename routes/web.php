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
Route::resource('tasks', 'TaskController');

//Don't need full resource controller for timers
Route::post('/times', 'TimerController@store')->name('timers.store');
// Route::post('/companies/{company}/times', 'TimerController@store')->name('timers.store'); // Jeffrey's way of doing things watch lfs-from-scratch ep 18
Route::get('/times', 'TimerController@index')->name('timers.index');
Route::delete('/times/{time}', 'TimerController@destroy')->name('timers.destroy');
