<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Kriteria;
use App\DataKriteria;
use App\ProfilIkm;
use App\Komoditi;

class PerangkinganController extends Controller
{
  public function __construct()
  {
      // $this->middleware('auth');
  }

  //Api untuk ditampilkan tahun di perangkingan
  public function apiTahunReady()
  {
    return DataKriteria::select('tahun')
                ->distinct()
                ->get();
  }


  public function showHasil(Request $request)
  {
    // dd($request -> all());
    $kriteria = Kriteria::all();
    $ikm = ProfilIkm::join('users', 'users.id', '=', 'profilikm.user_id')
                      -> select('user_id', 'users.name')
                      -> orderBy('user_id', 'asc')
                      -> get();
    $komoditi = Komoditi::findOrFail($request->get('komoditi'));
    // dd($ikm);

    $data = DataKriteria::join('users', 'users.id', '=', 'data_kriterias.id_user')
            ->join('profilikm', 'users.id', '=', 'profilikm.user_id')
            ->join('kriterias', 'kriterias.id', '=', 'data_kriterias.id_kriteria')
            ->select('data_kriterias.*', 'jarak', 'kriterias.nama')
            ->where('tahun', '=', $request->get('tahun'))
            ->where('komoditi_id', '=', $request->get('komoditi'))
            ->orderBy('data_kriterias.id_user', 'asc')
            ->orderBy('data_kriterias.id_kriteria', 'asc')
            ->get();

    $kriteriaOnData = $data -> count()/$ikm -> count();
    $kriteriaReal = $kriteria -> count();
    // echo "Kriteria real : ". $kriteriaReal;
    // echo "<br />";
    // echo "Kriteria terdata : ". $kriteriaOnData;
    // echo "<br />";

    if($kriteriaOnData < $kriteriaReal){
      return redirect('/perangkingan')->with('warning', 'Tolong Lengkapi Data-data Kriteria Setiap IKM Khususnya Pada Komoditi '. $komoditi->nama . " Dan Tahun " . $request->get('tahun')  );
    }




    $jumlahData = $data -> count();
    $jumlKritData = $kriteria -> count();


    // dd($data);

    $arrayData = null;
    // for ($i=0; $i < $jumlahData ; $i++) {
    //   echo $data[$i] -> id_user;
    //   echo $data[$i] -> nama;
    //   echo $data[$i] -> nilai;
    //   echo $data[$i] -> jarak;
    //
    //
    //   echo "<br />";
    // }

    // memasukkan data kriteria ke dalm array
    $cum = 0;
    for ($j=0; $j < $jumlahData/$kriteria -> count(); $j++) {
      for ($k=0; $k < $kriteria -> count(); $k++) {
        $arrayData[$j][$k] = $data[$cum] -> nilai;
        $cum++;
      }
    }


    //menambah data jarak ke array
    // $cum = $jumlKritData-1;
    // for ($j=0; $j < $jumlahData/$kriteria -> count(); $j++) {
    //     $arrayData[$j][$jumlKritData] = $data[$cum] -> jarak;
    //     $cum = $cum + $jumlKritData;
    // }

    // dd($arrayData);


    return view('admin.perangkingan.hasil', ['kriteria' => $kriteria], ['ikm' => $ikm])->with('data', $arrayData);
  }

  public function showData(Request $request){
    $kriteria = Kriteria::all();

    return view('admin.perangkingan.perangkingan', ['kriteria' => $kriteria]);
  }

  // public function update(Request $request)
  // {
  //   $kriteria = Kriteria::all();
  //   $jumlahKriteria = $kriteria -> count();
  //
  //   // Update data
  //   foreach ($kriteria as $key => $krit) {
  //     $idKrit = $krit -> id;
  //     $dataKrit = Kriteria::findOrFail($idKrit);
  //
  //     // dd($request -> $idKrit);
  //
  //     $dataKrit -> update([
  //         'bobot' => $request -> $idKrit,
  //       ]);
  //   }
  //
  //   return redirect('/kriteria')->with('status', 'Berhasil menyimpan nilai bobot');
  // }





}
