<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    // --> Membuat fungsi untuk terhubung ke table ProfilIkm
    // --> Dengan relasi one to one
    public function profilIkm()
    {
      return $this->hasOne('App\ProfilIKM');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'status', 'token', 'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
      if($this->role == 0) return true;

      return false;
    }

    public function isStaf()
    {
      if($this->role == 1) return true;

      return false;
    }

    // public function isUser()
    // {
    //   if($this->role == 1) return true;
    //
    //   return false;
    // }

}
