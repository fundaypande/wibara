<?php


Route::get('/tentang', function () {
    return view('public.tentang');
});

Route::get('/', 'ProduksiController@welcome');

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


  // ** Ubah Password
  Route::get('/ubah-password','HomeController@showChangePasswordForm');
  Route::post('/ubah-password','HomeController@changePassword')->name('changePassword');




});


// *** midleware staf dan IKM
Route::group(['middleware' => 'ikmStaf'], function(){
  // --> Kumpulan API yang bisa diakses oleh user auth
  Route::get('/api/bahan/{id}', 'BahanController@apiBahan');
  Route::get('/api/peralatan/{id}', 'PeralatanController@apiPeralatan');
  Route::get('/api/produksi/{id}', 'ProduksiController@apiProduksi')->name('api.produksi');
  Route::get('/api/profilIkm/{id}', 'IkmController@apiProfil');

  Route::get('/produksi/{id}', 'ProduksiController@showProduksi');

  // Route::post('/produksi/store', 'ProduksiController@store')->name('ikm.addProduksi'); //Menambah data produksi
  Route::get('/add-produksi/{id}', 'ProduksiController@showCreate')->name('create.produksi');
  Route::post('/produksi/{id}/store2', 'ProduksiController@store2');
  Route::delete('/produksi/{id}', 'ProduksiController@destroy'); //->Mneghapus data
  Route::get('/produksi/{id}/edit', 'ProduksiController@edit');
  Route::patch('/produksi/{id}', 'ProduksiController@update'); //-> Proses edit data
  Route::get('/produksi/{id}/show', 'ProduksiController@formEdit'); //--> menampilkan data di form edit


  //-> ***** Profil IKM Jenis Peralatan PANUTAN
  Route::get('/peralatan/{id}', 'PeralatanController@show');

  Route::post('/peralatan/{id}', 'PeralatanController@store');
  Route::get('/peralatan/{id}/edit', 'PeralatanController@formEdit'); //--> menampilkan data di form edit
  Route::patch('/peralatan/{id}', 'PeralatanController@update'); //-> Proses edit data
  Route::delete('/peralatan/{id}', 'PeralatanController@destroy'); //->Mneghapus data

  //Bahan Baku Profil IKM
  Route::get('/bahan/{id}', 'BahanController@show');

  Route::post('/bahan/{id}', 'BahanController@store');
  Route::get('/bahan/{id}/edit', 'BahanController@formEdit'); //--> menampilkan data di form edit
  Route::patch('/bahan/{id}', 'BahanController@update'); //-> Proses edit data
  Route::delete('/bahan/{id}', 'BahanController@destroy'); //->Mneghapus data


  // ** API KOmoditi untuk dipasing ke profil IKM
  Route::get('/api/komoditi/staf', 'IkmController@apiKomoditiStaf');

  //Profil data IKM yang dapat diedit oleh staf Profil IKM
  Route::get('/profilikm/{id}', 'IkmController@showIkm');

  Route::put('/profilikm/{id}/{idUser}', 'IkmController@update'); //-> Proses edit data
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

  // ** Kelola Komoditi
  Route::get('/komoditi', 'KomoditiController@show');
  Route::get('/api/komoditi', 'KomoditiController@apiKomoditi')->name('api.komoditi');
    Route::get('/api/komoditi/admin', 'KomoditiController@apiKomoditiAdmin')->name('api.komoditiAdmin');
  Route::post('/komoditi', 'KomoditiController@store')->name('admin.addKomoditi');
  Route::get('/komoditi/{id}/edit', 'KomoditiController@formEdit'); //--> menampilkan data di form edit
  Route::patch('/komoditi/{id}', 'KomoditiController@update'); //-> Proses edit data
  Route::delete('/komoditi/{id}', 'KomoditiController@destroy'); //->Mneghapus data


  // ** mengelola daftar kriteria
  //Bahan Baku Profil IKM
  Route::get('/kriteria', 'KriteriaController@show');
  Route::get('/api/kriteria', 'KriteriaController@apiKriteria')->name('api.kriteria');

  Route::post('/kriteria', 'KriteriaController@store')->name('add.kriteria');
  Route::get('/kriteria/{id}/edit', 'KriteriaController@formEdit'); //--> menampilkan data di form edit
  Route::patch('/kriteria/{id}', 'KriteriaController@update'); //-> Proses edit data
  Route::delete('/kriteria/{id}', 'KriteriaController@destroy'); //->Mneghapus data


  // ** Pencarian Bobot Kriteria
  Route::get('/kriteria-ahp', 'KriteriaController@showAhp')->name('pembobotan');

  Route::post('/bobot/perbandingan', 'PerhitunganController@showMatrik');
  Route::post('/bobot/perbandingan/simpan', 'PerhitunganController@update');

  // Melakukan perangkingan
  Route::get('/perangkingan', 'PerangkinganController@showData');
  Route::post('/perangkingan/hasil', 'PerangkinganController@showHasil');

  //API tahun yang ada
    Route::get('/api/tahun/ready', 'PerangkinganController@apiTahunReady');

  //Kelola data penerima
  Route::post('/perangkingan/pilih', 'PenerimaController@createPerangkingan');

  //Daftar penerima IKM
  Route::get('/penerima', 'PenerimaController@show');
  Route::get('/api/penerima', 'PenerimaController@apiPenerima')->name('api.penerima');


  Route::delete('/penerima/{id}/{idUser}', 'PenerimaController@destroy'); //->Mneghapus data

});



