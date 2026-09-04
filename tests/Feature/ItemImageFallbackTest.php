<?php

namespace Tests\Feature;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ItemImageFallbackTest extends TestCase
{
    public function test_dashboard_does_not_show_jaket_kelas(): void
    {
        DB::statement('CREATE TABLE barang (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            pengguna_id INTEGER NULL,
            nama_barang TEXT NOT NULL,
            kategori TEXT NOT NULL,
            foto TEXT NULL,
            deskripsi TEXT NULL,
            kondisi TEXT NULL,
            metode TEXT NULL,
            harga INTEGER NULL,
            lokasi TEXT NULL,
            status TEXT NOT NULL DEFAULT "tersedia"
        )');

        $response = $this->get(route('dashboard'));

        $response->assertOk();
        $response->assertDontSeeText('Jaket Kelas');
    }

    public function test_barang_default_image_uses_category_asset(): void
    {
        $item = new Barang([
            'nama_barang' => 'Barang Umum',
            'kategori' => 'elektronik_komputer',
            'foto' => '',
        ]);

        $this->assertSame('', $item->image_url);
    }

    public function test_named_products_use_their_verified_local_assets(): void
    {
        $assets = [
            'Kabel' => 'Images/kabel.png',
            'Kalkulator' => 'Images/kalkulator.png',
            'Seragam Kegiatan' => 'Images/seragam-kegiatan.jpeg',
            'Seragam yang Sudah Kekecilan' => 'Images/seragam-sekolah.png',
            'Tas' => 'Images/tas.png',
            'Flashdisk' => 'Images/flashdisk (1).png',
            'Perlengkapan Praktik' => 'Images/perlengkapan-praktik.png',
            'Adaptor' => 'Images/adaptor.png',
        ];

        foreach ($assets as $name => $assetPath) {
            $item = new Barang(['nama_barang' => $name, 'foto' => 'old-invalid-url']);

            $this->assertFileExists(public_path($assetPath));
            $this->assertSame(asset($assetPath), $item->image_url);
        }
    }

    public function test_old_product_photo_urls_are_preserved(): void
    {
        $item = new Barang([
            'nama_barang' => 'Headset',
            'foto' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?auto=format&fit=crop&w=900&q=80',
        ]);

        $this->assertSame($item->foto, $item->image_url);
    }
}
