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

        $this->assertSame('https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=900&q=80', $item->image_url);
    }
}
