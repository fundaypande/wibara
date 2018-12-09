<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/tes', function () {
    return view('tes');
});

Route::get('/admin', function () {
    return view('layouts.admin');
});

Route::get('/login2', function () {
    return view('auth/login2');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
