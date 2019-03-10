<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use App\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function dashboard(){
      die('ini halaman dashboard');
    }

    public function showStaf(){
      return view('admin.viewStaf');
    }


    // --> memanggil data dari json
    public function apiStaf()
    {
      $staf = User::all();


      return Datatables::of($staf)
        -> addColumn('action', function($staf){
          return '
            <a href="#" class="btn btn-info btn-xs"><i class="fa fa-eye"></i>Show</a>
            <a onclick="editData(' . $staf-> id . ')" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i>Edit</a>
            <a onclick="deleteData(' . $staf-> id . ')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
          ';
        })->make(true);
    }

    // --> Add staf Baru
    public function addStaf()
    {
      return view('admin.addStaf');
    }

    // --> Mengembalikan nilai JSON beripa tabep USER untuk Edit ROLE User yang bisa login
    public function formEdit($id)
    {
      $user = User::find($id);

      return $user;
    }

    // --> Mengedit ROLE USER
    public function updateRole(Request $request, $id)
    {
      $user = User::find($id);
      $user -> role = $request['radio'];

      $user -> update();

      return $user;
    }

    //--> Menghapus data staf
    public function destroy($id)
    {
      User::destroy($id);
    }


}
