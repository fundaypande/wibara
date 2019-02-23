<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Penerima;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $penerima = Penerima::all();

      // dd($penerima);

      return view('user.home')->with('penerima', $penerima);
    }


    // ** Ubah Password

    public function showChangePasswordForm(){
      return view('auth.changepassword');
    }

    public function changePassword(Request $request){

      if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
      // The passwords matches
        return redirect()->back()->with("error","Password lama anda tidak sesuai.");
      }

      if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
      //Current password and new password are same
        return redirect()->back()->with("error","Password baru tidak boleh sama dengan password lama.");
      }
      if( ($request->get('new-password') === $request->get('new-password-confirm')) ) {
                  //New password and confirm password are not same
                  return redirect()->back()->with("error","Konfirmasi password tidak sama.");
      }
      //Change Password
      $user = Auth::user();
      $user->password = bcrypt($request->get('new-password'));
      $user->save();

      Auth::logout();
      return redirect('/login')->with("notif","Selamat password sudah dirubah, silahkan login dengan password baru anda");

    }



}
