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
            <a onclick="editForm(' . $staf-> id . ')" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i>Edit</a>
            <a onclick="deleteData(' . $staf-> id . ')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
          ';
        })->make(true);
    }










}
