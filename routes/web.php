<?php


Route::get('/', function () {
    return redirect('/login');
});


//** Respon Responden

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



  // ** Kelola Komoditi
  // Route::get('/indicators', 'KomoditiController@show');
  // Route::get('/api/komoditi', 'KomoditiController@apiKomoditi')->name('api.komoditi');
  //   Route::get('/api/komoditi/admin', 'KomoditiController@apiKomoditiAdmin')->name('api.komoditiAdmin');
  // Route::post('/komoditi', 'KomoditiController@store')->name('admin.addKomoditi');
  // Route::get('/komoditi/{id}/edit', 'KomoditiController@formEdit'); //--> menampilkan data di form edit
  // Route::patch('/komoditi/{id}', 'KomoditiController@update'); //-> Proses edit data
  // Route::delete('/komoditi/{id}', 'KomoditiController@destroy'); //->Mneghapus data





});


Route::group(['middleware' => 'adminStaf'], function(){




});




Auth::routes();
