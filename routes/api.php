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

/** List All Projects */
Route::get('projects/{id}', 'ProjectsController@index');
/** List single Project */
Route::get('project/{id}', 'ProjectsController@show');
/** Create new Project */
Route::post('project', 'ProjectsController@store');
/** Update a Project */
Route::put('project', 'ProjectsController@store');
/** Delete a Project */
Route::delete('project/{id}', 'ProjectsController@destroy');

/** List tasks */
Route::get('tasks/all/{id}', 'TasksController@index');
/** List only active Tasks */
Route::get('tasks/act/{id}', 'TasksController@indexActive');
/** List only ended Tasks */
Route::get('tasks/end/{id}', 'TasksController@indexEnded');
/** List single Task */
Route::get('task/{id}', 'TasksController@show');
/** Complete all Task by Project */
Route::get('task/complete/{id}', 'TasksController@complete');
/** Create new Task */
Route::post('task', 'TasksController@store');
/** Update a Task */
Route::put('task', 'TasksController@store');
/** Delete a Task */
Route::delete('task/{id}', 'TasksController@destroy');
/** Add file to Task */
Route::post('task/file/{id}', 'TasksController@addFile');
/** Get documents */
Route::get('task/documents/{id}', 'TasksController@getDocuments');
/** Delete a Document */
Route::delete('task/document/delete/{id}/{document}', 'TasksController@deleteDocument');

/** List Properties */
Route::get('properties', 'PropertiesController@index');
/** Update a Property */
Route::put('property', 'PropertiesController@store');
/** List Categories */
Route::get('properties_categories', 'PropertiesController@categories');

/** List All Users */
Route::get('users', 'UserController@getUsers');
/** List all Users to this Project */
Route::get('users/project/{id}', 'UserController@getUsersByProject');
/** Add User to this Project */
Route::post('add/user', 'UserController@store');
/** Delete User to this Project */
Route::delete('delete/user/{user_id}/project/{project_id}', 'UserController@deleteUserByProject');

/** Search all projects and tasks */
Route::post('search', 'SearchController@index');

/** List All Contacts */
Route::get('contacts/{id}', 'ContactsController@index');
/** Save changed Contacts */
Route::post('contacts', 'ContactsController@store');
/** Create new Contact */
Route::post('contact', 'ContactsController@storeContact');
/** Delete a Contact */
Route::delete('contact/{id}', 'ContactsController@destroy');
/** Search contacts */
Route::post('contacts/search', 'ContactsController@search');

/** Imap */
Route::get('imaps/{id}', 'ImapController@index');
/** Delete a Imap */
Route::delete('imap/{id}', 'ImapController@destroy');
