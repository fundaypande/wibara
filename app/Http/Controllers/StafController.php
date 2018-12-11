<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function dashboard(){

      // --> return view('Ke halaman staf') 
      die('ini halaman STAF');
    }


}
