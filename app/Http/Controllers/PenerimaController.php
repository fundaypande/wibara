<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penerima;
use App\ProfilIkm;
use App\User;
use App\DataEvaluasi;
use App\Kriteria;
use Auth;
use Yajra\Datatables\Datatables;

class PenerimaController extends Controller
{
  public function show()
  {


    // dd($penerima);

    return view('admin.penerima.penerima');
  }

  public function createPerangkingan(Request $request)
  {
    // $dataEval = DataEvaluasi::all();
    // dd($dataEval);

    //membuat data evaluasi kosong yang natinya bisa diedit oleh pelaku IKM
    $kriteria = Kriteria::all();
    $jumlahKriteria = $kriteria -> count();
    $idIkm = $request->user_id;
    // dd($idIkm);
    foreach ($kriteria as $key => $krit) {
      $name = $krit -> id;
      // dd($request -> $name);
      $dataEvaluasi = DataEvaluasi::create([
          'id_user' =>  $idIkm,
          'id_kriteria' => $krit->id,
          'nilai' => 0,
          'tahun' => $request->tahun,
        ]);
    }

    // dd('masuk data');

    $user_tahun = $request->user_id.$request->tahun;

    $user = User::findOrFail($request->user_id);
    $profilId = $user -> profilIkm -> id;
    // dd($profilId);
    $profil = ProfilIkm::findOrFail($profilId);

    $profil -> update([
      'status' => 1,
    ]);

    // dd($user_tahun);
    $data = Penerima::create([
      'user_id' => $request->user_id,
      'user_tahun' => $user_tahun,
      'komoditi_id' => $request -> komoditi_id,
      'tahun' => $request -> tahun,
    ]);

    // dd('BERHASIL');

    return $data;
  }



  //-> API untuk menampilkan data peralatan IKM
  public function apiPenerima()
  {

    $penerima = Penerima::
                   join('users', 'penerimas.user_id', '=', 'users.id')
                // -> join('komoditis', 'penerimas.user_id', '=', 'komoditis.id')
                -> select('penerimas.*', 'users.name')
                -> get();

    // dd($penerima);


    return Datatables::of($penerima)
      -> addColumn('action', function($penerima){
        return '
          <a onclick="deleteData(' . $penerima-> id . ', ' . $penerima-> user_id . ')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
        ';
      })
      ->make(true);
  }




  public function destroy($id, $idUser)
  {
    // dd($profilId);
    $user = User::findOrFail($idUser);
    $profilId = $user -> profilIkm -> id;

    $profil = ProfilIkm::findOrFail($profilId);

    //hapus juga data evaluasinya
    $dataEvaluasi = DataEvaluasi::where('id_user', '=', $idUser)->get();
    foreach ($dataEvaluasi as $key => $krit) {
      // dd($request -> idData);
      $name = $krit -> nama;
      $dataKrito = DataEvaluasi::destroy($krit -> id);
    }

    $profil -> update([
      'status' => 0,
    ]);

    Penerima::destroy($id);
  }
}
