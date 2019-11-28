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

/** List Properties */
Route::get('properties', 'PropertiesController@index');
/** Update a Property */
Route::put('property', 'PropertiesController@store');
