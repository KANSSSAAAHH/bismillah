<div>
    <label class="text-sm font-semibold text-slate-700">Nama Barang</label>
    <input name="nama_barang" value="{{ old('nama_barang', $item->nama_barang ?? '') }}"
        class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required>
    @error('nama_barang')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<div>
    <label class="text-sm font-semibold text-slate-700">Kategori</label>
    <select name="kategori" class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required>
        @foreach ($kategoriOptions as $opt)
            <option value="{{ $opt }}" @selected(old('kategori', $item->kategori ?? '') === $opt)>
                {{ str_replace('_', ' ', $opt) }}</option>
        @endforeach
    </select>
    @error('kategori')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<div class="sm:col-span-2">
    <label class="text-sm font-semibold text-slate-700">Foto Barang</label>
    <input type="file" name="foto" accept="image/jpeg,image/png,image/webp" class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
    <p class="text-xs text-slate-500 mt-1">Unggah gambar (jpg/png/webp, maks 2MB)</p>
    @error('foto')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<div class="sm:col-span-2">
    <label class="text-sm font-semibold text-slate-700">atau URL foto (opsional)</label>
    <input name="foto_url" value="{{ old('foto_url', str_starts_with($item->foto ?? '', 'http') ? $item->foto : '') }}"
        class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="https://...">
    @if (!empty($item->foto))
        <p class="text-xs text-slate-500 mt-1">Foto saat ini: <a href="{{ $item->foto }}" target="_blank" class="text-blue-600 underline">{{ $item->foto }}</a></p>
    @endif
</div>

<div class="sm:col-span-2">
    <label class="text-sm font-semibold text-slate-700">Deskripsi</label>
    <textarea name="deskripsi" rows="4" class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
        required>{{ old('deskripsi', $item->deskripsi ?? '') }}</textarea>
    @error('deskripsi')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<div>
    <label class="text-sm font-semibold text-slate-700">Kondisi</label>
    <select name="kondisi" class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required>
        @foreach ($kondisiOptions as $opt)
            <option value="{{ $opt }}" @selected(old('kondisi', $item->kondisi ?? '') === $opt)>
                {{ str_replace('_', ' ', $opt) }}</option>
        @endforeach
    </select>
    @error('kondisi')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<div>
    <label class="text-sm font-semibold text-slate-700">Metode</label>
    <select name="metode" class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required>
        @foreach ($metodeOptions as $opt)
            <option value="{{ $opt }}" @selected(old('metode', $item->metode ?? '') === $opt)>{{ $opt }}</option>
        @endforeach
    </select>
    @error('metode')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<div>
    <label class="text-sm font-semibold text-slate-700">Harga (opsional jika donasi)</label>
    <input type="number" min="0" name="harga" value="{{ old('harga', $item->harga ?? '') }}"
        class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
    @error('harga')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

<div>
    <label class="text-sm font-semibold text-slate-700">Lokasi</label>
    <input name="lokasi" value="{{ old('lokasi', $item->lokasi ?? '') }}"
        class="mt-2 w-full rounded-lg border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required>
    @error('lokasi')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
</div>

@if (!empty($statusOptions))
    <div>
        <label class="text-sm font-medium">Status</label>
        <select name="status" class="mt-1 w-full rounded-lg border-slate-300">
            @foreach ($statusOptions as $opt)
                <option value="{{ $opt }}" @selected(old('status', $item->status ?? '') === $opt)>{{ $opt }}</option>
            @endforeach
        </select>
    </div>
@endif