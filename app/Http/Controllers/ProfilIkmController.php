<?php

namespace App\Http\Controllers;

use Auth;
use App\ProfilIkm;
// use App\Kriteria;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ProfilIkmController extends Controller
{

    public function create()
    {
        //
    }




    public function store(Request $request)
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
        return redirect('/kelola-ikm')->with('warning', 'Setiap angka nominal yang diinput ke dalam form tidak boleh bernilai nol (0) atau kurang dari 1');
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
              'lamaBerdiri' => 'required|min:1|numeric',
              'rerataProduksi' => 'required|min:1',

            ]);
      $data = [
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
        'status' => 1,
      ];

      return ProfilIkm::create($data);

    }


    public function show(ProfilIkm $profilIkm)
    {
      $idUser = Auth::user()->id;
      // $kriteria = Kriteria::all();

      return view('ikm.profil');
    }

    //-> Menampikan data profil IKM untuk dikelola oleh STAF
    public function showKelola()
    {
      return view('staf.kelolaIkm');
    }

    public function showModal($id)
    {
      $ikm = ProfilIkm::find($id);

      return $ikm;
    }

    //-> API untuk menampilkan data profil IKM
    public function apiKelola()
    {
      $staf = ProfilIkm::orderBy('id', 'DESC')->get();


      return Datatables::of($staf)
        -> addColumn('action', function($staf){
          return '
            <a href="/ikm/' . $staf-> id . '" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-eye"></i>Show</a>
            <a onclick="editData(' . $staf-> id . ')" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i>Edit</a>
            <a onclick="deleteData(' . $staf-> id . ')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
          ';
        })->make(true);
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

      if(Auth::user()->role == 1) {
        return redirect('/profil')->with('status', 'Selamat anda berhasil memasukkan data profil IKM Anda');
      }

      return $profil;
    }


    public function destroy($id)
    {
        ProfilIkm::destroy($id);
    }
}
