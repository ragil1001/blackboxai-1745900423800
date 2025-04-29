<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    use HasFactory;

    protected $table = 'transaksipenjualans';
    protected $primaryKey = 'ID_PENJUALAN';
    public $timestamps = true;

    protected $fillable = [
        'ID_PEMBELI',
        'ID_PEGAWAI_GUDANG',
        'ID_PEGAWAI_CS',
        'ID_PEGAWAI_KURIR',
        'NO_NOTA_PENJUALAN',
        'TOTAL_BIAYA',
        'ONGKIR',
        'POIN_TERPAKAI',
        'TOTAL_AKHIR',
        'POIN_DIPEROLEH',
        'TANGGAL_PESANAN',
        'TANGGAL_PEMBAYARAN',
        'BUKTI_PEMBAYARAN',
        'METODE_PENGIRIMAN',
        'TANGGAL_SIAP',
        'STATUS',
        'TOTAL_POIN_PEMBELI',
        'ALAMAT_PENGIRIMAN',
    ];

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'ID_PEMBELI');
    }

    public function pegawaiGudang()
    {
        return $this->belongsTo(Pegawai::class, 'ID_PEGAWAI_GUDANG');
    }

    public function pegawaiCS()
    {
        return $this->belongsTo(Pegawai::class, 'ID_PEGAWAI_CS');
    }

    public function pegawaiKurir()
    {
        return $this->belongsTo(Pegawai::class, 'ID_PEGAWAI_KURIR');
    }

    public function barangTitipan()
    {
        return $this->hasMany(BarangTitipan::class, 'ID_PENJUALAN');
    }

    public static function generateNoNotaPenjualan()
    {
        // Ambil transaksi terakhir
        $lastTransaksi = self::orderBy('NO_NOTA_PENJUALAN', 'desc')->first();

        // Tentukan angka increment
        if ($lastTransaksi) {
            $increment = (int) substr($lastTransaksi->NO_NOTA_PENJUALAN, strrpos($lastTransaksi->NO_NOTA_PENJUALAN, '.') + 1) + 1; // Ambil angka setelah titik terakhir
        } else {
            $increment = 1; // Jika tidak ada transaksi sebelumnya, mulai dari 1
        }

        // Format NO_NOTA_PENJUALAN
        return sprintf('%s.%s.%d', date('Y'), date('m'), $increment); // Format yyyy.mm.increment
    }
}