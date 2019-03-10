<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bobot;
use App\User;
use Auth;
use Yajra\Datatables\Datatables;

class BobotController extends Controller
{
  public function show()
  {
    return view('evaluator.bobot.show');
  }


  public function showEdit()
  {
    return view('evaluator.bobot.showEdit');
  }

  public function process(Request $request)
  {
    // a = parahyangan
    // b = pawongan
    // c = palemahan
    for ($i=0; $i < 5 ; $i++) {
      for ($j=0; $j < 3 ; $j++) {
        $dataA[$i][$j] = $request -> get('a'.$i.$j);
      }
    }

    for ($i=0; $i < 5 ; $i++) {
      for ($j=0; $j < 3 ; $j++) {
        $dataB[$i][$j] = $request -> get('b'.$i.$j);
      }
    }

    for ($i=0; $i < 5 ; $i++) {
      for ($j=0; $j < 3 ; $j++) {
        $dataC[$i][$j] = $request -> get('c'.$i.$j);
      }
    }

    $averageA = averageBobot($dataA);
    $averageB = averageBobot($dataB);
    $averageC = averageBobot($dataC);

    return view('evaluator.bobot.process')->with('averageA', $averageA)->with('averageB', $averageB)->with('averageC', $averageC);
  }


  public function apiBobot()
  {
    $bobot = Bobot::where('user_id', '=', Auth::user()->id)
              -> get();


    return Datatables::of($bobot)
      ->make(true);
  }



  public function update(Request $request)
  {
    $bobotId = Bobot::where('user_id', '=', Auth::user()->id)
              ->select('id')
              -> get();

    foreach ($bobotId as $key => $value) {
      $bobot = Bobot::find($value -> id);

      $bobot -> update([
        'nilai' => $request -> get($key),
      ]);
    }

    return redirect('/weight')->with('status', 'Weight Saved');
  }

}
