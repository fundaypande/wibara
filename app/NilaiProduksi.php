<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiProduksi extends Model
{
  protected $fillable = [
      'user_id', 'jenis_produksi', 'jumlah', 'harga', 'nilai_penjualan', 'tujuan',
      'deskripsi', 'photo'
  ];

  public function user()
  {
    return $this->beLongsTo('App\User');
  }
}
