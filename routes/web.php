<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// --> Route untuk verifikasi Email
Route::get('/verify/{token}/{id}', 'VerifyEmail@verify');


Route::get('/home', 'HomeController@index')->name('home');
