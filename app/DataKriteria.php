<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataKriteria extends Model
{

  protected $table = 'data_kriterias';

  protected $fillable = [
      'id_user', 'id_kriteria', 'nilai', 'tahun'
  ];

  public function user()
  {
    return $this->beLongsTo('App\User');
  }

  // public function user()
  // {
  //   return $this->beLongsTo('App\User');
  // }
}
