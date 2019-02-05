<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use app\User;

class StafController extends Controller
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

    public function showIkm(){
      return view('staf.addIkm.viewIkm');
    }

    public function apiIkm()
    {
      $staf = User::where('role', '=', 1)
                    ->orderBy('id', 'ASC')
                    ->get();


      return Datatables::of($staf)
        -> addColumn('action', function($staf){
          return '
            <a href="#" class="btn btn-info btn-xs"><i class="fa fa-eye"></i>Show</a>
            <a onclick="editData(' . $staf-> id . ')" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i>Edit</a>
            <a onclick="deleteData(' . $staf-> id . ')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
          ';
        })
        // mengirimkan ID untuk dirender di ajax show viewIkm.blade.php
        -> addColumn('ikm', function($staf){
          return $staf -> id;
        })


        ->make(true);
    }


    public function addIkm()
    {
      return view('staf.addIkm.addIkm');
    }

    // --> Mengembalikan nilai JSON beripa tabep USER untuk Edit ROLE User yang bisa login
    public function formEdit($id)
    {
      $user = User::find($id);

      return $user;
    }

    public function update(Request $request, $id)
    {
      $user = User::find($id);

      $user -> update([
        'name' => $request -> name,
      ]);

      return $user;
    }


    public function destroy($id)
    {
      User::destroy($id);
    }

}
