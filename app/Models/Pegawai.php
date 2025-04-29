<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Pegawai extends Authenticatable implements JWTSubject
{
    use HasFactory, HasApiTokens, Notifiable, HasRoles;

    protected $table = 'pegawais';
    protected $primaryKey = 'ID_PEGAWAI';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'ID_JABATAN', 'NAMA', 'TELEPON', 'ALAMAT', 'TGL_LAHIR', 'EMAIL', 'PASSWORD', 'STATUS',
    ];

    protected $hidden = [
        'PASSWORD',
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'ID_JABATAN');
    }

    // Fungsi untuk assign role berdasarkan jabatan
    public function assignRoleByJabatan()
    {
        $jabatan = $this->jabatan; // Ambil jabatan pegawai
        if ($jabatan) {
            // Tentukan role berdasarkan jabatan
            switch ($jabatan->ID_JABATAN) {
                case 1:
                    $this->assignRole('owner');
                    break;
                case 2:
                    $this->assignRole('cs');
                    break;
                case 3:
                    $this->assignRole('gudang');
                    break;
                case 4:
                    $this->assignRole('kurir');
                    break;
                case 5:
                    $this->assignRole('hunter');
                    break;
                case 6:
                    $this->assignRole('admin');
                    break;
                default:
                    break;
            }
        }
    }

    // JWTSubject methods
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function diskusi()
    {
        return $this->hasMany(Diskusi::class, 'ID_PEGAWAI');
    }

    public function penitip()
    {
        return $this->hasMany(Penitip::class, 'ID_PEGAWAI');
    }

    public function requestDonasi()
    {
        return $this->hasMany(RequestDonasi::class, 'ID_PEGAWAI');
    }

    public function komisi()
    {
        return $this->hasMany(Komisi::class, 'ID_PEGAWAI');
    }

    public function transaksiPenitipan()
    {
        return $this->hasMany(TransaksiPenitipan::class, 'ID_PEGAWAI_HUNTER');
    }

    public function transaksiPenjualan()
    {
        return $this->hasMany(TransaksiPenjualan::class, 'ID_PEGAWAI_GUDANG');
    }

    public static function generateIdPegawai()
    {
        $lastPegawai = self::orderBy('ID_PEGAWAI', 'desc')->first();

        if ($lastPegawai) {
            $increment = (int) substr($lastPegawai->ID_PEGAWAI, 1) + 1; // Ambil angka setelah 'P' dan increment
        } else {
            $increment = 1;
        }

        return 'P' . $increment; // Format ID pegawai
    }
}
