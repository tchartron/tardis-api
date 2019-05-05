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

// Route::get('/', 'FrontController@index')->name('front');
Route::get('/', function() {
    return "Nothing to see here";
})->name('front');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Resources
Route::resource('companies', 'CompanyController');
// Route::resource('tasks', 'TaskController');

Route::get('/tasks', 'TaskController@index')->name('tasks.index');
// Route::post('/tasks', 'TaskController@store')->name('tasks.store'); // How to fetch associated company ?
Route::post('/companies/{company}/tasks', 'TaskController@store')->name('tasks.store');
// Route::get('/tasks/create', 'TaskController@create')->name('tasks.create'); // exemple with get parameter 'id_company' passed from companies/show on button create new task
Route::get('/companies/{company}/tasks', 'TaskController@create')->name('tasks.create');
Route::get('/tasks/{task}', 'TaskController@show')->name('tasks.show');
Route::match(['put', 'patch'], '/tasks/{task}', 'TaskController@update')->name('tasks.update');
Route::delete('/tasks/{task}', 'TaskController@destroy')->name('tasks.destroy');
Route::get('/tasks/{task}/edit', 'TaskController@edit')->name('tasks.edit');

//Don't need full resource controller for timers
Route::post('/timers', 'TimerController@store')->name('timers.store');
// Route::post('/companies/{company}/times', 'TimerController@store')->name('timers.store'); // Jeffrey's way of doing things watch lfs-from-scratch ep 18
Route::get('/timers', 'TimerController@index')->name('timers.index');
Route::match(['put', 'patch'], '/timers/{timer}', 'TimerController@update')->name('timers.update');
Route::delete('/timers/{timer}', 'TimerController@destroy')->name('timers.destroy');
