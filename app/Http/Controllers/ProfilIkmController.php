<?php

namespace App\Http\Controllers;

use Auth;
use App\ProfilIkm;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ProfilIkmController extends Controller
{

    public function index()
    {

    }

    public function create()
    {
        //
    }




    public function store(Request $request)
    {


    }


    public function show(ProfilIkm $profilIkm)
    {
      return view('ikm.profil');
    }



    public function edit(ProfilIkm $profilIkm)
    {
        //
    }


    //--> User IKM hanya bisa mengupdate IKMnya sendiri
    public function update(Request $request, $id)
    {
      $lamaBerdiri = $request -> lamaBerdiri;
      $rerataProduksi = $request -> rerataProduksi;
      $rerataHarga = $request -> rerataHarga;
      $rerataPenjualan = $request -> rerataPenjualan;
      $totalPeralatan = $request -> totalPeralatan;
      $totalBahanBaku = $request -> totalBahanBaku;
      $totalPekerja = $request -> totalPekerja;
      $jarak = $request -> jarak;


      //--> replace titik pada harga
      $lamaBerdiri = str_replace('.','',$lamaBerdiri);
      $rerataProduksi = str_replace('.','',$rerataProduksi);
      $rerataHarga = str_replace('.','',$rerataHarga);
      $rerataPenjualan = str_replace('.','',$rerataPenjualan);
      $totalPeralatan = str_replace('.','',$totalPeralatan);
      $totalBahanBaku = str_replace('.','',$totalBahanBaku);
      $totalPekerja = str_replace('.','',$totalPekerja);
      $jarak = str_replace('.','',$jarak);

      //--> Validasi angka yang dimasukkan tidak boleh 0 atau minus
      if($lamaBerdiri < 1 || $rerataProduksi < 1 || $rerataHarga < 1
          || $rerataPenjualan < 1 || $totalPeralatan < 1 || $totalBahanBaku < 1 ||
          $totalPekerja < 1 || $jarak < 1
      )
      {
        return redirect('/profil')->with('warning', 'Setiap angka nominal yang diinput ke dalam form tidak boleh bernilai nol (0) atau kurang dari 1');
      }


      $namaUsaha = $request -> nama;
      $merkProduk = $request -> merk;
      $alamat = $request -> alamat;
      $telepon = $request -> telepon;
      $jenisProduk = $request -> jenisProduk;
      $lokasiPemasaran = $request -> tempatPemasaran;
      $jenisBimtek = $request -> jenisBimtek;
      $permasalahan = $request -> permasalahan;


      $this -> validate($request, [
              'lamaBerdiri' => 'required|min:1',
              'rerataProduksi' => 'required|min:1',
            ]);

      $profil = ProfilIkm::findOrFail($id);


      $profil -> update([
                'nama_usaha' => $namaUsaha,
                'lama_berdiri' => $lamaBerdiri,
                'merk_produk' => $merkProduk,
                'alamat' => $alamat,
                'telpon' => $telepon,
                'jenis_produk' => $jenisProduk,
                'rerata_produksi' => $rerataProduksi,
                'rerata_harga' => $rerataHarga,
                'rerata_penjualan' => $rerataPenjualan,
                'tempat_pemasaran' => $lokasiPemasaran,
                'total_peralatan' => $totalPeralatan,
                'total_bahan_baku' => $totalBahanBaku,
                'total_pekerja' => $totalPekerja,
                'jarak' => $jarak,
                'permasalahan' => $request -> permasalahan,
                'jenis_bimtek' => $request -> jenisBimtek,

            ]);

      return redirect('/profil')->with('status', 'Selamat anda berhasil memasukkan data profil IKM Anda');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProfilIkm  $profilIkm
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfilIkm $profilIkm)
    {
        //
    }
}
