<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{

  protected $table = 'outcomes';

  protected $fillable = [
      'form_id', 'butir_id', 'value'
  ];

  // public function profilIkm()
  // {
  //   return $this->beLongsTo('App\ProfilIkm');
  // }
}
