<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\BahanBaku;
use App\JenisPeralatan;
use App\NilaiProduksi;
use App\ProfilIkm;

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
}
