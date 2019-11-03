<?php
Route::get('/', 'HomeController@index')->name('index');
Route::group(
    ['middleware' => ['auth','verified']],
    function () {
        Route::get('/logout.html', 'UserController@logoutUser');
    }
);
Auth::routes(['verify' => true]);

Route::get('/{any}', 'AppController@index')->where('any', '.*');
