<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kriteria;
use App\User;
use App\NilaiKriteria;
use Auth;
use Yajra\Datatables\Datatables;

class KriteriaController extends Controller
{
  public function show()
  {
    return view('admin.kriteria.kriteria');
  }

  public function showAhp()
  {
    $kriteria = Kriteria::all();
    $nilai = NilaiKriteria::all();

    // dd($nilai);

    return view('admin.kriteria.bobot', ['kriterias' => $kriteria], ['nilai' => $nilai]);
  }



  //-> API untuk menampilkan data peralatan IKM
  public function apiKriteria()
  {
    $kriteria = Kriteria::all();

    return Datatables::of($kriteria)
      -> addColumn('action', function($kriteria){
        return '
          <a onclick="editData(' . $kriteria-> id . ')" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i>Edit</a>
          <a onclick="deleteData(' . $kriteria-> id . ')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
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

    return Kriteria::create([
      'nama' => $request -> nama,
      'keterangan' => $request -> get('keterangan'),
    ]);
  }

  //--> mengambil data untuk kita edit
  public function formEdit($id)
  {
    return $kriteria = Kriteria::find($id);
  }

  public function update(Request $request, $id)
  {
    $kriteria = Kriteria::find($id);

    $this -> validate($request, [
            'nama' => 'required|min:2',
          ]);

    $kriteria -> update([
      'nama' => $request -> nama,
      'keterangan' => $request -> get('keterangan'),
    ]);

    return $kriteria;
  }

  public function destroy($id)
  {
      Kriteria::destroy($id);
  }
}
