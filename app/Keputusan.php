<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keputusan extends Model
{

  protected $table = 'keputusans';

  protected $fillable = [
      'form_id', 'butir_id', 'value', 'thk', 'rekomendasi', 'keputusan'
  ];

  // public function profilIkm()
  // {
  //   return $this->beLongsTo('App\ProfilIkm');
  // }
}
