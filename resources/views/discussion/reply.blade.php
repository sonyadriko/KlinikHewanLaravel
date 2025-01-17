@extends('layouts.master2')

@section('title', 'Balas Pertanyaan')

@section('content')
<div class="container mt-4">

    {{-- Header --}}
    <h1 class="mb-4">Balas Pertanyaan</h1>

    {{-- Alert Sukses --}}
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif

    {{-- Alert Error --}}
    @if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif

    {{-- Detail Pertanyaan --}}
    <div class="card mb-4">
        <div class="card-body">
            <p class="card-text">{{ nl2br(e($question->discussion_content)) }}</p>
            <small class="text-muted">Dibuat oleh {{ $question->user->nama }}, pada {{ $question->created_at->format('d M Y, H:i') }}</small>
        </div>
    </div>

    {{-- Form Balasan (Hanya untuk Admin & Dokter) --}}
    @if(in_array(Auth::user()->role, ['doctor', 'admin']))
    <form action="{{ route('discussion_answer.store', $question->id) }}" method="POST" class="mb-4">
        @csrf

        {{-- Input Balasan --}}
        <div class="mb-3">
            <label for="content" class="form-label">Isi Balasan</label>
            <textarea
                class="form-control @error('content') is-invalid @enderror"
                id="content"
                name="content"
                rows="4"
                placeholder="Masukkan balasan Anda"
                required>{{ old('content') }}</textarea>

            {{-- Error Handling --}}
            @error('content')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Kirim Balasan</button>
    </form>
    @endif

    {{-- List Balasan --}}
    <h2>Balasan</h2>
    @forelse ($answers as $answer)
        {{-- Komponen Balasan --}}
        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text">{{ nl2br(e($answer->answer_content)) }}</p>
                <small class="text-muted">Dibalas oleh {{ $answer->user->nama }}, pada {{ $answer->created_at->format('d M Y, H:i') }}</small>
            </div>
        </div>
    @empty
    <p class="text-muted">Belum ada balasan.</p>
    @endforelse
</div>
@endsection
