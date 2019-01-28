<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komoditi extends Model
{

  protected $table = 'komoditis';

  protected $fillable = [
      'nama', 'keterangan'
  ];

  // public function user()
  // {
  //   return $this->beLongsTo('App\User');
  // }
}
