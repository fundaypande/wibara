<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kriteria;
use App\DataKriteria;
use App\User;
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
          <a href="/data-kriteria/' . $dataKrit -> id_user . '/' . $dataKrit-> tahun . '" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i>Edit</a>
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


  public function showEdit($idUser)
  {
    //querykan tahun per satu persatu
    $dataKrit = DataKriteria::where('id_user', '=', $idUser)
                ->select('tahun')
                ->distinct()
                ->get();

    // dd($dataKrit);

    $user = User::findOrFail($idUser);
    $kriteria = Kriteria::all();

    return view('staf.data-kriteria.showEdit', ['user' => $user], ['kriterias' => $kriteria]);
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
      $name = $krit -> nama;
      $dataKrit = DataKriteria::create([
          'id_user' =>  $request -> idUser,
          'id_kriteria' => $krit -> id,
          'nilai' => $request -> $name,
          'tahun' => $request -> get('tahun'),
        ]);
    }

    return redirect('/data-kriteria/'.$id)->with('status', 'Berhasil menambahkan data kriteria baru');
  }

  //--> mengambil data untuk kita edit
  public function formEdit($id)
  {
    return $kriteria = Kriteria::find($id);
  }

  public function update(Request $request, $id)
  {
    $kriteria = Kriteria::find($id);

    $this -> validate($request, [
            'nama' => 'required|min:2',
          ]);

    $kriteria -> update([
      'nama' => $request -> nama,
      'keterangan' => $request -> keterangan,
    ]);

    return $kriteria;
  }

  public function destroy($id)
  {
      Kriteria::destroy($id);
  }
}
