<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => ['api', 'cors']
], function ($router) {
    Route::post('login', 'Api\AuthController@login');
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('register', 'Api\AuthController@register');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('me', 'Api\AuthController@me');
});

Route::middleware(['auth:api'])->group(function() {
    Route::apiResource('groups', 'Api\GroupController');
    Route::apiResource('groups.tasks', 'Api\TaskController'); //Tasks depends on groups maybe later add endpoints to show a task without group id in url ...
    Route::apiResource('groups.tasks.timers', 'Api\TimerController');
    Route::get("now", 'Api\TimerController@now');
    Route::get("users/{user}", 'Api\UserController@show');
    //GitlabService
    Route::get('gitlab/groups', 'Api\GitlabController@getGroups');
    Route::get('gitlab/groups/{groupId}/issues', 'Api\GitlabController@getIssuesFromGroup');
});


//We wrap tasks in groups because group can't exist without a task
// Route::group([
//     'middleware' => 'auth:api',
//     'prefix' => 'groups' // = /api/groups
// ], function($router) {
//     Route::get('/{groups}/task');
//     Route::get('/{groups}/task');
// });
