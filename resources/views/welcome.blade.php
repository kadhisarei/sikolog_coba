@extends('layouts.app')
@section('title', 'Beranda')
@section('content')
<div class="grid md:grid-cols-2 gap-10 items-center py-10">
    <div>
        <h1 class="text-4xl font-bold text-olive leading-tight mb-4">
            Ruang Aman untuk Kesehatan <span class="text-peach">Mental</span> Anda
        </h1>
        <p class="text-olive/80 mb-6 leading-relaxed">
            Konsultasi langsung dengan psikolog dan psikiater berpengalaman, serta lakukan tes kejiwaan
            (kepribadian, kecemasan, dan lainnya) untuk memahami kondisi psikologis Anda lebih baik.
        </p>
        <div class="flex gap-4">
            <a href="{{ route('register') }}" class="bg-peach hover:bg-sage text-white px-6 py-3 rounded-xl font-medium transition">Mulai Sekarang</a>
            <a href="{{ route('login') }}" class="border border-olive text-olive px-6 py-3 rounded-xl font-medium hover:bg-white transition">Masuk</a>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-lg p-8 border-t-4 border-sage">
        <h3 class="font-semibold text-lg mb-4">Layanan Kami</h3>
        <ul class="space-y-3 text-sm">
            <li class="flex gap-3 items-start"><span class="bg-sage text-white rounded-full w-6 h-6 flex items-center justify-center shrink-0">1</span> Konsultasi online dengan psikolog & psikiater berlisensi</li>
            <li class="flex gap-3 items-start"><span class="bg-sage text-white rounded-full w-6 h-6 flex items-center justify-center shrink-0">2</span> Tes kepribadian & skrining kondisi kejiwaan</li>
            <li class="flex gap-3 items-start"><span class="bg-sage text-white rounded-full w-6 h-6 flex items-center justify-center shrink-0">3</span> Pantau progres & riwayat konsultasi Anda</li>
        </ul>
    </div>
</div>
@endsection
