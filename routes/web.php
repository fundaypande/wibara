<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('/produk', 'ProduksiController@showRandom');
Route::post('/produk/search', 'ProduksiController@search');
Route::get('/produk/{id}', 'ProduksiController@showOne');
Route::get('/produsen/{id}', 'ProduksiController@showProdusen');


Route::group(['middleware' => ['auth']], function(){
  Route::get('/user/{id?}', 'UserController@user');
  Route::put('/user/pic/{id}', 'UserController@updatePic');
  Route::put('/user/edit/{id}', 'UserController@update');

  Route::get('/home', 'HomeController@index')->name('home');


  Route::get('/ikm/{id}', 'IkmController@show');



  // --> Route untuk verifikasi Email
  Route::get('/verify/{token}/{id}', 'VerifyEmail@verify');


  // --> Kumpulan API yang bisa diakses oleh user auth
  Route::get('/api/bahan/{id?}', 'BahanController@apiBahan')->name('api.bahan');
  Route::get('/api/peralatan/{id?}', 'PeralatanController@apiPeralatan')->name('api.peralatan');
  Route::get('/api/produksi/{id?}', 'ProduksiController@apiProduksi')->name('api.produksi');

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


  //--> Kelola Profil IKM
  Route::get('/kelola-ikm', 'ProfilIkmController@showKelola');
  Route::get('/api/kelola-ikm', 'ProfilIkmController@apiKelola')->name('api.kelolaIkm');  //API untuk menampilkan data profil IKM yang belum tervalidasi

  Route::get('/profil/{id}/edit', 'ProfilIkmController@showModal'); //--> arahkan ke modal EDIT
  Route::patch('/profil/{id}', 'ProfilIkmController@update'); //-> Proses edit data
  Route::delete('/profil/{id}', 'ProfilIkmController@destroy');
  Route::post('/profil/store', 'ProfilIkmController@store')->name('staf.addIkm');


  Route::get('/komoditi', 'KomoditiController@show');
  Route::get('/api/komoditi', 'KomoditiController@apiKomoditi')->name('api.komoditi');
  Route::post('/komoditi', 'KomoditiController@store')->name('admin.addKomoditi');
  Route::get('/komoditi/{id}/edit', 'KomoditiController@formEdit'); //--> menampilkan data di form edit
  Route::patch('/komoditi/{id}', 'KomoditiController@update'); //-> Proses edit data
  Route::delete('/komoditi/{id}', 'KomoditiController@destroy'); //->Mneghapus data
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


Route::group(['middleware' => ['ikm'], ['staf']], function(){
  Route::get('/ikm', 'IkmController@dashboard');

  Route::get('/profil', 'ProfilIkmController@show');
  Route::put('/profil/{id}', 'ProfilIkmController@update');

  Route::get('/produksi', 'ProduksiController@showProduksi');

  // Route::post('/produksi/store', 'ProduksiController@store')->name('ikm.addProduksi'); //Menambah data produksi
  Route::get('/add-produksi', 'ProduksiController@showCreate')->name('create.produksi');
  Route::post('/produksi/store2', 'ProduksiController@store2')->name('store.produksi');
  Route::delete('/produksi/{id}', 'ProduksiController@destroy'); //->Mneghapus data
  Route::get('/produksi/{id}/edit', 'ProduksiController@edit');
  Route::patch('/produksi/{id}', 'ProduksiController@update'); //-> Proses edit data
  Route::get('/produksi/{id}/show', 'ProduksiController@formEdit'); //--> menampilkan data di form edit


  //-> ***** Profil IKM Jenis Peralatan PANUTAN
  Route::get('/peralatan', 'PeralatanController@show');

  Route::post('/peralatan', 'PeralatanController@store')->name('ikm.addPeralatan');
  Route::get('/peralatan/{id}/edit', 'PeralatanController@formEdit'); //--> menampilkan data di form edit
  Route::patch('/peralatan/{id}', 'PeralatanController@update'); //-> Proses edit data
  Route::delete('/peralatan/{id}', 'PeralatanController@destroy'); //->Mneghapus data

  //Bahan Baku Profil IKM
  Route::get('/bahan', 'BahanController@show');

  Route::post('/bahan', 'BahanController@store')->name('ikm.addBahan');
  Route::get('/bahan/{id}/edit', 'BahanController@formEdit'); //--> menampilkan data di form edit
  Route::patch('/bahan/{id}', 'BahanController@update'); //-> Proses edit data
  Route::delete('/bahan/{id}', 'BahanController@destroy'); //->Mneghapus data
});


Auth::routes();
