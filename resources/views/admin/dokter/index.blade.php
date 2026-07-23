@extends('layouts.app')
@section('title', 'Kelola Dokter')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Kelola Akun Dokter</h1>
    <a href="{{ route('admin.dokter.create') }}" class="bg-peach hover:bg-sage transition text-white px-4 py-2 rounded-lg text-sm font-medium">+ Tambah Dokter</a>
</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-cream text-left">
            <tr>
                <th class="px-4 py-3">Nama</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Jenis</th>
                <th class="px-4 py-3">Spesialisasi</th>
                <th class="px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dokter as $d)
                <tr class="border-b border-cream">
                    <td class="px-4 py-3">{{ $d->name }}</td>
                    <td class="px-4 py-3">{{ $d->email }}</td>
                    <td class="px-4 py-3 capitalize">{{ optional($d->doctorProfile)->jenis }}</td>
                    <td class="px-4 py-3">{{ optional($d->doctorProfile)->spesialisasi }}</td>
                    <td class="px-4 py-3">
                        <form method="POST" action="{{ route('admin.dokter.destroy', $d) }}" onsubmit="return confirm('Hapus akun dokter ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:underline text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $dokter->links() }}</div>
@endsection
