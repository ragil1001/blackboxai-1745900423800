<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangTitipan extends Model
{
    use HasFactory;

    protected $table = 'barangtitipans';
    protected $primaryKey = 'KODE_PRODUK';
    public $timestamps = true;

    protected $fillable = [
        'ID_SUBKATEGORI',
        'ID_PENITIPAN',
        'ID_PEGAWAI',
        'ID_PENJUALAN',
        'NAMA',
        'HARGA_JUAL',
        'BERAT',
        'TANGGAL_KADALUARSA',
        'TANGGAL_PERPANJANGAN',
        'STATUS',
        'TERJUAL_CEPAT',
        'KONDISI',
        'TANGGAL_GARANSI',
        'rating',
        'DESKRIPSI',
    ];

    public function subkategori()
    {
        return $this->belongsTo(Subkategori::class, 'ID_SUBKATEGORI');
    }

    public function penitipan()
    {
        return $this->belongsTo(TransaksiPenitipan::class, 'ID_PENITIPAN');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'ID_PEGAWAI');
    }

    public function penjualan()
    {
        return $this->belongsTo(TransaksiPenjualan::class, 'ID_PENJUALAN');
    }

    public function diskusi()
    {
        return $this->hasMany(Diskusi::class, 'KODE_PRODUK');
    }

    public function fotoProduk()
    {
        return $this->hasMany(FotoProduk::class, 'KODE_PRODUK');
    }

    public function komisi()
    {
        return $this->hasMany(Komisi::class, 'KODE_PRODUK');
    }

    public static function generateKodeProduk()
    {
        // Ambil angka increment terakhir
        $lastProduct = self::orderBy('KODE_PRODUK', 'desc')->first();

        // Tentukan angka increment
        $increment = $lastProduct ? (int)substr($lastProduct->KODE_PRODUK, 1) + 1 : 1;

        // Ambil huruf depan dari nama produk (akan ditentukan saat menyimpan)
        return $increment; // Kembalikan hanya angka increment
    }
}
