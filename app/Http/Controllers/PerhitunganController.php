<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Kriteria;

class PerhitunganController extends Controller
{
  public function __construct()
  {
      // $this->middleware('auth');
  }

  public function showMatrik(Request $request){

    // dd($request -> get('02'));
    // dd($_POST['02']);
    $kriteria = Kriteria::all();

    // BAGIAN MENGISI ARRAY MATRIKS
    //===========================
    $jumlahKriteria = $kriteria -> count();
    // dd($jumlahKriteria);
    $i = 0;
    $j = 1;
    //mengisi array matrik dengan inputan user
    for ($baris=$i;$baris<$jumlahKriteria;$baris++){
      for ($kolom=$j;$kolom<$jumlahKriteria;$kolom++){
        // echo $_POST['12'];
        // echo $baris.$kolom;
        // echo "<br />";
        $matKriteria[$kolom][$baris] = $_POST[$baris.$kolom];

      }
      $j = $j+1;
    }

    // dd($matKriteria);


    //mengisi array pertengahan dengan nilai 1
    for ($baris=$i;$baris<$jumlahKriteria;$baris++){
      $matKriteria[$baris][$baris] = 1;
    }


    $i = 0;
    $j = 1;
    //menginvers matrik segitia
    for ($baris=$i;$baris<$jumlahKriteria;$baris++){
      for ($kolom=$j;$kolom<$jumlahKriteria;$kolom++){
        $matKriteria[$baris][$kolom] = 1/$matKriteria[$kolom][$baris];
      }
      $j = $j+1;
    }



    // dd($matKriteria);

    return view('admin.perhitungan.matrik', ['kriteria' => $kriteria])->with('matrik', $matKriteria);
  }





}
