<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    use HasFactory;

    protected $table = 'organisasis';
    protected $primaryKey = 'ID_ORGANISASI';
    public $timestamps = true;

    protected $fillable = [
        'NAMA',
        'ALAMAT',
        'TELEPON',
        'DESKRIPSI',
        'EMAIL',
        'PASSWORD',
        'STATUS',
        'FOTO_ORGANISASI',
    ];

    public function requestDonasi()
    {
        return $this->hasMany(RequestDonasi::class, 'ID_ORGANISASI');
    }

    public static function generateIdOrganisasi()
    {
        $lastOrganisasi = self::orderBy('ID_ORGANISASI', 'desc')->first();

        if ($lastOrganisasi) {
            $increment = (int) substr($lastOrganisasi->ID_ORGANISASI, 3) + 1;
        } else {
            $increment = 1;
        }

        return 'ORG' . $increment;
    }
}