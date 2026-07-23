@extends('layouts.app')
@section('title', 'Konsultasi')
@section('content')
<h1 class="text-2xl font-bold mb-6">Pilih Psikolog / Psikiater</h1>
<div class="grid md:grid-cols-2 gap-6">
    @foreach($dokterList as $dokter)
        <div class="bg-white rounded-2xl shadow p-6 border-t-4 border-sage">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <h3 class="font-semibold text-lg">{{ $dokter->name }}</h3>
                    <span class="text-xs uppercase bg-cream text-olive px-2 py-1 rounded-full">{{ optional($dokter->doctorProfile)->jenis }}</span>
                </div>
                <span class="text-peach font-bold">Rp{{ number_format(optional($dokter->doctorProfile)->tarif_konsultasi ?? 0, 0, ',', '.') }}</span>
            </div>
            <p class="text-sm text-olive/70 mb-1">{{ optional($dokter->doctorProfile)->spesialisasi }} · {{ optional($dokter->doctorProfile)->pengalaman_tahun }} tahun pengalaman</p>
            <p class="text-sm text-olive/70 mb-4">{{ optional($dokter->doctorProfile)->bio }}</p>
            <a href="{{ route('consultations.create', $dokter) }}" class="inline-block bg-sage hover:bg-peach transition text-white px-4 py-2 rounded-lg text-sm font-medium">Booking Konsultasi</a>
        </div>
    @endforeach
</div>
@endsection
