<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Services\AuthorizedRoles;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ItemController extends Controller
{
    use AuthorizedRoles;
    public function index(Request $request)
    {
        $search = $request->string('q')->toString();
        $kategori = $request->string('kategori')->toString();

        $items = Barang::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_barang', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%")
                        ->orWhere('lokasi', 'like', "%{$search}%");
                });
            })
            ->when($kategori, fn($query) => $query->where('kategori', $kategori))
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        return view('items.index', [
            'items' => $items,
            'search' => $search,
            'kategori' => $kategori,
            'kategoriOptions' => Barang::KATEGORI,
        ]);
    }

    public function mine()
    {
        $penggunaId = session('pengguna_id');

        if (!$penggunaId) {
            return redirect()->route('login')->with('error', 'Silakan login dulu.');
        }

        $items = Barang::query()
            ->where('pengguna_id', $penggunaId)
            ->latest('id')
            ->paginate(12);

        return view('my-items.index', [
            'items' => $items,
        ]);
    }

    public function create()
    {
        if (!session('pengguna_id')) {
            return redirect()->route('login')->with('error', 'Silakan login dulu.');
        }

        return view('items.create', [
            'kategoriOptions' => Barang::KATEGORI,
            'kondisiOptions' => Barang::KONDISI,
            'metodeOptions' => Barang::METODE,
        ]);
    }

    public function store(Request $request)
    {
        $penggunaId = session('pengguna_id');

        if (!$penggunaId) {
            return redirect()->route('login')->with('error', 'Silakan login dulu.');
        }

        $validated = $this->validatePayload($request);
        $validated['foto'] = $this->resolveFoto($request);

        $validated['pengguna_id'] = $penggunaId;
        $validated['harga'] = $validated['metode'] === 'harga' ? $validated['harga'] : null;
        $validated['status'] = 'tersedia';

        Barang::query()->create($validated);

        return redirect()->route('my-items.index')->with('success', 'Barang berhasil diposting.');
    }

    public function show(Barang $barang)
    {
        return view('items.show', [
            'item' => $barang,
        ]);
    }

    public function edit(Barang $barang)
    {
        $this->ensureOwner($barang->pengguna_id, (int) session('pengguna_id'));

        return view('items.edit', [
            'item' => $barang,
            'kategoriOptions' => Barang::KATEGORI,
            'kondisiOptions' => Barang::KONDISI,
            'metodeOptions' => Barang::METODE,
            'statusOptions' => Barang::STATUS,
        ]);
    }

    public function update(Request $request, Barang $barang)
    {
        $this->ensureOwner($barang->pengguna_id, (int) session('pengguna_id'));

        $validated = $this->validatePayload($request, true);

        if ($request->hasFile('foto') || $request->filled('foto_url')) {
            $validated['foto'] = $this->resolveFoto($request);
        }

        $validated['harga'] = $validated['metode'] === 'harga' ? $validated['harga'] : null;

        $barang->update($validated);

        return redirect()->route('my-items.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Barang $barang)
    {
        $this->ensureOwner($barang->pengguna_id, (int) session('pengguna_id'));

        $validated = $request->validate([
            'status' => ['required', Rule::in(Barang::STATUS)],
        ]);

        $barang->update(['status' => $validated['status']]);

        return redirect()->route('my-items.index')->with('success', 'Status barang diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $this->ensureOwner($barang->pengguna_id, (int) session('pengguna_id'));

        $barang->delete();

        return redirect()->route('my-items.index')->with('success', 'Barang dihapus.');
    }

    private function resolveFoto(Request $request): string
    {
        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => ['image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            ]);

            return app(UploadService::class)->foto($request->file('foto'), 'items');
        }

        $url = (string) $request->input('foto_url', '');

        if ($url === '' || ! filter_var($url, FILTER_VALIDATE_URL)) {
            throw ValidationException::withMessages([
                'foto' => 'Foto wajib diisi: unggah file gambar atau sertakan URL yang valid (http/https).',
            ]);
        }

        return $url;
    }

    private function validatePayload(Request $request, bool $isUpdate = false): array
    {
        $rules = [
            'nama_barang' => ['required', 'string', 'max:255'],
            'kategori' => ['required', Rule::in(Barang::KATEGORI)],
            'deskripsi' => ['required', 'string', 'min:10'],
            'kondisi' => ['required', Rule::in(Barang::KONDISI)],
            'metode' => ['required', Rule::in(Barang::METODE)],
            'harga' => ['nullable', 'integer', 'min:0'],
            'lokasi' => ['required', 'string', 'max:255'],
        ];

        if ($isUpdate) {
            $rules['status'] = ['nullable', Rule::in(Barang::STATUS)];
        }

        $validated = $request->validate($rules);

        if ($validated['metode'] === 'harga' && ($validated['harga'] ?? null) === null) {
            return $request->validate(array_merge($rules, [
                'harga' => ['required', 'integer', 'min:0'],
            ]));
        }

        return $validated;
    }
}
