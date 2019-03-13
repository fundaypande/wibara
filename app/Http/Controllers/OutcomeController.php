<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Butir;
use App\DataForm;
use App\DataAverage;
use App\Form;
use App\Outcome;
use App\Bobot;
use Auth;
use Yajra\Datatables\Datatables;

class OutcomeController extends Controller
{
  public function show($idForm)
  {
    $form = Form::findOrFail($idForm);

    $outcomesA = Outcome::where('form_id', '=', $idForm)
                -> join('butir', 'butir.id', '=', 'outcomes.butir_id')
                -> where('thk', '=', 'parahyangan')
                -> get();

    $outcomesB = Outcome::where('form_id', '=', $idForm)
                -> join('butir', 'butir.id', '=', 'outcomes.butir_id')
                -> where('thk', '=', 'pawongan')
                -> get();

    $outcomesC = Outcome::where('form_id', '=', $idForm)
                -> join('butir', 'butir.id', '=', 'outcomes.butir_id')
                -> where('thk', '=', 'palemahan')
                -> get();

    // dd($outcomesB);

    $bobot = Bobot::where('user_id', '=', Auth::user() -> id)
              // -> orderBy('thk', 'asc')
              -> get();

    //masukkan nilai minimal ke array
    $j=0;
    for ($i=0; $i < 5; $i++) {
      $dataOutcome[$i] = $outcomesA[$j] -> value;
      $j++;
    }
    $j=0;
    for ($i=5; $i < 10; $i++) {
      $dataOutcome[$i] = $outcomesB[$j] -> value;
      $j++;
    }
    $j=0;
    for ($i=10; $i < 15; $i++) {
      $dataOutcome[$i] = $outcomesC[$j] -> value;
      $j++;
    }




    //masukkan bobot ke dalam array
    for ($i=0; $i < count($bobot); $i++) {
      $dataBobot[$i][0] = $bobot[$i] -> antecedents;
      $dataBobot[$i][1] = $bobot[$i] -> transaction;
      $dataBobot[$i][2] = $bobot[$i] -> outcomes;
    }

    //masukkan average bobot ke dalam array
    for ($i=0; $i < count($bobot); $i++) {
      $dataAverage[$i] = $bobot[$i] -> average;
    }

    //masukkan value bobot ke dalam array
    for ($i=0; $i < count($bobot); $i++) {
      $nilaiBobot[$i] = $bobot[$i] -> nilai;
    }

    // dd($nilaiBobot);


    for ($i=0; $i < count($bobot); $i++) {
      for ($j=0; $j < 3; $j++) {
        // $dataNorm[2][0] = $dataOutcome[2]*$dataBobot[2][0]/$dataAverage[2];
        $dataNorm[$i][$j] = $dataOutcome[$i]*$dataBobot[$i][$j]/$dataAverage[$i];
      }
    }

    // dd($dataBobot);

    $matrikData = roundArray($dataNorm);


    // dd($matrikData);
    //memecah matrikm menjadi 3 tabel untuk nanti bisa dinormalisasi
    for ($i=0; $i < 5; $i++) {
      for ($j=0; $j < 3; $j++) {
        $matrikA[$i][$j] = $matrikData[$i][$j];
      }
    }
    $x=0;
    for ($i=5; $i < 10; $i++) {
      for ($j=0; $j < 3; $j++) {
        $matrikB[$x][$j] = $matrikData[$i][$j];
      }
      $x++;
    }
    $x=0;
    for ($i=10; $i < 15; $i++) {
      for ($j=0; $j < 3; $j++) {
        $matrikC[$x][$j] = $matrikData[$i][$j];
      }
      $x++;
    }

    $maxA = maxVertikal($matrikA, 5, 3);
    $maxB = maxVertikal($matrikB, 5, 3);
    $maxC = maxVertikal($matrikC, 5, 3);



    return view('evaluator.perangkingan.outcome')->with('form', $form)
    ->with('matrikA', $matrikA)->with('matrikB', $matrikB)->with('matrikC', $matrikC)
    ->with('maxA', $maxA)->with('maxB', $maxB)->with('maxC', $maxC)
    ->with('nilaiBobot', $nilaiBobot);
  }

  public function apiOutcome($idForm)
  {
    $outcomes = Outcome::where('form_id', '=', $idForm)
                -> join('butir', 'butir.id', '=', 'outcomes.butir_id')
                -> get();

    // dd($outcomes);

    return Datatables::of($outcomes)
      ->make(true);
  }

  public function update(Request $request, $idForm)
  {
    $outcomes = Outcome::where('form_id', '=', $idForm)
                    -> get();

    // dd($dataAverage[0] -> id);

    for ($i=0; $i < count($outcomes); $i++) {
      $dataOutcome = Outcome::findOrFail($outcomes[$i] -> id);

      $dataOutcome -> update([
        'butir_id' => $request -> get('id'.$i),
        'value' => $request -> get('min'.$i),
      ]);
    }

    // return redirect()->back()->with('status', 'Average Updated');
    return redirect('/forms/'.$idForm.'/judgement');
  }


}
