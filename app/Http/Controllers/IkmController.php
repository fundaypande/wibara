<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\BahanBaku;
use App\JenisPeralatan;
use App\NilaiProduksi;
use App\ProfilIkm;
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

  public function show($id)
  {
    $profils = ProfilIkm::findOrFail($id);
    $userId = $profils -> user_id;
    $bahanBaku = BahanBaku::where('user_id', '=', $userId)->get();

    return view('ikm.show', ['profils' => ProfilIkm::findOrFail($id)], ['bahanBaku' => $bahanBaku]);
  }



  // ** Profl IKM yang bisa diedit oleh STAF

  public function showIkm($id)
  {
    $user = User::findOrFail($id);
    $profil = ProfilIkm::where('user_id', '=', $id)->get();

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


  // ** end profil IKM



}
