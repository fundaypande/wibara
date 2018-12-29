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
            <a onclick="showData(' . $staf-> id . ')" class="btn btn-info btn-xs"><i class="fa fa-eye"></i>Show</a>
            <a href="/produksi/' . $staf-> id . '/edit" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i>Edit</a>
            <a onclick="deleteData(' . $staf-> id . ')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
          ';
        })
        -> addColumn('photos', function($staf){
          if(!$staf->photo) $photo = 'images/user.png'; else $photo = 'images/produksi/'.$staf->photo;
          return '
            '.$photo.'
          ';
        })
        -> addColumn('ket', function($staf){
          $deskripsi = $staf-> deskripsi;
          $deskripsi = substr($deskripsi, 0, 40);
          if (strlen($deskripsi) > 39) {
            $deskripsi = $deskripsi . "[...]";
          }

          return $deskripsi;
        })
        ->make(true);
    }

    public function edit($id)
    {
      $produksi = NilaiProduksi::findOrFail($id);

      return view('ikm.produksi.updateProduksi', compact('produksi'));
    }

    public function update(Request $request, $id)
    {
      $produksi = NilaiProduksi::findOrFail($id);

      $this -> validate($request, [
              'jenis_produksi' => 'required|min:1',
              'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

      $input = $request->gambar;
      if($input){
        $input = time().'.'.$request->gambar->getClientOriginalExtension();
        $request->gambar->move('images/produksi/', $input);
        $oldPic = $produksi -> photo;
        if($oldPic != null){
          $image_path = 'images/produksi/'.$oldPic;
          if(file_exists($image_path)){
              unlink($image_path); //unlink untuk menghapus foto lama pada saat proses create and store
          }
        }
        $produksi->update([
          'photo' => $input,
        ]);
      }



      $hasil = $produksi->update([
        'jenis_produksi' => $request -> jenis_produksi,
        'jumlah' => $request -> jumlah,
        'merk_produk' => $request -> merk_produk,
        'harga' => $request -> harga,
        'nilai_penjualan' => $request -> nilai_penjualan,
        'tujuan' => $request -> tujuan,
        'deskripsi' => $request -> deskripsi,
      ]);

      return redirect('/produksi')->with('status', 'Berhasil mengedit data produksi');
    }

    //--> mengambil data untuk kita edit
    public function formEdit($id)
    {
      return $peralatan = NilaiProduksi::find($id);
    }



    public function store2(Request $request)
    {
      $this -> validate($request, [
              'jenis_produksi' => 'required|min:1',
              'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);


      $input = $request->gambar;
      if($input){
        $input = time().'.'.$request->gambar->getClientOriginalExtension();
        $request->gambar->move('images/produksi/', $input);

      } else {
        $input = null;
      }

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
