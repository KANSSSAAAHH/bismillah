<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanBarang extends Model
{
    use HasFactory;

    protected $table = 'permintaan_barang';

    public $timestamps = false;

    protected $fillable = [
        'pengguna_id',
        'nama_barang',
        'kategori',
        'deskripsi',
        'status',
    ];

    public const STATUS = ['aktif', 'terpenuhi', 'ditutup'];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}