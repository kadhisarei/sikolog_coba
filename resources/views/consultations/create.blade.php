@extends('layouts.app')
@section('title', 'Booking Konsultasi')
@section('content')
<div class="max-w-xl mx-auto bg-white rounded-2xl shadow-lg p-8 border-t-4 border-peach">
    <h1 class="text-xl font-bold mb-1">Booking dengan {{ $dokter->name }}</h1>
    <p class="text-sm text-olive/60 mb-6">{{ optional($dokter->doctorProfile)->spesialisasi }}</p>

    <form method="POST" action="{{ route('consultations.store', $dokter) }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Tanggal Konsultasi</label>
            <input type="date" name="tanggal_konsultasi" required min="{{ date('Y-m-d') }}"
                   class="w-full border border-sage/50 rounded-lg px-4 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Jam Konsultasi</label>
            <input type="time" name="jam_konsultasi" required
                   class="w-full border border-sage/50 rounded-lg px-4 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Metode</label>
            <select name="metode" required class="w-full border border-sage/50 rounded-lg px-4 py-2">
                <option value="chat">Chat</option>
                <option value="video_call">Video Call</option>
                <option value="tatap_muka">Tatap Muka</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Keluhan Anda</label>
            <textarea name="keluhan" rows="4" required class="w-full border border-sage/50 rounded-lg px-4 py-2" placeholder="Ceritakan singkat kondisi/keluhan Anda..."></textarea>
        </div>
        <button class="w-full bg-peach hover:bg-sage transition text-white py-3 rounded-lg font-medium">Kirim Booking</button>
    </form>
</div>
@endsection
