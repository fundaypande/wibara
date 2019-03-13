<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataAverage extends Model
{

  protected $table = 'data_averages';

  protected $fillable = [
      'form_id', 'butir_id', 'average'
  ];

  // public function profilIkm()
  // {
  //   return $this->beLongsTo('App\ProfilIkm');
  // }
}
