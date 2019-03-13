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

  public function process(Request $request, $id)
  {
    $bobot = Bobot::where('user_id', '=', $id)
              -> get();

    // dd($bobot);


    // a = parahyangan
    // b = pawongan
    // c = palemahan
    for ($i=0; $i < 5 ; $i++) {
      for ($j=0; $j < 3 ; $j++) {
        $dataA[$i][$j] = $request -> get('a'.$i.$j);

        //update data
        $updateBobot = Bobot::findOrFail($bobot[$i] -> id);

        $updateBobot -> update([
          'antecedents' => $request -> get('a'.$i.'0'),
          'transaction' => $request -> get('a'.$i.'1'),
          'outcomes' => $request -> get('a'.$i.'2'),
        ]);

      }
    }

    $x = 5;
    for ($i=0; $i < 5 ; $i++) {
      for ($j=0; $j < 3 ; $j++) {
        $dataB[$i][$j] = $request -> get('b'.$i.$j);

        //update data
        // for ($x=5; $x < 10; $x++) {
          $updateBobot = Bobot::findOrFail($bobot[$x] -> id);

        $updateBobot -> update([
          'antecedents' => $request -> get('b'.$i.'0'),
          'transaction' => $request -> get('b'.$i.'1'),
          'outcomes' => $request -> get('b'.$i.'2'),
        ]);

        // }
      }
      $x++;
    }
    $x = 10;
    for ($i=0; $i < 5 ; $i++) {
      for ($j=0; $j < 3 ; $j++) {
        $dataC[$i][$j] = $request -> get('c'.$i.$j);


        //update data
        // for ($x=10; $x < 15; $x++) {
          $updateBobot = Bobot::findOrFail($bobot[$x] -> id);

        $updateBobot -> update([
          'antecedents' => $request -> get('c'.$i.'0'),
          'transaction' => $request -> get('c'.$i.'1'),
          'outcomes' => $request -> get('c'.$i.'2'),
        ]);

        // }
      }
      $x++;
    }

    $rerataA = rerata($dataA);
    $rerataB = rerata($dataB);
    $rerataC = rerata($dataC);

    //update nilai average
    $i = 0;
    for ($x=0; $x < 5; $x++) {
      $updateBobot = Bobot::findOrFail($bobot[$x] -> id);
      $updateBobot -> update([
        'average' => $rerataA[$i],
      ]);
      $i++;
    }

    $i = 0;
    for ($x=5; $x < 10; $x++) {
      $updateBobot = Bobot::findOrFail($bobot[$x] -> id);
      $updateBobot -> update([
        'average' => $rerataB[$i],
      ]);
      $i++;
    }

    $i = 0;
    for ($x=10; $x < 15; $x++) {
      $updateBobot = Bobot::findOrFail($bobot[$x] -> id);
      $updateBobot -> update([
        'average' => $rerataC[$i],
      ]);
      $i++;
    }

    // dd($rerataB);

    $averageA = averageBobot($dataA);
    $averageB = averageBobot($dataB);
    $averageC = averageBobot($dataC);

    // dd($averageC);

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
