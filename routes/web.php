<?php


Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'admin'], function(){
  Route::get('/admin', 'AdminController@dashboard');
  Route::get('/kelola-staf', 'AdminController@showStaf');


});

Route::group(['middleware' => 'staf'], function(){
  Route::get('/staf', 'StafController@dashboard');


});


Auth::routes();

// --> Route untuk verifikasi Email
Route::get('/verify/{token}/{id}', 'VerifyEmail@verify');


Route::get('/home', 'HomeController@index')->name('home');
