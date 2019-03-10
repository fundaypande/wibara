<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Butir extends Model
{

  protected $table = 'butir';

  protected $fillable = [
      'thk', 'aneka', 'aspek', 'butir'
  ];

  // public function profilIkm()
  // {
  //   return $this->beLongsTo('App\ProfilIkm');
  // }
}
