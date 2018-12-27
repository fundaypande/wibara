<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NilaiProduksi;
use Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Validator;

class ProduksiController extends Controller
{
    public function showProduksi()
    {
      return view('ikm.produksi.produksi');
    }

    //-> API untuk menampilkan data produksi IKM
    public function apiProduksi()
    {
      $idUser = Auth::user()->id;
      $staf = NilaiProduksi::where('user_id', '=', $idUser)->get();


      return Datatables::of($staf)
        -> addColumn('action', function($staf){
          return '
            <a href="#" class="btn btn-info btn-xs"><i class="fa fa-eye"></i>Show</a>
            <a onclick="editData(' . $staf-> id . ')" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i>Edit</a>
            <a onclick="deleteData(' . $staf-> id . ')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
          ';
        })
        -> addColumn('photos', function($staf){
          if(!$staf->photo) $photo = 'images/user.png'; else $photo = 'images/produksi/'.$staf->photo;
          return '
            '.$photo.'
          ';
        })
        ->make(true);
    }

    public function store(Request $request)
    {
      // $userId = Auth::user() -> id;
      // $jenisProduksi = $request -> jenis_produksi;
      // $jumlah = $request -> jumlah;
      // $harga = $request -> harga;
      // $nilaiPenjualan = $request -> nilai_penjualan;
      // $tujuan = $request -> tujuan;
      // $deskripsi = $request -> deskripsi;
      //
      //
      //
      // //--> replace titik pada harga
      // $jumlah = str_replace('.','',$jumlah);
      // $harga = str_replace('.','',$harga);
      // $nilaiPenjualan = str_replace('.','',$nilaiPenjualan);


      // --> Validasi angka yang dimasukkan tidak boleh 0 atau minus
      // if($jumlah < 1 || $harga < 1 || $nilaiPenjualan < 1
      // )
      // {
      //   return redirect('/produksi')->with('warning', 'Setiap angka nominal yang diinput ke dalam form tidak boleh bernilai nol (0) atau kurang dari 1');
      // }


      $validator -> validate($request, [
              // 'jenis_produksi' => 'required|min:20',
              // 'jumlah' => 'required|min:1',
              // 'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                  if($request->ajax())
                  {
                      return response()->json(array(
                          'success' => false,
                          'message' => 'There are incorect values in the form!',
                          'errors' => $validator->getMessageBag()->toArray()
                      ), 422);
                  }
                  $this->throwValidationException(
                      $request, $validator
                  );
              }

    //--> Upload Gambar
      // $input = $request->gambar;
      // $input = time().'.'.$request->gambar->getClientOriginalExtension();
      // $request->gambar->move('images/produksi', $input);


      // $data = [
      //   'user_id' => $userId,
      //   'jenis_produksi' => $jenisProduksi,
      //   'jumlah' => $jumlah,
      //   'alamat' => $alamat,
      //   'harga' => $harga,
      //   'nilai_penjualan' => $nilaiPenjualan,
      //   'tujuan' => $tujuan,
      //   'deskripsi' => $deskripsi,
      //   'photo' => $input,
      // ];

      return 'NilaiProduksi::create($data)';
    }
}
