<?php
Route::get('/', 'HomeController@index')->name('index');

Auth::routes();

Route::get('/{any}', 'AppController@index')->where('any', '.*');
