<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/login2', function () {
    return view('auth/login2');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
