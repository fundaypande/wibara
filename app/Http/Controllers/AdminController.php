<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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


}
