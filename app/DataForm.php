<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataForm extends Model
{

  protected $table = 'data_forms';

  protected $fillable = [
      'form_id', 'butir_id', 'name', 'email', 'affiliation', 'nilai', 'uniq'
  ];

  // public function profilIkm()
  // {
  //   return $this->beLongsTo('App\ProfilIkm');
  // }
}
