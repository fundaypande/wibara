<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\Token;

class UserController extends Controller
{

  public function home()
  {
    return view('user.home');
  }

  public function user($id = null)
  {
    $idSum = null;
      if($id == null){
        $users = User::findOrFail(Auth::User() -> id);
        $idSum = Auth::User() -> id;
      } else {
        $users = User::findOrFail($id);
        $idSum = $id;
      }

      $total = User::where([
                  ['user_id', $idSum],
                ]);
      return view('user.profile', compact('users', 'total'));
  }

  public function updatePic(Request $request, $id)
  {
    $this -> validate($request, [
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);


    $user = User::findOrFail($id);
      $input = $request->gambar;
      $input = time().'.'.$request->gambar->getClientOriginalExtension();
      $request->gambar->move('images/', $input);
      $oldPic = $user -> photo;
      if($oldPic != null){
        $image_path = 'images/'.$oldPic;
        if(file_exists($image_path)){
            unlink($image_path);//unlink untuk menghapus foto lama pada saat proses create and store
        }
      }
      $user -> update([
        'photo' => $input,
      ]);
    return redirect('/user')->with('notif', 'Berhasil ubah foto profile');
    //return response()->json(['error'=>$validator->errors()->all()]);
  }

  public function update(Request $request, $id){
      $user = User::findOrFail($id);
      $this -> validate($request, [
              'name' => 'required|min:3',
            ]);
      if(Auth::User() -> id == $user -> id){
        $user -> update([
          'name' => $request -> name,
        ]);
      } else abort(404);
      return redirect('/user')->with('notif', 'Data Profile Berhasil Diedit');
    }






}
