<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataEvaluasi extends Model
{

  protected $table = 'data_evaluasis';

  protected $fillable = [
      'id_user', 'id_kriteria', 'nilai', 'tahun'
  ];

  // public function user()
  // {
  //   return $this->beLongsTo('App\User');
  // }
  //
  // public function kriteria()
  // {
  //   return $this->beLongsTo('App\Kriteria');
  // }
}
