@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<h1 class="text-2xl font-bold mb-6">Halo, {{ auth()->user()->name }} 👋</h1>

<div class="grid md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-peach md:col-span-2">
        <h3 class="font-semibold mb-3">Progres Tes Kejiwaan Anda</h3>
        <x-progress-bar :persen="$persentaseProgres" label="Tes yang telah diselesaikan" />
        <p class="text-xs text-olive/70 mt-2">Anda telah mengerjakan {{ count($riwayatTes) ? $riwayatTes->pluck('personality_test_id')->unique()->count() : 0 }} dari {{ $totalTesAktif }} tes yang tersedia.</p>
        <a href="{{ route('tests.index') }}" class="inline-block mt-4 bg-peach text-white px-4 py-2 rounded-lg text-sm hover:bg-sage transition">Kerjakan Tes Lainnya</a>
    </div>
    <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-sage flex flex-col justify-center items-center text-center">
        <p class="text-sm text-olive/70">Progres Anda</p>
        <p class="text-4xl font-bold text-peach">{{ number_format($persentaseProgres, 0) }}%</p>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-6">
    <div class="bg-white rounded-2xl shadow p-6">
        <h3 class="font-semibold mb-4">Riwayat Konsultasi Terbaru</h3>
        @forelse($riwayatKonsultasi as $k)
            <div class="border-b border-cream py-2 text-sm flex justify-between">
                <span>{{ $k->tanggal_konsultasi->format('d M Y') }} - {{ ucfirst($k->metode) }}</span>
                <span class="capitalize font-medium text-olive/80">{{ $k->status }}</span>
            </div>
        @empty
            <p class="text-sm text-olive/60">Belum ada konsultasi.</p>
        @endforelse
        <a href="{{ route('consultations.index') }}" class="inline-block mt-4 text-peach font-medium text-sm">Booking Konsultasi &rarr;</a>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <h3 class="font-semibold mb-4">Riwayat Hasil Tes</h3>
        @forelse($riwayatTes as $r)
            <div class="border-b border-cream py-2 text-sm flex justify-between">
                <span>{{ $r->test->judul }}</span>
                <span class="font-medium">{{ $r->kategori_hasil }} ({{ $r->persentase }}%)</span>
            </div>
        @empty
            <p class="text-sm text-olive/60">Belum ada hasil tes.</p>
        @endforelse
    </div>
</div>
@endsection
