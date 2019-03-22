<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Butir;
use App\DataForm;
use App\DataAverage;
use App\Form;
use Auth;
use Yajra\Datatables\Datatables;

class DataAverageController extends Controller
{

  public function show($idForm)
  {
    $aneka = ['Accountability','Nationalism','Public-Ethics','Quality-Commitment', 'Anti-Corruption'];
    $thk = ['Parahyangan','Pawongan','Palemahan'];

    $form = Form::findOrFail($idForm);
    $butir = Butir::all();

    if($form -> user_id != Auth::user() -> id){
      return redirect()->back()->with('warning', 'You are not the owner of this form');
    }

    //membagi data2 ke kolom aray
    for ($i=0; $i < count($aneka); $i++) {
      for ($j=0; $j < count($thk); $j++) {
        $minAneka[] = DataAverage::where('form_id', '=', $idForm)
                  ->join('butir', 'butir.id', '=', 'data_averages.butir_id')
                  ->where('aneka', '=', $aneka[$i])
                  ->where('thk', '=', $thk[$j])
                  ->get();
      }
    }


    //mengambil nilai average dan dikelompokakn
    for ($a=0; $a < count($minAneka); $a++) {
      for ($i=0; $i < count($minAneka[$a]); $i++) {
        $data[$a][$minAneka[$a][$i] -> butir_id] = $minAneka[$a][$i] -> average;
      }
    }


    // mencari nilai minimal dari masing2 kelompok
    for ($i=0; $i < count($minAneka); $i++) {
      $idMin = array_keys($data[$i], min($data[$i]));
      $dataMin = min($data[$i]);

      $arrayMin[] = [$idMin[0],$dataMin];
    }

    // dd($data);




    return view('evaluator.perangkingan.average')->with('form', $form)->with('arayMin', $arrayMin)->with('butir', $butir);
  }

  public function showTransaction($idForm)
  {
    $aneka = ['Accountability','Nationalism','Public-Ethics','Quality-Commitment', 'Anti-Corruption'];
    $thk = ['Parahyangan','Pawongan','Palemahan'];

    $form = Form::findOrFail($idForm);
    $butir = Butir::all();

    if($form -> user_id != Auth::user() -> id){
      return redirect()->back()->with('warning', 'You are not the owner of this form');
    }

    //membagi data2 ke kolom aray
    for ($i=0; $i < count($aneka); $i++) {
      for ($j=0; $j < count($thk); $j++) {
        $minAneka[] = DataAverage::where('form_id', '=', $idForm)
                  ->join('butir', 'butir.id', '=', 'data_averages.butir_id')
                  ->where('aneka', '=', $aneka[$i])
                  ->where('thk', '=', $thk[$j])
                  ->get();
      }
    }


    //mengambil nilai average dan dikelompokakn
    for ($a=0; $a < count($minAneka); $a++) {
      for ($i=0; $i < count($minAneka[$a]); $i++) {
        $data[$a][$minAneka[$a][$i] -> butir_id] = $minAneka[$a][$i] -> average;
      }
    }


    // mencari nilai minimal dari masing2 kelompok
    for ($i=0; $i < count($minAneka); $i++) {
      $idMin = array_keys($data[$i], min($data[$i]));
      $dataMin = min($data[$i]);

      $arrayMin[] = [$idMin[0],$dataMin];
    }

    // dd($data);




    return view('evaluator.perangkingan.transaction')->with('form', $form)->with('arayMin', $arrayMin)->with('butir', $butir);
  }

  public function apiAverage($idForm)
  {
    $average = DataAverage::where('form_id', '=', $idForm)
              ->join('butir', 'butir.id', '=', 'data_averages.butir_id')
              ->get();

    // dd($average);


    return Datatables::of($average)
      ->make(true);
  }


  public function update(Request $request, $idForm)
  {
    $dataAverage = DataAverage::where('form_id', '=', $idForm)
                    -> get();

    // dd($dataAverage[0] -> id);

    for ($i=0; $i < count($dataAverage); $i++) {
      $dataIdAverage = DataAverage::findOrFail($dataAverage[$i] -> id);

      $dataIdAverage -> update([
        'average' => $request -> get($i),
      ]);
    }

    // return redirect()->back()->with('status', 'Average Updated');
    return redirect('/transaction/'.$idForm);
  }


}
