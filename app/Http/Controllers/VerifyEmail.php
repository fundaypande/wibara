<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;

class VerifyEmail extends Controller
{

  // --> fungsi untuk mengakomodir link verifikasi

  public function verify($token, $id)
  {
    $user = User::find($id);
    if ($user -> token != $token) {
      return redirect('login')->with('warning', 'Token tidak sesuai');
    }

    if (!$user) {
      return redirect('login')->with('warning', 'User tidak ditemukan');
    }

    $user -> status = 1;
    $user -> save();

    return redirect('/login')->with('notif', 'Email sudah terverifikasi silahkan login');
  }



}
