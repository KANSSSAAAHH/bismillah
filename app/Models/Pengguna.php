<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'kelas',
        'nomor_whatsapp',
        'foto',
    ];

    public const ROLES = [
        'pengguna' => 'Siswa / Orang Tua',
        'sekolah' => 'Sekolah',
        'admin' => 'Administrator',
    ];

    // Role yang dapat didaftarkan sendiri secara mandiri dari halaman register.
    public const REGISTERABLE_ROLES = ['pengguna', 'sekolah'];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isSekolah(): bool
    {
        return $this->role === 'sekolah';
    }

    public function isPengguna(): bool
    {
        return $this->role === 'pengguna' || $this->role === null;
    }

    public function barang()
    {
        return $this->hasMany(Barang::class, 'pengguna_id');
    }
}
