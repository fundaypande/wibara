<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JenisPeralatan;
use Auth;
use App\User;
use Yajra\Datatables\Datatables;

class PeralatanController extends Controller
{
  public function show($id)
  {
    $idUser = $id;
    $user = User::findOrFail($id);
    $peralatan = JenisPeralatan::where('user_id', '=', $idUser)->get();

    return view('ikm.peralatan.peralatan', ['peralatans' => $peralatan], ['user' => $user]);
  }



  //-> API untuk menampilkan data peralatan IKM
  public function apiPeralatan($id)
  {
    $idUser = $id;
    $peralatan = JenisPeralatan::where('user_id', '=', $idUser)->get();


    return Datatables::of($peralatan)
      -> addColumn('action', function($peralatan){
        return '
          <a onclick="showData(' . $peralatan-> id . ')" class="btn btn-info btn-xs"><i class="fa fa-eye"></i>Show</a>
          <a onclick="editData(' . $peralatan-> id . ')" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i>Edit</a>
          <a onclick="deleteData(' . $peralatan-> id . ')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
        ';
      })
      -> addColumn('ket', function($peralatan){
        $deskripsi = $peralatan-> spesifikasi;
        $deskripsi = substr($deskripsi, 0, 40);
        if (strlen($deskripsi) > 39) {
          $deskripsi = $deskripsi . "[...]";
        }

        return $deskripsi;
      })
      ->make(true);
  }


  //--> Input data ke database
  public function store(Request $request, $id)
  {
    $this -> validate($request, [
            'jenis_alat' => 'required|min:1',
          ]);

    return JenisPeralatan::create([
      'user_id' => $id,
      'jenis_alat' => $request -> jenis_alat,
      'tahun' => $request -> tahun,
      'spesifikasi' => $request -> spesifikasi,
      'kapasitas' => $request -> kapasitas,
      'jumlah' => $request -> jumlah,
      'buatan' => $request -> buatan,
      'harga' => $request -> harga,
      'asal' => $request -> asal,
      'tahunInput' => $request -> get('tahunInput'),
    ]);
  }

  //--> mengambil data untuk kita edit
  public function formEdit($id)
  {
    return $peralatan = JenisPeralatan::find($id);
  }

  public function update(Request $request, $id)
  {
    $peralatan = JenisPeralatan::find($id);

    $this -> validate($request, [
            'jenis_alat' => 'required|min:2',
            'tahun' => 'required|min:1',
          ]);

    $peralatan -> update([
      'jenis_alat' => $request -> jenis_alat,
      'tahun' => $request -> tahun,
      'spesifikasi' => $request -> spesifikasi,
      'kapasitas' => $request -> kapasitas,
      'jumlah' => $request -> jumlah,
      'buatan' => $request -> buatan,
      'harga' => $request -> harga,
      'asal' => $request -> asal,
      'tahunInput' => $request -> get('tahunInput'),
    ]);

    return $peralatan;
  }

  public function destroy($id)
  {
      JenisPeralatan::destroy($id);
  }
}
