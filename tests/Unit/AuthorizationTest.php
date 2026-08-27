<?php

namespace Tests\Unit;

use App\Services\AuthorizedRoles;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use AuthorizedRoles;

    public function test_pemilik_dengan_id_sama_diizinkan(): void
    {
        $this->assertTrue($this->adminOrOwner(10, 10));
    }

    public function test_bukan_pemilik_dan_bukan_admin_ditolak(): void
    {
        // Tanpa role admin di session, id berbeda = tidak berhak.
        $this->assertFalse($this->adminOrOwner(10, 99));
    }
}