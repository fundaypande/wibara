<?php


Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['auth']], function(){
  Route::get('/user/{id?}', 'UserController@user');
  Route::put('/user/pic/{id}', 'UserController@updatePic');
  Route::put('/user/edit/{id}', 'UserController@update');

  Route::get('/home', 'HomeController@index')->name('home');



  // --> Route untuk verifikasi Email
  Route::get('/verify/{token}/{id}', 'VerifyEmail@verify');

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

  Route::get('/validasi', 'ValidasiController@showValidasi');
  Route::get('/api/ikm-validasi', 'ValidasiController@apiValidasi')->name('api.valid');  //API untuk menampilkan data profil IKM yang belum tervalidasi
  Route::get('/validasi/{id}/edit', 'ValidasiController@formEdit'); //memunculkan modal validasi
  Route::patch('/validasi/{id}', 'ValidasiController@updateStatus'); //menyimpan hasil validasi

  //--> Kelola Profil IKM
  Route::get('/kelola-ikm', 'ProfilIkmController@showKelola');
  Route::get('/api/kelola-ikm', 'ProfilIkmController@apiKelola')->name('api.kelolaIkm');  //API untuk menampilkan data profil IKM yang belum tervalidasi

  Route::get('/profil/{id}/edit', 'ProfilIkmController@showModal'); //--> arahkan ke modal EDIT
  Route::patch('/profil/{id}', 'ProfilIkmController@update'); //-> Proses edit data
  Route::delete('/profil/{id}', 'ProfilIkmController@destroy');
  Route::post('/profil/store', 'ProfilIkmController@store')->name('staf.addIkm');
});


Route::group(['middleware' => 'ikm'], function(){
  Route::get('/ikm', 'IkmController@dashboard');

  Route::get('/profil', 'ProfilIkmController@show');
  Route::put('/profil/{id}', 'ProfilIkmController@update');

  Route::get('/produksi', 'ProduksiController@showProduksi');
  Route::get('/api/produksi', 'ProduksiController@apiProduksi')->name('api.produksi');
  Route::post('/produksi/store', 'ProduksiController@store')->name('ikm.addProduksi'); //Menambah data produksi

});


Auth::routes();
