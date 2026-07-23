@extends('layouts.app')
@section('title', 'Dashboard Dokter')
@section('content')
<h1 class="text-2xl font-bold mb-6">Selamat datang, {{ auth()->user()->name }}</h1>

<div class="grid md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow p-6 text-center border-l-4 border-peach">
        <p class="text-xs text-olive/60">Total Konsultasi</p>
        <p class="text-3xl font-bold">{{ $totalKonsultasi }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow p-6 text-center border-l-4 border-sage">
        <p class="text-xs text-olive/60">Selesai</p>
        <p class="text-3xl font-bold">{{ $selesai }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow p-6 text-center border-l-4 border-peach">
        <p class="text-xs text-olive/60">Rata-rata Rating</p>
        <p class="text-3xl font-bold">{{ $rataRating ? number_format($rataRating, 1) : '-' }} / 5</p>
    </div>
    <div class="bg-white rounded-2xl shadow p-6 text-center border-l-4 border-sage">
        <p class="text-xs text-olive/60">Persentase Kinerja</p>
        <p class="text-3xl font-bold text-peach">{{ number_format($persentaseKinerja, 0) }}%</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow p-6 mb-8">
    <h3 class="font-semibold mb-3">Skor Kinerja Anda</h3>
    <x-progress-bar :persen="$persentaseKinerja" label="Gabungan tingkat penyelesaian & kepuasan pasien" />
</div>

<div class="bg-white rounded-2xl shadow p-6">
    <h3 class="font-semibold mb-4">Jadwal Konsultasi Mendatang</h3>
    @forelse($konsultasiMendatang as $k)
        <div class="border-b border-cream py-3 flex justify-between items-center text-sm">
            <div>
                <p class="font-medium">{{ $k->user->name }}</p>
                <p class="text-olive/60">{{ $k->tanggal_konsultasi->format('d M Y') }} · {{ $k->jam_konsultasi }} · {{ ucfirst($k->metode) }}</p>
            </div>
            <span class="capitalize bg-cream px-3 py-1 rounded-full text-xs">{{ $k->status }}</span>
        </div>
    @empty
        <p class="text-sm text-olive/60">Belum ada jadwal konsultasi mendatang.</p>
    @endforelse
    <a href="{{ route('dokter.konsultasi.index') }}" class="inline-block mt-4 text-peach font-medium text-sm">Lihat Semua Konsultasi &rarr;</a>
</div>
@endsection
