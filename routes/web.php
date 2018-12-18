<?php


Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'admin'], function(){
  Route::get('/admin', 'AdminController@dashboard');

  Route::get('/kelola-staf', 'AdminController@showStaf');
  Route::get('/add-staf', 'AdminController@addStaf');
  Route::get('/api/staf', 'AdminController@apiStaf')->name('api.staf');
  Route::post('/add-staf', 'Auth\RegisterStafController@register')->name('addStaf');
  
  Route::delete('/kelola-staf/{id}', 'AdminController@destroy');
  Route::get('/kelola-staf/{id}/edit', 'AdminController@formEdit');
  Route::patch('/kelola-staf/{id}', 'AdminController@updateRole');



});

Route::group(['middleware' => 'staf'], function(){
  Route::get('/staf', 'StafController@dashboard');


});


Auth::routes();

// --> Route untuk verifikasi Email
Route::get('/verify/{token}/{id}', 'VerifyEmail@verify');


Route::get('/home', 'HomeController@index')->name('home');
