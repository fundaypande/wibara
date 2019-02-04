<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BahanBaku;
use App\User;
use Auth;
use Yajra\Datatables\Datatables;

class BahanController extends Controller
{
  public function show($id)
  {
    $user = User::findOrFail($id);
    return view('ikm.bahan.bahan', ['user' => $user]);
  }



  //-> API untuk menampilkan data peralatan IKM
  public function apiBahan($id)
  {
    $idUser = $id;

    $bahan = BahanBaku::where('user_id', '=', $idUser)->get();


    return Datatables::of($bahan)
      -> addColumn('action', function($bahan){
        return '
          <a onclick="editData(' . $bahan-> id . ')" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i>Edit</a>
          <a onclick="deleteData(' . $bahan-> id . ')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
        ';
      })
      ->make(true);
  }


  //--> Input data ke database
  public function store(Request $request, $id)
  {
    $this -> validate($request, [
            'jenis_bahan' => 'required|min:1',
          ]);

    return BahanBaku::create([
      'user_id' => $id,
      'jenis_bahan' => $request -> jenis_bahan,
      'jumlah' => $request -> jumlah,
      'satuan' => $request -> satuan,
      'harga' => $request -> harga,
      'asal' => $request -> asal,
      'tahun' => $request -> get('tahun'),
    ]);
  }

  //--> mengambil data untuk kita edit
  public function formEdit($id)
  {
    return $peralatan = BahanBaku::find($id);
  }

  public function update(Request $request, $id)
  {
    $bahan = BahanBaku::find($id);

    $this -> validate($request, [
            'jenis_bahan' => 'required|min:2',
            'jumlah' => 'required|min:1',
          ]);

    $bahan -> update([
      'jenis_bahan' => $request -> jenis_bahan,
      'jumlah' => $request -> jumlah,
      'satuan' => $request -> satuan,
      'harga' => $request -> harga,
      'asal' => $request -> asal,
      'tahun' => $request -> get('tahun'),
    ]);

    return $bahan;
  }

  public function destroy($id)
  {
      BahanBaku::destroy($id);
  }
}
