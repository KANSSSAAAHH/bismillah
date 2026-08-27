<?php

namespace App\Services;

/**
 * Pengecekan kepemilikan + hak admin untuk melindungi aksi pada resource.
 * Dipakai oleh controller agar tidak duplikat dan tetap konsisten.
 */
trait AuthorizedRoles
{
    protected function adminOrOwner(int $ownerId, int $actorId): bool
    {
        return $ownerId === $actorId || session('pengguna_role') === 'admin';
    }

    /**
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function ensureOwner(int $ownerId, int $actorId, string $pesan = 'Anda tidak berhak melakukan aksi ini.'): void
    {
        if (! $this->adminOrOwner($ownerId, $actorId)) {
            redirect()
                ->back()
                ->with('error', $pesan)
                ->throwResponse();
        }
    }
}