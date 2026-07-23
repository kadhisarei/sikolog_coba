@extends('layouts.app')
@section('title', 'Hasil Tes')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg p-8 border-t-4 border-peach">
    <h1 class="text-2xl font-bold mb-1">{{ $result->test->judul }}</h1>
    <p class="text-olive/60 text-sm mb-6">Diselesaikan pada {{ $result->selesai_pada->format('d M Y, H:i') }}</p>

    <x-progress-bar :persen="$result->persentase" label="Skor Anda" />

    <div class="grid grid-cols-2 gap-4 mt-6 text-center">
        <div class="bg-cream rounded-xl p-4">
            <p class="text-xs text-olive/60">Kategori Hasil</p>
            <p class="text-xl font-bold text-peach">{{ $result->kategori_hasil }}</p>
        </div>
        <div class="bg-cream rounded-xl p-4">
            <p class="text-xs text-olive/60">Skor</p>
            <p class="text-xl font-bold text-sage">{{ $result->total_skor }} / {{ $result->skor_maksimal }}</p>
        </div>
    </div>

    <div class="mt-6">
        <h3 class="font-semibold mb-2">Interpretasi</h3>
        <p class="text-sm text-olive/80 leading-relaxed">{{ $result->interpretasi }}</p>
    </div>

    <div class="mt-8 flex gap-3">
        <a href="{{ route('tests.index') }}" class="flex-1 text-center border border-olive text-olive py-2.5 rounded-lg hover:bg-cream transition">Kembali ke Daftar Tes</a>
        <a href="{{ route('consultations.index') }}" class="flex-1 text-center bg-peach hover:bg-sage transition text-white py-2.5 rounded-lg">Konsultasi Sekarang</a>
    </div>
</div>
@endsection
