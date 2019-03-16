<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Form;
use App\DataForm;
use App\DataAverage;
use App\Outcome;
use App\User;
use App\Butir;
use App\Bobot;

use Auth;
use Yajra\Datatables\Datatables;

class FormController extends Controller
{
  public function show()
  {
    $form = Form::where('user_id', '=', Auth::user()->id)
                  -> get();

    return view('evaluator.form.show')->with('form', $form);
  }


  public function showData($id)
  {
    $form = Form::findOrFail($id);
    // $butir = Butir::all();

    $responden = DataForm::where('form_id', '=', $id)
                ->select('email')
                ->distinct()
                ->get();

    $idForm = DataForm::where('form_id', '=', $id)
                ->select('id')
                ->get();

    if($form -> user_id != Auth::user() -> id){
      return redirect()->back()->with('warning', 'You are not the owner of this form');
    }


    // dd($butirArray);
    //pengecekan jika tidak ada responden maka return view share
    if(count($responden) == 0){
      //jika tidak ada responden
      return view('evaluator.form.zeroRespon')->with('form', $form);
    } else {

      //cek jumlah butir dari dataform
      $butirArray = count($idForm)/count($responden);

      //** WARNING
      //untuk mendeteksi form yang senjang maka $butirArray ada modnya artinya
      //ada koma di hasil pembagian dengan butir sebenarnya (DP) maka form ini sudah timpang

      //membuat matrik data responden
      // dd($responden -> all());
      for ($i=0; $i < count($responden); $i++) {
        $data[] = DataForm::where('form_id', '=', $id)
                ->where('email', '=', $responden[$i] -> email)

                -> get();
        // $data = DataForm::where('email', '=', $responden[$i] -> email)
        //         -> get();
      }
      // dd($data);
      //membuat matrik data responden
      for ($i=0; $i < count($responden); $i++) {
        for ($j=0; $j < $butirArray; $j++) {
          $dataResponden[$i][$j] = $data[$i][$j] -> nilai;
        }
      }



      //mencari nilai rata2 per butir
      //mencari total dulu
      for ($i=0; $i < $butirArray; $i++) {
        $hasil = 0;
        for ($j=0; $j < count($responden); $j++) {
          $hasil = $hasil + $dataResponden[$j][$i];
        }
        $dataSum[$i] = $hasil;
      }

      //mencari rerata
      for ($n=0; $n < count($dataSum); $n++) {
        $average[$n] = $dataSum[$n]/count($responden);
        $average[$n] = round($average[$n],4);
      }

    }


    // dd($dataResponden);

    return view('evaluator.form.showDataForm')->with('form', $form)->with('responden', $responden)->with('dataResponden', $dataResponden)->with('butir', $butirArray)
                                              ->with('average', $average);
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

  //menambah data form baru
  public function createData(Request $request)
  {
    $bobot = Bobot::where('user_id', '=', Auth::user() -> id)
              -> get();

    $butir = Butir::all();

    // dd($bobot[0] -> nilai);

    if($bobot[0] -> nilai == 0.0000){
      return redirect('/weight')->with('warning', 'Please update the weight before create some form');
    }

    if(count($butir) == 0){
      return redirect()->back()->with('warning', 'Indicator is empty, please contact admin');
    }

    $form = Form::create([
      'user_id' => Auth::user() -> id,
      'hash' => time(),
    ]);

    //buat data average untuk responden
    $butir = Butir::all();

    for ($i=0; $i < count($butir); $i++) {
      //buat masing2 data average menjadi 0

      $dataAverage = DataAverage::create([
        'form_id' => $form -> id,
        'butir_id' => $butir[$i] -> id,
        'average' => 0
      ]);
    }


    //buat data outcomes untuk menampung data minimal hasil filtrasi
    for ($i=0; $i < 15; $i++) {
      // create data
      $outcome = Outcome::create([
        'form_id' => $form -> id,
        'butir_id' => $butir[$i] -> id,
        'average' => 0
        ]);
    }

    //buat data keputusan untuk menampung data perangkingan
    for ($i=0; $i < 15; $i++) {
      // create data
      $outcome = Outcome::create([
        'form_id' => $form -> id,
        'butir_id' => $butir[$i] -> id,
        'average' => 0
        ]);

    }

    // dd($form);

    return redirect()->back()->with('status', 'New form created with ID: '.$form -> id);
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
      Form::destroy($id);
  }
}
