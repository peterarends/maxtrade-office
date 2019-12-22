<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/** List Projects */
Route::get('projects', 'ProjectsController@index');
/** List single Project */
Route::get('project/{id}', 'ProjectsController@show');
/** Create new Project */
Route::post('project', 'ProjectsController@store');
/** Update a Project */
Route::put('project', 'ProjectsController@store');
/** Delete a Project */
Route::delete('project/{id}', 'ProjectsController@destroy');

/** List tasks */
Route::get('tasks/{id}', 'TasksController@index');
/** List single Task */
Route::get('task/{id}', 'TasksController@show');
/** Create new Task */
Route::post('task', 'TasksController@store');
/** Update a Task */
Route::put('task', 'TasksController@store');
/** Delete a Task */
Route::delete('task/{id}', 'TasksController@destroy');

/** List Properties */
Route::get('properties', 'PropertiesController@index');
/** Update a Property */
Route::put('property', 'PropertiesController@store');
/** List Categories */
Route::get('properties_categories', 'PropertiesController@categories');
