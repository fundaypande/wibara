<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPeralatan extends Model
{
    protected $table = 'jenis_peralatans';

    protected $fillable = [
        'user_id', 'jenis_alat', 'tahun', 'spesifikasi', 'jumlah', 'buatan',
        'harga', 'asal', 'kapasitas'
    ];
}
