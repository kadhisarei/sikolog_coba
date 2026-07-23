@extends('layouts.app')
@section('title', 'Tambah Dokter')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg p-8 border-t-4 border-peach">
    <h1 class="text-xl font-bold mb-6">Tambah Akun Dokter/Psikiater</h1>
    <form method="POST" action="{{ route('admin.dokter.store') }}" class="space-y-4">
        @csrf
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full border border-sage/50 rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" required class="w-full border border-sage/50 rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Kata Sandi</label>
                <input type="password" name="password" required class="w-full border border-sage/50 rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Jenis</label>
                <select name="jenis" required class="w-full border border-sage/50 rounded-lg px-4 py-2">
                    <option value="psikolog">Psikolog</option>
                    <option value="psikiater">Psikiater</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">No. STR / Izin Praktik</label>
                <input type="text" name="str_number" class="w-full border border-sage/50 rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Spesialisasi</label>
                <input type="text" name="spesialisasi" class="w-full border border-sage/50 rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Pengalaman (tahun)</label>
                <input type="number" name="pengalaman_tahun" min="0" class="w-full border border-sage/50 rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Tarif Konsultasi (Rp)</label>
                <input type="number" name="tarif_konsultasi" min="0" class="w-full border border-sage/50 rounded-lg px-4 py-2">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Bio Singkat</label>
            <textarea name="bio" rows="3" class="w-full border border-sage/50 rounded-lg px-4 py-2"></textarea>
        </div>
        <button class="w-full bg-peach hover:bg-sage transition text-white py-3 rounded-lg font-medium">Simpan Akun Dokter</button>
    </form>
</div>
@endsection
