<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bimtek extends Model
{

  protected $table = 'bimteks';

  protected $fillable = [
      'nama', 'keterangan', 'tahun'
  ];

  // public function profilIkm()
  // {
  //   return $this->beLongsTo('App\ProfilIkm');
  // }
}
