<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    protected $table = 'bahan_bakus';

    protected $fillable = [
        'user_id', 'jenis_bahan', 'jumlah', 'satuan', 'harga', 'asal', 'tahun'
    ];
}
