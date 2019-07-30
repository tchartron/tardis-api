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
// use App\Services\Gitlab;
// use League\Container\Container;
Route::get('/', 'FrontController@index')->name('front');
// Route::get('/', function() {
//     // $container = new Container;
//     // $gitlab = new Gitlab($container);
//     // $groups = $gitlab->getGroups();
//     // dd($groups);
//     return "Tardis";
// })->name('front');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Resources
Route::resource('groups', 'GroupController');
// Route::resource('tasks', 'TaskController');

Route::get('/tasks', 'TaskController@index')->name('tasks.index');
// Route::post('/tasks', 'TaskController@store')->name('tasks.store'); // How to fetch associated group ?
Route::post('/groups/{group}/tasks', 'TaskController@store')->name('tasks.store');
// Route::get('/tasks/create', 'TaskController@create')->name('tasks.create'); // exemple with get parameter 'group' passed from groups/show on button create new task
Route::get('/groups/{group}/tasks', 'TaskController@create')->name('tasks.create');
Route::get('/tasks/{task}', 'TaskController@show')->name('tasks.show');
Route::match(['put', 'patch'], '/tasks/{task}', 'TaskController@update')->name('tasks.update');
Route::delete('/tasks/{task}', 'TaskController@destroy')->name('tasks.destroy');
Route::get('/tasks/{task}/edit', 'TaskController@edit')->name('tasks.edit');

//Don't need full resource controller for timers
Route::post('/timers', 'TimerController@store')->name('timers.store');
// Route::post('/groups/{group}/times', 'TimerController@store')->name('timers.store'); // Jeffrey's way of doing things watch lfs-from-scratch ep 18
Route::get('/timers', 'TimerController@index')->name('timers.index');
Route::match(['put', 'patch'], '/timers/{timer}', 'TimerController@update')->name('timers.update');
Route::delete('/timers/{timer}', 'TimerController@destroy')->name('timers.destroy');
