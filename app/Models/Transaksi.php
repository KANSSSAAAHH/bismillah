<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    public $timestamps = false;

    protected $fillable = [
        'barang_id',
        'penerima_id',
        'pemilik_id',
        'pesan',
        'status',
        'lokasi_temu',
        'waktu_temu',
        'notifikasi_terkirim',
    ];

    public const STATUS = ['menunggu', 'disetujui', 'ditolak', 'dijadwalkan', 'selesai'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function penerima()
    {
        return $this->belongsTo(Pengguna::class, 'penerima_id');
    }

    public function pemilik()
    {
        return $this->belongsTo(Pengguna::class, 'pemilik_id');
    }
}