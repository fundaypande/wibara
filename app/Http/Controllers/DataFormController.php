<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Butir;
use App\DataForm;
use App\User;
use App\Form;
use Auth;
use Yajra\Datatables\Datatables;

class DataFormController extends Controller
{
  public function showForm($formId, $hash)
  {
    $form = Form::findOrFail($formId);
    $butir = Butir::all();

    //jika URL tidak sesuai maka tampilkan abort
    if($form -> hash != $hash) abort(404);

    return view('responden.show')->with('form', $form)->with('butir', $butir);
  }

  // public function apiButir()
  // {
  //   return $butir = Butir::get();
  // }

  //--> Input data ke database
  public function store(Request $request, $id)
  {
    // dd($request -> all());

    $butir = Butir::all();

    // dd($request -> get($butir[0] -> id));
    // dd($butir[0] -> id);

    for ($i=0; $i < count($butir); $i++) {

      try {
            DataForm::create([
              'form_id' => $id,
              'butir_id' => $butir[$i] -> id,
              'name' => $request -> name,
              'email' => $request -> email,
              'affiliation' => $request -> affiliation,
              'nilai' => $request -> get($butir[$i] -> id),
              'uniq' => $id.$butir[$i] -> id.$request -> email,
            ]);
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return redirect()->back()->with('warning', 'Duplicate email');
            }
        }

    }

    // return $data;

    return redirect('/form/success');
  }



  public function showSuccess($value='')
  {
    return view('responden.success');
  }


  //--> mengambil data untuk kita edit

}
