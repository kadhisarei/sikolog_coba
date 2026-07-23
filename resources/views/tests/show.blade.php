@extends('layouts.app')
@section('title', $test->judul)
@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-2">{{ $test->judul }}</h1>
    <p class="text-olive/70 mb-6">{{ $test->deskripsi }}</p>

    <form method="POST" action="{{ route('tests.submit', $test->slug) }}" class="space-y-6">
        @csrf
        @foreach($test->questions as $i => $question)
            <div class="bg-white rounded-2xl shadow p-6">
                <p class="font-medium mb-4">{{ $i + 1 }}. {{ $question->pertanyaan }}</p>
                <div class="space-y-2">
                    @foreach($question->options as $option)
                        <label class="flex items-center gap-3 border border-sage/30 rounded-lg px-4 py-2 cursor-pointer hover:bg-cream">
                            <input type="radio" name="jawaban[{{ $question->id }}]" value="{{ $option->id }}" required class="accent-peach">
                            <span class="text-sm">{{ $option->label_jawaban }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach
        <button class="w-full bg-peach hover:bg-sage transition text-white py-3 rounded-lg font-medium">Selesaikan Tes</button>
    </form>
</div>
@endsection
