<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kriteria;
use App\DataKriteria;
use App\User;
use App\ProfilIkm;
use App\DataEvaluasi;
use Auth;
use Yajra\Datatables\Datatables;

class DataKriteriaController extends Controller
{
  public function showTahun($idUser)
  {
    //querykan tahun per satu persatu
    $user = User::findOrFail($idUser);
    $kriteria = Kriteria::all();

    return view('staf.data-kriteria.showTahun', ['user' => $user], ['kriterias' => $kriteria]);
  }


  public function apiSumaryProfil($idUser)
  {
    $user = User::findOrFail($idUser);
    // menampilkan tahun2 dalam IKM
    $dataKrit = DataKriteria::join('kriterias', 'kriterias.id', '=', 'data_kriterias.id_kriteria')
                ->select('data_kriterias.*', 'kriterias.nama')
                ->where('id_user', '=', $idUser)
                ->get();

    return Datatables::of($dataKrit)
      ->make(true);
  }



  //-> API untuk menampilkan data peralatan IKM
  public function apiTahun($idUser)
  {
    $user = User::findOrFail($idUser);
    // menampilkan tahun2 dalam IKM
    $dataKrit = DataKriteria::where('id_user', '=', $idUser)
                ->select('tahun', 'id_user')
                ->distinct()
                ->get();


    return Datatables::of($dataKrit)
      -> addColumn('action', function($dataKrit){
        return '
          <a href="/data-kriteria/' . $dataKrit -> id_user . '/' . $dataKrit-> tahun . '/edit" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i>Edit</a>
          <a onclick="deleteData(' . $dataKrit -> id_user .',' . $dataKrit -> tahun . ')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
        ';
      })
      ->make(true);
  }


  public function apiListTahun($idUser)
  {
    // menampilkan tahun2 dalam IKM
    return $dataKrit = DataKriteria::where('id_user', '=', $idUser)
                ->select('tahun')
                ->distinct()
                ->get();
  }


  public function showAdd($idUser)
  {
    //querykan tahun per satu persatu
    $dataKrit = DataKriteria::where('id_user', '=', $idUser)
                ->select('tahun')
                ->distinct()
                ->get();

    // dd($dataKrit);
    $profilIkm = ProfilIkm::select('jarak')
                -> where('user_id', '=', $idUser)
                -> get();

    // dd($profilIkm);

    $user = User::findOrFail($idUser);
    $kriteria = Kriteria::all();

    return view('staf.data-kriteria.showAdd', ['user' => $user], ['kriterias' => $kriteria])->with('profilIkm', $profilIkm);
  }


  //--> Input data ke database
  public function store(Request $request, $id)
  {

    $kriteria = Kriteria::all();
    $jumlahKriteria = $kriteria -> count();

    if(!$request -> tahun) return back()->with('warning', 'Pilih Tahun');;

    // dd($request -> all());
    $this -> validate($request, [
            'tahun' => 'required|min:3',
          ]);

    foreach ($kriteria as $key => $krit) {
      $name = $krit -> id;
      // dd($request -> $name);
      $dataKrit = DataKriteria::create([
          'id_user' =>  $request -> idUser,
          'id_kriteria' => $krit -> id,
          'nilai' => $request -> $name,
          'tahun' => $request -> get('tahun'),
        ]);
    }

    return redirect('/data-kriteria/'.$id)->with('status', 'Berhasil menambahkan data kriteria baru');
  }



  public function showEdit($idUser, $tahun)
  {
    //querykan tahun per satu persatu
    $dataKrit = DataKriteria::join('kriterias', 'kriterias.id', '=', 'data_kriterias.id_kriteria')
                ->select('data_kriterias.*', 'kriterias.nama')
                ->where([
                    ['id_user', '=', $idUser],
                    ['tahun', '=', $tahun]
                  ])
                ->get();

    $kriteria = Kriteria::all();


    $user = User::findOrFail($idUser);

    return view('staf.data-kriteria.showEdit', ['user' => $user], ['dataKrit' => $dataKrit])->with('kriteria', $kriteria);
  }

  //--> Input data ke database
  public function update(Request $request, $idUser, $tahun)
  {
    $kriteria = Kriteria::all();
    $dataKrit = DataKriteria::join('kriterias', 'kriterias.id', '=', 'data_kriterias.id_kriteria')
                ->select('data_kriterias.*', 'kriterias.nama')
                ->where([
                    ['id_user', '=', $idUser],
                    ['tahun', '=', $tahun]
                  ])
                ->get();

    //update itu hapus dulu baru buat ulang
    foreach ($dataKrit as $key => $krit) {
      // dd($request -> idData);
      $name = $krit -> nama;
      $dataKrito = DataKriteria::destroy($krit -> id);

    }


    foreach ($kriteria as $key => $krit) {
      $name = $krit -> id;
      // dd($request -> $name);
      $dataKrit = DataKriteria::create([
          'id_user' =>  $request -> idUser,
          'id_kriteria' => $krit -> id,
          'nilai' => $request -> $name,
          'tahun' => $tahun,
        ]);
    }

    // dd($dataKrit);

    // foreach ($dataKrit as $key => $krit) {
    //   // dd($request -> idData);
    //   $name = $krit -> id;
    //   $dataKrito = DataKriteria::findOrFail($krit -> id);
    //
    //   $dataKrito -> update([
    //       'nilai' => $request -> $name,
    //     ]);
    // }

    return back()->with('status', 'Berhasil mengedit data kriteria baru');
  }



  public function destroy($idUser, $tahun)
  {
    $dataKrit = DataKriteria::join('kriterias', 'kriterias.id', '=', 'data_kriterias.id_kriteria')
                ->select('data_kriterias.*', 'kriterias.nama')
                ->where([
                    ['id_user', '=', $idUser],
                    ['tahun', '=', $tahun]
                  ])
                ->get();


    foreach ($dataKrit as $key => $krit) {
      // dd($request -> idData);
      $name = $krit -> nama;
      $dataKrito = DataKriteria::destroy($krit -> id);

    }

    return back()->with('status', 'Berhasil menghapus data kriteria baru');
  }
}
