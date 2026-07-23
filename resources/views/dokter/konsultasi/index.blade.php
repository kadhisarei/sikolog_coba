@extends('layouts.app')
@section('title', 'Konsultasi Saya')
@section('content')
<h1 class="text-2xl font-bold mb-6">Kelola Konsultasi</h1>

<div class="bg-white rounded-2xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-cream text-left">
            <tr>
                <th class="px-4 py-3">Pasien</th>
                <th class="px-4 py-3">Tanggal</th>
                <th class="px-4 py-3">Metode</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($konsultasi as $k)
                <tr class="border-b border-cream">
                    <td class="px-4 py-3">{{ $k->user->name }}</td>
                    <td class="px-4 py-3">{{ $k->tanggal_konsultasi->format('d M Y') }} {{ $k->jam_konsultasi }}</td>
                    <td class="px-4 py-3 capitalize">{{ str_replace('_', ' ', $k->metode) }}</td>
                    <td class="px-4 py-3 capitalize">{{ $k->status }}</td>
                    <td class="px-4 py-3">
                        @if(!in_array($k->status, ['selesai', 'dibatalkan']))
                        <form method="POST" action="{{ route('dokter.konsultasi.update', $k) }}" class="flex gap-2">
                            @csrf @method('PATCH')
                            <select name="status" class="border border-sage/50 rounded-lg px-2 py-1 text-xs">
                                <option value="dikonfirmasi" @selected($k->status=='dikonfirmasi')>Dikonfirmasi</option>
                                <option value="berlangsung" @selected($k->status=='berlangsung')>Berlangsung</option>
                                <option value="selesai" @selected($k->status=='selesai')>Selesai</option>
                                <option value="dibatalkan" @selected($k->status=='dibatalkan')>Dibatalkan</option>
                            </select>
                            <button class="bg-sage hover:bg-peach transition text-white px-3 py-1 rounded-lg text-xs">Update</button>
                        </form>
                        @else
                            <span class="text-olive/50 text-xs">-</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $konsultasi->links() }}</div>
@endsection
