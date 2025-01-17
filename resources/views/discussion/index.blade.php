@extends('layouts.master2')

@section('title', 'Forum Diskusi')

@section('content')
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(Auth::check() && Auth::user()->role == 'patient')
    <h2>Forum Diskusi</h2>
    <form action="{{ route('discussion.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="content" class="form-label">Pertanyaan</label>
            <textarea class="form-control" id="content" name="content" rows="4" placeholder="Masukkan pertanyaan Anda" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Pertanyaan</button>
    </form>
    @endif


    <h2>Pertanyaan Diskusi</h2>
    @foreach ($discussions as $discussion)
    <div class="card mb-3">
        <div class="card-body">
            <p class="card-text">{{ nl2br(e($discussion->discussion_content)) }}</p>
            <small class="text-muted">
                Dibuat oleh {{ $discussion->user->nama }}, pada: {{ $discussion->created_at->format('d M Y, H:i') }}
            @if(Auth::check())
                @if(Auth::user()->role == 'doctor' || Auth::user()->role == 'admin')
                    <a href="{{ url('discussion-answer/'.$discussion->id) }}" class="btn btn-info mt-2">Balas</a>
                @elseif(Auth::user()->role == 'patient')
                    <a href="{{ url('discussion-answer/'.$discussion->id) }}" class="btn btn-info mt-2">Lihat</a>
                @endif
            @endif
        </small>
        </div>
    </div>
    @endforeach



</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            // Clear the form if the success message exists
            document.getElementById('discussionForm').reset();
        @endif
    });
</script>
@endsection
