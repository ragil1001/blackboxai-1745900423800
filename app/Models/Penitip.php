<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Penitip extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'penitips';
    protected $primaryKey = 'ID_PENITIP';
    public $timestamps = true;

    protected $fillable = [
        'ID_PEGAWAI',
        'NAMA',
        'ALAMAT',
        'TELEPON',
        'SALDO',
        'POIN_LOYALITAS',
        'RATING',
        'BADGE',
        'NO_KTP',
        'EMAIL',
        'PASSWORD',
        'STATUS',
        'JLH_PENJUALAN',
        'FOTO_KTP',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'ID_PEGAWAI');
    }

    public function barangTitipan()
    {
        return $this->hasMany(BarangTitipan::class, 'ID_PENITIPAN');
    }

    public function transaksiPenitipan()
    {
        return $this->hasMany(TransaksiPenitipan::class, 'ID_PENITIP');
    }

    public function komisi()
    {
        return $this->hasMany(Komisi::class, 'ID_PENITIP');
    }

    public function topseller()
    {
        return $this->hasMany(Topseller::class, 'ID_PENITIP');
    }

    public static function generateIdPenitip()
    {
        $lastPenitip = self::orderBy('ID_PENITIP', 'desc')->first();

        if ($lastPenitip) {
            $increment = (int) substr($lastPenitip->ID_PENITIP, 1) + 1; // Ambil angka setelah 'T' dan increment
        } else {
            $increment = 1;
        }

        return 'T' . $increment; // Format ID penitip
    }
}