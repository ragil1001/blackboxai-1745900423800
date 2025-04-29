<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenitipan extends Model
{
    use HasFactory;

    protected $table = 'transaksipenitipans';
    protected $primaryKey = 'ID_PENITIPAN';
    public $timestamps = true;

    protected $fillable = [
        'ID_PENITIP',
        'ID_PEGAWAI_HUNTER',
        'ID_PEGAWAI_QC',
        'NO_NOTA_PENITIPAN',
        'TANGGAL_PENITIPAN',
        'TOTAL_NILAI_BARANG',
        'CATATAN',
    ];

    public function penitip()
    {
        return $this->belongsTo(Penitip::class, 'ID_PENITIP');
    }

    public function pegawaiHunter()
    {
        return $this->belongsTo(Pegawai::class, 'ID_PEGAWAI_HUNTER');
    }

    public function pegawaiQC()
    {
        return $this->belongsTo(Pegawai::class, 'ID_PEGAWAI_QC');
    }

    public function barangTitipan()
    {
        return $this->hasMany(BarangTitipan::class, 'ID_PENITIPAN');
    }

    public static function generateNoNotaPenitipan()
    {
        // Ambil transaksi terakhir
        $lastTransaksi = self::orderBy('NO_NOTA_PENITIPAN', 'desc')->first();

        // Tentukan angka increment
        if ($lastTransaksi) {
            $increment = (int) substr($lastTransaksi->NO_NOTA_PENITIPAN, strrpos($lastTransaksi->NO_NOTA_PENITIPAN, '.') + 1) + 1; // Ambil angka setelah titik terakhir
        } else {
            $increment = 1; // Jika tidak ada transaksi sebelumnya, mulai dari 1
        }

        // Format NO_NOTA_PENITIPAN
        return sprintf('%s.%s.%d', date('Y'), date('m'), $increment); // Format yyyy.mm.increment
    }
}