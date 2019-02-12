<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{

  protected $table = 'penerimas';

  protected $fillable = [
      'user_tahun', 'user_id', 'komoditi_id', 'tahun'
  ];

  // public function dataKriteria()
  // {
  //   return $this->hasMany('App\DataKriteria');
  // }
}
