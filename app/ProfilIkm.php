<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilIkm extends Model
{
    protected $table = 'profilikm';

    // --> Membuat fungsi untuk terhubung ke table ProfilIkm
    // --> Dengan relasi one to one
    public function user()
    {
      return $this->beLongsTo('App\User');
    }

    protected $fillable = [
        'user_id', 'nama_usaha', 'lama_berdiri', 'merk_produk', 'alamat', 'kecamatan',
        'desa', 'telpon', 'jenis_produk', 'rerata_produksi', 'rerata_harga', 'rerata_penjualan',
        'tempat_pemasaran', 'total_peralatan', 'total_bahan_baku', 'total_pekerja', 'jarak',
        'long', 'lang', 'permasalahan', 'jenis_bimtek', 'status', 'tahun', 'badan_hukum', 'izin_usaha'
    ];
}
