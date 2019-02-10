<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Komoditi;

class NilaiKriteria extends Model
{
    protected $table = 'nilai_kriteria';

    // --> Membuat fungsi untuk terhubung ke table ProfilIkm
    // --> Dengan relasi one to one
    // public function user()
    // {
    //   return $this->beLongsTo('App\User');
    // }
    //
    // public function komoditi()
    // {
    //   return $this->beLongsTo('App\Komoditi');
    // }

    protected $fillable = [
        'id', 'nilai', 'keterangan'
    ];
}
