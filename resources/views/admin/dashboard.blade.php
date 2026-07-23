@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

<div class="grid md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow p-6 text-center border-l-4 border-peach">
        <p class="text-xs text-olive/60">Total User</p>
        <p class="text-3xl font-bold">{{ $totalUser }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow p-6 text-center border-l-4 border-sage">
        <p class="text-xs text-olive/60">Total Dokter</p>
        <p class="text-3xl font-bold">{{ $totalDokter }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow p-6 text-center border-l-4 border-peach">
        <p class="text-xs text-olive/60">Total Konsultasi</p>
        <p class="text-3xl font-bold">{{ $totalKonsultasi }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow p-6 text-center border-l-4 border-sage">
        <p class="text-xs text-olive/60">Tingkat Penyelesaian</p>
        <p class="text-3xl font-bold text-peach">{{ $tingkatPenyelesaian }}%</p>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-6">
    <div class="bg-white rounded-2xl shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-semibold">Persentase Kinerja Dokter</h3>
            <a href="{{ route('admin.dokter.index') }}" class="text-peach text-sm font-medium">Kelola Dokter &rarr;</a>
        </div>
        <div class="space-y-4">
            @forelse($dokterList as $d)
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>{{ $d['name'] }} <span class="text-xs text-olive/50">({{ $d['jenis'] }})</span></span>
                        <span class="font-semibold">{{ $d['persentase_kinerja'] }}%</span>
                    </div>
                    <x-progress-bar :persen="$d['persentase_kinerja']" />
                </div>
            @empty
                <p class="text-sm text-olive/60">Belum ada data dokter.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <h3 class="font-semibold mb-4">Persentase Progres Tes User</h3>
        <div class="space-y-4">
            @forelse($userList as $u)
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>{{ $u['name'] }}</span>
                        <span class="font-semibold">{{ $u['persentase_progres_tes'] }}%</span>
                    </div>
                    <x-progress-bar :persen="$u['persentase_progres_tes']" />
                </div>
            @empty
                <p class="text-sm text-olive/60">Belum ada data user.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
