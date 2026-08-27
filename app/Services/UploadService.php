<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    /**
     * Simpan foto ke disk public dan kembalikan URL relatif yang dapat diakses.
     */
    public function foto(UploadedFile $file, string $dir = 'items'): string
    {
        $path = $file->store("foto/{$dir}", 'public');

        return Storage::disk('public')->url($path);
    }
}