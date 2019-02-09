<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\BahanBaku;
use App\JenisPeralatan;
use App\NilaiProduksi;
use App\ProfilIkm;
use App\Komoditi;
use Yajra\Datatables\Datatables;

class IkmController extends Controller
{
  public function __construct()
  {
      // $this->middleware('auth');
  }

  public function dashboard(){

    // --> return view('Ke halaman staf')
    die('ini halaman STAF');
  }


  // ** API Komoditi
  public function apiKomoditiStaf()
  {
    return $komoditi = Komoditi::get();
  }

  public function show($id)
  {
    $profils = ProfilIkm::findOrFail($id);
    $userId = $profils -> user_id;
    $bahanBaku = BahanBaku::where('user_id', '=', $userId)->get();
    $komoditi = Komoditi::all();

    return view('ikm.show', ['profils' => ProfilIkm::findOrFail($id)], ['bahanBaku' => $bahanBaku]);
  }



  // ** Profl IKM yang bisa diedit oleh STAF

  public function showIkm($id)
  {
    $user = User::findOrFail($id);
    $profil = ProfilIkm::join('komoditis', 'komoditis.id', '=', 'profilikm.komoditi_id')
                ->select('profilikm.*', 'komoditis.nama')
                ->where('user_id', '=', $id)->get();

    // dd($profil);

    return view('staf.ikm.profilIkm', ['user' => $user], ['profil' => $profil]);
  }


  public function apiProfil($id)
  {
    $idUser = $id;

    $bahan = ProfilIkm::where('user_id', '=', $idUser)->get();


    return Datatables::of($bahan)
      -> addColumn('action', function($bahan){
        return '
          <a onclick="editData(' . $bahan-> id . ')" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i>Edit</a>
          <a onclick="deleteData(' . $bahan-> id . ')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
        ';
      })
      ->make(true);
  }


  public function update(Request $request, $id, $idUser)
  {
    $bahan = ProfilIkm::find($id);

    $this -> validate($request, [
            'nama_usaha' => 'required|min:2',
            'badan_hukum' => 'required|min:1',
            'izin_usaha' => 'required|min:1',
            'merk_produk' => 'required|min:1',
            'alamat' => 'required|min:1',
            'telpon' => 'required|min:1',
            'tempat_pemasaran' => 'required|min:1',
          ]);

    $bahan -> update([
      'komoditi_id' => $request -> get('komoditi'),
      'nama_usaha' => $request -> nama_usaha,
      'badan_hukum' => $request -> badan_hukum,
      'izin_usaha' => $request -> izin_usaha,
      'merk_produk' => $request -> merk_produk,
      'alamat' => $request -> alamat,
      'telpon' => $request -> telpon,
      'jenis_produk' => $request -> jenis_produk,
      'tempat_pemasaran' => $request -> tempat_pemasaran,
      'permasalahan' => $request -> permasalahan,
      'jenis_bimtek' => $request -> jenis_bimtek,

    ]);

    return redirect('/profilikm/'.$idUser)->with('status', 'Berhasil menyimpan data');
  }


  // ** end profil IKM



}
