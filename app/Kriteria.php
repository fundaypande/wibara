<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{

  protected $table = 'kriterias';

  protected $fillable = [
      'nama', 'keterangan', 'bobot'
  ];

  // public function user()
  // {
  //   return $this->beLongsTo('App\User');
  // }
}
