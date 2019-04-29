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
    'middleware' => 'api'
], function ($router) {
    Route::post('login', 'Api\AuthController@login');
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('me', 'Api\AuthController@me');
});

Route::middleware(['auth:api'])->group(function() {
    Route::apiResource('companies', 'Api\CompanyController');
    Route::apiResource('companies.tasks', 'Api\TaskController'); //Tasks depends on companies maybe later add endpoints to show a task without company id in url ...
});


//We wrap tasks in companies because company can't exist without a task
// Route::group([
//     'middleware' => 'auth:api',
//     'prefix' => 'companies' // = /api/companies
// ], function($router) {
//     Route::get('/{company}/task');
//     Route::get('/{company}/task');
// });
