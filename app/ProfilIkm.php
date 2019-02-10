<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Komoditi;

class ProfilIkm extends Model
{
    protected $table = 'profilikm';

    // --> Membuat fungsi untuk terhubung ke table ProfilIkm
    // --> Dengan relasi one to one
    public function user()
    {
      return $this->beLongsTo('App\User');
    }

    public function komoditi()
    {
      return $this->beLongsTo('App\Komoditi');
    }

    protected $fillable = [
        'user_id', 'nama_usaha', 'lama_berdiri', 'merk_produk', 'alamat', 'kecamatan',
        'desa', 'telpon', 'jenis_produk', 'rerata_produksi', 'rerata_harga', 'rerata_penjualan',
        'tempat_pemasaran', 'total_peralatan', 'total_bahan_baku', 'total_pekerja', 'jarak',
        'lng', 'lat', 'permasalahan', 'jenis_bimtek', 'status', 'tahun', 'badan_hukum', 'izin_usaha', 'komoditi_id'

    ];
}
