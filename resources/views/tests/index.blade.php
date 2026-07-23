@extends('layouts.app')
@section('title', 'Tes Kejiwaan')
@section('content')
<h1 class="text-2xl font-bold mb-6">Tes Kepribadian & Kejiwaan</h1>
<div class="grid md:grid-cols-2 gap-6">
    @foreach($tests as $test)
        <div class="bg-white rounded-2xl shadow p-6 border-t-4 border-sage flex flex-col">
            <span class="text-xs uppercase tracking-wide text-peach font-semibold mb-1">{{ $test->kategori }}</span>
            <h3 class="text-lg font-semibold mb-2">{{ $test->judul }}</h3>
            <p class="text-sm text-olive/70 flex-1">{{ $test->deskripsi }}</p>
            <p class="text-xs text-olive/60 mt-3">{{ $test->questions_count }} pertanyaan</p>
            <a href="{{ route('tests.show', $test->slug) }}" class="mt-4 bg-sage hover:bg-peach transition text-white text-center py-2 rounded-lg text-sm font-medium">Mulai Tes</a>
        </div>
    @endforeach
</div>
@endsection
