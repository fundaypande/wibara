<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProfilIkm;
use App\DataKriteria;
use App\NilaiProduksi;
use App\BahanBaku;
use App\JenisPeralatan;
use App\Kriteria;
use App\User;
use Auth;

use Yajra\Datatables\Datatables;

class ApiController extends Controller
{
  public function cekProfilIkm($id)
  {
    $profilikm = ProfilIkm::where('user_id', '=', $id)->first();
    $krit = Kriteria::all();
    $kriteria = DataKriteria::where('id_user', '=', $id)->get();
    $produksi = NilaiProduksi::where('user_id', '=', $id)->get();
    $bahan = BahanBaku::where('user_id', '=', $id)->get();
    $peralatan = JenisPeralatan::where('user_id', '=', $id)->get();

    //tahun di data kriteria
    $dataKrit = DataKriteria::where('id_user', '=', $id)
                ->select('tahun', 'id_user')
                ->distinct()
                ->get();

    // dd($dataKrit);

    $hasil = null;
    $jumlahKriteria = $krit -> count();
    // $pembagiTahun = $dataKrit -> count();
    // $kriteriaTerdata = $kriteria -> count()/$pembagiTahun;  //bagi jumlah tahun
    //jika kriteria terdata = kriteria sebenarnya maka semua data masuk
    // dd($kriteria -> count()/$dataKrit -> count());
    // dd($jumlahKriteria);

    $hasil[0] = 'btn-primary';
    $hasil[1] = 'btn-primary';
    $hasil[2] = 'btn-primary';
    $hasil[3] = 'btn-primary';
    $hasil[4] = 'btn-primary';

    if($profilikm -> nama_usaha === null){
      $hasil[0] = 'btn-danger';
    }

    //cek kriteria
    // dd($kriteria);
    if($dataKrit -> count() == 0){
      $hasil[1] = 'btn-danger';
    } else if($kriteria -> count()/$dataKrit -> count() != $jumlahKriteria){
      $hasil[1] = 'btn-danger';
    } else {
      foreach ($kriteria as $key => $value) {
        // echo $kriteria[$key] -> nilai;
        // echo "<br>";
        if($kriteria[$key] -> nilai === null || $kriteria[$key] -> nilai === '0.00'){
          $hasil[1] = 'btn-danger';
        }
      }
      // dd('stop');
    }

    //cek produksi
    if($produksi->count() == 0){
      $hasil[2] = 'btn-danger';
    }

    //cek produksi
    if($bahan->count() == 0){
      $hasil[3] = 'btn-danger';
    }

    //cek peralatan
    if($peralatan->count() == 0){
      $hasil[4] = 'btn-danger';
    }

    // dd($hasil);

    return json_encode($hasil);
  }

}
