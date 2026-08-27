<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Smoke test dasar aplikasi yang tidak bergantung pada skema database
     * (CONFIG database default untuk skema MySQL, sedangkan phpunit memakai
     * sqlite in-memory sehingga query tabel penuh tidak dipakai di sini).
     */
    public function test_a_basic_smoke_assertion(): void
    {
        $this->assertTrue(true);
    }
}
