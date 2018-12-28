<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NilaiProduksi;
use Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\Token;

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
      $file = Input::file('photo');
      $input = null;

      if ($file)
      {
          $input = time().'.'.$file->getClientOriginalExtension();
          $file->move('images/produksi', $input);
      }



      $this -> validate($request, [
              'jenis_produksi' => 'required|min:1',
              // 'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

      // $gambar = $request->file('photo');
      // $input = time().'.'.$gambar->getClientOriginalExtension();
      // // $request->file('photo')

      return NilaiProduksi::create([
        'user_id' => Auth::user()->id,
        'jenis_produksi' => $request -> jenis_produksi,
        'jumlah' => $request -> jumlah,
        'merk_produk' => $request -> merk_produk,
        'harga' => $request -> harga,
        'nilai_penjualan' => $request -> nilai_penjualan,
        'tujuan' => $request -> tujuan,
        'deskripsi' => $request -> deskripsi,
        'photo' => $input,
      ]);
    }

    public function store2(Request $request)
    {
      $this -> validate($request, [
              'jenis_produksi' => 'required|min:1',
              'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

      $input = $request->photo;
      $input = time().'.'.$request->photo->getClientOriginalExtension();
      $request->photo->move('images/produksi', $input);

      $hasil = NilaiProduksi::create([
        'user_id' => Auth::user()->id,
        'jenis_produksi' => $request -> jenis_produksi,
        'jumlah' => $request -> jumlah,
        'merk_produk' => $request -> merk_produk,
        'harga' => $request -> harga,
        'nilai_penjualan' => $request -> nilai_penjualan,
        'tujuan' => $request -> tujuan,
        'deskripsi' => $request -> deskripsi,
        'photo' => $input,
      ]);

      return redirect('/produksi')->with('status', 'Berhasil menambahkan produksi baru');
    }

    public function showCreate()
    {
      return view('ikm.produksi.createProduksi');
    }

    public function destroy($id)
    {
        NilaiProduksi::destroy($id);
    }


}
