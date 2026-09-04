<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function getImageUrlAttribute(): string
    {
        $assetByName = [
            'Kabel' => 'Images/kabel.png',
            'Kalkulator' => 'Images/kalkulator.png',
            'Seragam Kegiatan' => 'Images/seragam-kegiatan.jpeg',
            'Seragam Kekecilan' => 'Images/seragam-sekolah.png',
            'Seragam Sekolah' => 'Images/seragam-sekolah.png',
            'Seragam yang Sudah Kekecilan' => 'Images/seragam-sekolah.png',
            'Tas' => 'Images/tas.png',
            'Flashdisk' => 'Images/flashdisk (1).png',
            'Perangkat Elektronik Sederhana' => 'Images/kalkulator.png',
            'Adaptor' => 'Images/adaptor.png',
            'Perlengkapan Praktik' => 'Images/perlengkapan-praktik.png',
        ];

        if (isset($assetByName[$this->nama_barang])) {
            return asset($assetByName[$this->nama_barang]);
        }

        if (filter_var($this->foto, FILTER_VALIDATE_URL)) {
            return $this->foto;
        }

        if (is_string($this->foto) && $this->foto !== '') {
            $publicPath = ltrim($this->foto, '/');

            if (is_file(public_path($publicPath))) {
                return asset($publicPath);
            }

            return str_starts_with($this->foto, '/')
                ? $this->foto
                : Storage::disk('public')->url($this->foto);
        }

        return '';
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}
