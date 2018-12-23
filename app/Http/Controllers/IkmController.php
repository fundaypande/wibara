<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IkmController extends Controller
{
  public function __construct()
  {
      // $this->middleware('auth');
  }

  public function dashboard(){

    // --> return view('Ke halaman staf')
    die('ini halaman STAF');
  }
}
