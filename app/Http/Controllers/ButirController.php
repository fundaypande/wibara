<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Butir;
use App\User;
use Auth;
use Yajra\Datatables\Datatables;

class ButirController extends Controller
{
  public function show()
  {
    return view('admin.butir.show');
  }

  // public function apiButir()
  // {
  //   return $butir = Butir::get();
  // }

  public function apiButir()
  {
    $butir = Butir::get();


    return Datatables::of($butir)
      -> addColumn('action', function($butir){
        return '
          <a onclick="editData(' . $butir-> id . ')" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i>Edit</a>
          <a onclick="deleteData(' . $butir-> id . ')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
        ';
      })
      ->make(true);
  }

  //--> Input data ke database
  public function store(Request $request)
  {
    $this -> validate($request, [
            'thk' => 'required|min:1',
            'aspect' => 'required|min:1',
            'indicator' => 'required|min:1',
            'component' => 'required|min:1',
          ]);

    return Butir::create([
      'thk' => $request -> get('thk'),
      'aneka' => $request -> get('component'),
      'aspek' => $request -> aspect,
      'butir' => $request -> indicator,
    ]);
  }


  //--> mengambil data untuk kita edit
  public function formEdit($id)
  {
    return $butir = Butir::find($id);
  }


  public function update(Request $request, $id)
  {
    $butir = Butir::find($id);

    $this -> validate($request, [
      'thk' => 'required|min:1',
      'aspect' => 'required|min:1',
      'indicator' => 'required|min:1',
      'component' => 'required|min:1',
          ]);

    $butir -> update([
      'thk' => $request -> get('thk'),
      'aneka' => $request -> get('component'),
      'aspek' => $request -> aspect,
      'butir' => $request -> indicator,
    ]);

    return $butir;
  }


  public function destroy($id)
  {
      Butir::destroy($id);
  }
}
