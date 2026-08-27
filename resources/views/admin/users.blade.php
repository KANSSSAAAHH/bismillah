@extends('layouts.app')

@section('admin_title', 'Manajemen Pengguna')

@section('content')
    @include('admin._nav')

    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
        <div class="px-5 py-3 border-b border-slate-100">
            <h2 class="font-bold">Daftar Pengguna</h2>
        </div>

        @if ($users->isEmpty())
            <p class="text-sm text-slate-500 p-5">Belum ada pengguna.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-left text-slate-500">
                        <tr>
                            <th class="px-5 py-3 font-medium">Nama</th>
                            <th class="px-3 py-3 font-medium">Email</th>
                            <th class="px-3 py-3 font-medium">Role</th>
                            <th class="px-3 py-3 font-medium">Jumlah Barang</th>
                            <th class="px-5 py-3 font-medium">Ubah Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-t border-slate-100">
                                <td class="px-5 py-3 font-semibold">{{ $user->nama }}</td>
                                <td class="px-3 py-3 text-slate-600">{{ $user->email }}</td>
                                <td class="px-3 py-3">
                                    <span class="px-2 py-0.5 rounded text-xs font-semibold
                                        {{ $user->role === 'admin' ? 'bg-rose-100 text-rose-700' : ($user->role === 'sekolah' ? 'bg-cyan-100 text-cyan-700' : 'bg-emerald-100 text-emerald-700') }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="px-3 py-3 text-slate-600">{{ $user->barang->count() }}</td>
                                <td class="px-5 py-3">
                                    <form action="{{ route('admin.users.role', $user) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <select name="role"
                                            class="rounded border-slate-300 text-sm py-1">
                                            @foreach ($roles as $key => $label)
                                                <option value="{{ $key }}" @selected($user->role === $key)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit"
                                            class="px-3 py-1 rounded text-xs font-semibold bg-slate-900 text-white hover:bg-black">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="px-5 py-3 border-t border-slate-100">
            {{ $users->links() }}
        </div>
    </div>
@endsection