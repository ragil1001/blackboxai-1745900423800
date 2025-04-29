<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Pembeli extends Authenticatable implements JWTSubject
{
    use HasFactory, HasApiTokens;

    protected $table = 'pembelis';
    protected $primaryKey = 'ID_PEMBELI';
    public $timestamps = false;

    protected $fillable = [
        'NAMA',
        'TELEPON',
        'POIN_LOYALITAS',
        'EMAIL',
        'PASSWORD',
        'STATUS',
    ];

    public function alamat()
    {
        return $this->hasMany(Alamat::class, 'ID_PEMBELI');
    }

    public function diskusi()
    {
        return $this->hasMany(Diskusi::class, 'ID_PEMBELI');
    }

    public function penukaran()
    {
        return $this->hasMany(Penukaran::class, 'ID_PEMBELI');
    }

    public function transaksiPenjualan()
    {
        return $this->hasMany(TransaksiPenjualan::class, 'ID_PEMBELI');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'ID_PEMBELI');
    }

    /**
    * Get the identifier that will be stored in the subject claim of the JWT.
    *
    * @return mixed
    */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
    * Return a key value array, containing any custom claims to be added to the JWT.
    *
    * @return array
    */
    public function getJWTCustomClaims()
    {
        return [];
    }

}