@extends('layouts.app')
@section('title', 'Masuk')
@section('content')
<div class="max-w-md mx-auto bg-white rounded-2xl shadow-lg p-8 border-t-4 border-peach">
    <h2 class="text-2xl font-bold mb-6 text-center">Masuk ke MindCare</h2>
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="w-full border border-sage/50 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-peach">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Kata Sandi</label>
            <input type="password" name="password" required
                   class="w-full border border-sage/50 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-peach">
        </div>
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="remember"> Ingat saya
        </label>
        <button class="w-full bg-peach hover:bg-sage transition text-white py-2.5 rounded-lg font-medium">Masuk</button>
    </form>
    <p class="text-sm text-center mt-4">Belum punya akun? <a href="{{ route('register') }}" class="text-peach font-medium">Daftar di sini</a></p>

    <div class="mt-6 text-xs bg-cream border border-sage/40 rounded-lg p-3">
        <p class="font-semibold mb-1">Akun demo (setelah seeding):</p>
        <p>Admin: admin@mindcare.test / password123</p>
        <p>Dokter: ayu.psikolog@mindcare.test / password123</p>
        <p>User: budi@mindcare.test / password123</p>
    </div>
</div>
@endsection
