<?php


Route::get('/', function () {
    return redirect('/login');
});


//** Respon Responden
Route::get('/form/{formId}/{hash}', 'DataFormController@showForm');
Route::get('/form/success', 'DataFormController@showSuccess');
Route::post('/form/{id}/add', 'DataFormController@store');



Route::group(['middleware' => ['auth']], function(){
  Route::get('/user/{id?}', 'UserController@user');
  Route::put('/user/pic/{id}', 'UserController@updatePic');
  Route::put('/user/edit/{id}', 'UserController@update');

  Route::get('/home', 'HomeController@index')->name('home');


  // --> Route untuk verifikasi Email
  Route::get('/verify/{token}/{id}', 'VerifyEmail@verify');


  // ** Ubah Password
  Route::get('/change-password','HomeController@showChangePasswordForm');
  Route::post('/ubah-password','HomeController@changePassword')->name('changePassword');
});



Route::group(['middleware' => 'admin'], function(){
  Route::get('/admin', 'AdminController@dashboard');

  Route::get('/users', 'AdminController@showStaf');
  Route::get('/add-staf', 'AdminController@addStaf');
  Route::get('/api/staf', 'AdminController@apiStaf')->name('api.staf');
  Route::post('/add-staf', 'Auth\RegisterStafController@register')->name('addStaf');

  Route::delete('/kelola-staf/{id}', 'AdminController@destroy');
  Route::get('/kelola-staf/{id}/edit', 'AdminController@formEdit');
  Route::patch('/kelola-staf/{id}', 'AdminController@updateRole');


  // ** Kelola Komoditi
  // Route::get('/indicators', 'KomoditiController@show');
  // Route::get('/api/komoditi', 'KomoditiController@apiKomoditi')->name('api.komoditi');
  //   Route::get('/api/komoditi/admin', 'KomoditiController@apiKomoditiAdmin')->name('api.komoditiAdmin');
  // Route::post('/komoditi', 'KomoditiController@store')->name('admin.addKomoditi');
  // Route::get('/komoditi/{id}/edit', 'KomoditiController@formEdit'); //--> menampilkan data di form edit
  // Route::patch('/komoditi/{id}', 'KomoditiController@update'); //-> Proses edit data
  // Route::delete('/komoditi/{id}', 'KomoditiController@destroy'); //->Mneghapus data


  // ** Kelola Butir
  Route::get('/indicators', 'ButirController@show');
    Route::get('/api/indicators', 'ButirController@apiButir')->name('api.butir');

    Route::post('/indicators', 'ButirController@store')->name('admin.addButir');
    Route::get('/indicators/{id}/edit', 'ButirController@formEdit'); //--> menampilkan data di form edit
    Route::patch('/indicators/{id}', 'ButirController@update'); //-> Proses edit data
    Route::delete('/indicators/{id}', 'ButirController@destroy'); //->Mneghapus data


});


Route::group(['middleware' => 'staf'], function(){

  //kelola bobot
Route::get('/weight', 'BobotController@show');
  Route::get('/api/weights', 'BobotController@apiBobot')->name('api.bobot');
  Route::get('/weight/edit', 'BobotController@showEdit')->name('bobot.edit');
  Route::post('/weight/process', 'BobotController@process')->name('bobot.edit');
  Route::post('/weight/save', 'BobotController@update')->name('bobot.update');

  //kelola form
Route::get('/form', 'FormController@show');
  Route::post('/form/store', 'FormController@createData');
  Route::delete('/form/{id}', 'FormController@destroy'); //->Mneghapus data

//kelola satu form
Route::get('/form/{id}', 'FormController@showData');



});




Auth::routes();
