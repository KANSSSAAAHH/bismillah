<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    public $timestamps = false;

    protected $fillable = [
        'pengguna_id',
        'nama_barang',
        'kategori',
        'foto',
        'deskripsi',
        'kondisi',
        'metode',
        'harga',
        'lokasi',
        'status',
    ];

    public const KATEGORI = [
        'elektronik_komputer',
        'jaringan',
        'perlengkapan_praktik',
        'seragam_pakaian',
        'referensi_modul',
        'kreatif_multimedia',
        'lainnya',
    ];

    public const KONDISI = ['baru', 'bekas_layak', 'rusak_ringan'];

    public const METODE = ['donasi', 'harga'];

    public const STATUS = ['tersedia', 'diminta', 'dipesan', 'selesai'];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}
