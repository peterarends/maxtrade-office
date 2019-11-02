<?php
Route::get('/', 'HomeController@index')->name('index');

Auth::routes(['verify' => true]);

Route::get('/{any}', 'AppController@index')->where('any', '.*');
