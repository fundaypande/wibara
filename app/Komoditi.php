<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komoditi extends Model
{

  protected $table = 'komoditis';

  protected $fillable = [
      'nama', 'keterangan'
  ];

  public function profilIkm()
  {
    return $this->beLongsTo('App\ProfilIkm');
  }
}
