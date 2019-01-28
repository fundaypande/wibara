<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Komoditi;
use App\User;
use Auth;
use Yajra\Datatables\Datatables;

class KomoditiController extends Controller
{
  public function show()
  {
    return view('admin.komoditi.show');
  }

  public function apiKomoditi()
  {
    $komoditi = Komoditi::get();


    return Datatables::of($komoditi)
      -> addColumn('action', function($komoditi){
        return '
          <a onclick="editData(' . $komoditi-> id . ')" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i>Edit</a>
          <a onclick="deleteData(' . $komoditi-> id . ')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
        ';
      })
      ->make(true);
  }

  //--> Input data ke database
  public function store(Request $request)
  {
    $this -> validate($request, [
            'nama' => 'required|min:1',
          ]);

    return Komoditi::create([
      'nama' => $request -> nama,
      'keterangan' => $request -> keterangan,
    ]);
  }


  //--> mengambil data untuk kita edit
  public function formEdit($id)
  {
    return $komoditi = Komoditi::find($id);
  }


  public function update(Request $request, $id)
  {
    $komoditi = Komoditi::find($id);

    $this -> validate($request, [
            'nama' => 'required|min:2',
          ]);

    $komoditi -> update([
      'nama' => $request -> nama,
      // 'keterangan' => $request -> get('keterangan'),
      'keterangan' => $request -> keterangan,
    ]);

    return $komoditi;
  }


  public function destroy($id)
  {
      Komoditi::destroy($id);
  }
}