Route::group(['middleware' => 'staf'], function(){
  Route::get('/staf', 'StafController@dashboard');

  Route::get('/validasi', 'ValidasiController@showValidasi');
  Route::get('/api/ikm-validasi', 'ValidasiController@apiValidasi')->name('api.valid');  //API untuk menampilkan data profil IKM yang belum tervalidasi
  Route::get('/validasi/{id}/edit', 'ValidasiController@formEdit'); //memunculkan modal validasi
  Route::patch('/validasi/{id}', 'ValidasiController@updateStatus'); //menyimpan hasil validasi


  //--> Kelola Profil IKM
  // Route::get('/kelola-ikm', 'ProfilIkmController@showKelola');
  // Route::get('/api/kelola-ikm', 'ProfilIkmController@apiKelola')->name('api.kelolaIkm');  //API untuk menampilkan data profil IKM yang belum tervalidasi

  Route::get('/profil/{id}/edit', 'ProfilIkmController@showModal'); //--> arahkan ke modal EDIT
  Route::patch('/profil/{id}', 'ProfilIkmController@update'); //-> Proses edit data
  Route::delete('/profil/{id}', 'ProfilIkmController@destroy');
  Route::post('/profil/store', 'ProfilIkmController@store')->name('staf.addIkm');



  // ** Untek membuat login IKM Baru
  Route::get('/kelola-ikm', 'StafController@showIkm');
  Route::get('/add-ikm', 'StafController@addIkm');
  Route::get('/api/ikm', 'StafController@apiIkm')->name('api.ikm');
  Route::post('/add-ikm', 'Auth\RegisterIkmController@register')->name('addIkm');

  Route::delete('/kelola-ikm/{id}', 'StafController@destroy');
  Route::get('/kelola-ikm/{id}/edit', 'StafController@formEdit');
  Route::patch('/kelola-ikm/{id}', 'StafController@update');


  // ** Keloal Data Kriteria 'funday'
  Route::get('/data-kriteria/{idUser}', 'DataKriteriaController@showTahun');
  Route::get('api/data-kriteria/tahun/{idUser}', 'DataKriteriaController@apiListTahun');
  Route::get('/api/data-kriteria/{idUser}', 'DataKriteriaController@apiTahun');

  Route::get('/data-kriteria/{idUser}/add', 'DataKriteriaController@showAdd');
  Route::post('/data-kriteria/{id}', 'DataKriteriaController@store');
  Route::get('/data-kriteria/{idUser}/{tahun}/edit', 'DataKriteriaController@showEdit');
  Route::put('/data-kriteria/{idUser}/{tahun}', 'DataKriteriaController@update');
  Route::delete('/data-kriteria/{idUser}/{tahun}', 'DataKriteriaController@destroy');

  // ** API data kriteria untuk di tampilkan di sumary profil IKM
  Route::get('/api/ikm/data-kriteria/{idUser}', 'DataKriteriaController@apiSumaryProfil');


  // ** show sumary all data for IKM profile
  Route::get('/ikm/show/{id}', 'StafController@showSumaryIkm');
});


Route::group(['middleware' => ['ikm']], function(){
  Route::get('/ikm', 'IkmController@dashboard');

  Route::get('/profil', 'ProfilIkmController@show');
  Route::put('/profil/{id}', 'ProfilIkmController@update');

  Route::get('/evaluasi', 'IkmController@showEvaluasi');

});


Auth::routes();
