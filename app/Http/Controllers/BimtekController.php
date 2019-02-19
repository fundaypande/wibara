<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bimtek;
use App\User;
use Auth;
use Yajra\Datatables\Datatables;

class BimtekController extends Controller
{
  public function show()
  {
    return view('admin.bimtek.show');
  }


  public function apiBimtek()
  {
    $bimtek = Bimtek::all();


    return Datatables::of($bimtek)
      -> addColumn('action', function($bimtek){
        return '
          <a onclick="editData(' . $bimtek-> id . ')" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i>Edit</a>
          <a onclick="deleteData(' . $bimtek-> id . ')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
        ';
      })
      ->make(true);
  }

  public function apiBimtekAll()
  {
    return Bimtek::all();
  }

  //--> Input data ke database
  public function store(Request $request)
  {
    $this -> validate($request, [
            'nama' => 'required|min:1',
            'tahun' => 'required|min:1',
            'keterangan' => 'required|min:1',
          ]);

    return Bimtek::create([
      'nama' => $request -> nama,
      'keterangan' => $request -> keterangan,
      'tahun' => $request -> get('tahun'),
    ]);
  }


  //--> mengambil data untuk kita edit
  public function formEdit($id)
  {
    return $bimtek = Bimtek::find($id);
  }


  public function update(Request $request, $id)
  {
    $bimtek = Bimtek::find($id);

    $this -> validate($request, [
      'nama' => 'required|min:1',
      'tahun' => 'required|min:1',
      'keterangan' => 'required|min:1',
          ]);

    $bimtek -> update([
      'nama' => $request -> nama,
      // 'keterangan' => $request -> get('keterangan'),
      'keterangan' => $request -> keterangan,
      'tahun' => $request -> get('tahun'),
    ]);

    return $bimtek;
  }


  public function destroy($id)
  {
      Bimtek::destroy($id);
  }
}
