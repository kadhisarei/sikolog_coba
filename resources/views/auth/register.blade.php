@extends('layouts.app')
@section('title', 'Daftar')
@section('content')
<div class="max-w-md mx-auto bg-white rounded-2xl shadow-lg p-8 border-t-4 border-sage">
    <h2 class="text-2xl font-bold mb-6 text-center">Daftar Akun Baru</h2>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="w-full border border-sage/50 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-peach">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full border border-sage/50 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-peach">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">No. HP (opsional)</label>
            <input type="text" name="phone" value="{{ old('phone') }}"
                   class="w-full border border-sage/50 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-peach">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Kata Sandi</label>
            <input type="password" name="password" required
                   class="w-full border border-sage/50 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-peach">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Konfirmasi Kata Sandi</label>
            <input type="password" name="password_confirmation" required
                   class="w-full border border-sage/50 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-peach">
        </div>
        <button class="w-full bg-sage hover:bg-peach transition text-white py-2.5 rounded-lg font-medium">Daftar</button>
    </form>
    <p class="text-sm text-center mt-4">Sudah punya akun? <a href="{{ route('login') }}" class="text-peach font-medium">Masuk</a></p>
</div>
@endsection
