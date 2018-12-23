<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\ProfilIkm;
use Yajra\Datatables\Datatables;


//-> class untuk malakukan validasi terhadap Profil IKM Oleh Staf
class ValidasiController extends Controller
{
  //-> Staf dapat melakukan validasi terhadap IKM
  public function showValidasi(ProfilIkm $profilIkm)
  {
    return view('ikm.validasi');
  }

  //-> API yang mereturn data profil IKM yang belum tervalidasi
  public function apiValidasi()
  {
    $staf = ProfilIkm::where('status', '==', 0)
                  ->get();


    return Datatables::of($staf)
      -> addColumn('action', function($staf){
        return '
          <a style="margin-top: -10px;" href="#" class="btn btn-info btn-xs"><i class="fa fa-eye"></i>Show</a>
          <a style="margin-top: -10px;" onclick="editData(' . $staf-> id . ')" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i>Validasi</a>
        ';
      })->make(true);
  }

  public function formEdit($id)
  {
    $user = ProfilIkm::find($id);

    return $user;
  }

  public function updateStatus(Request $request, $id)
  {
    // die($id);
    $user = ProfilIkm::find($id);
    $user -> status = $request['radio'];

    $user -> update();

    return $user;
  }

}
