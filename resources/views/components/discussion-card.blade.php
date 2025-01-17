<div class="card mb-3">
    <div class="card-body">
        <p class="card-text">{{ nl2br(e($discussion->discussion_content)) }}</p>
        <small class="text-muted">Dibuat oleh {{ $discussion->user->nama }}, pada: {{ $discussion->created_at->format('d M Y, H:i') }}
            @if(Auth::check() && Auth::user()->role == 'doctor' || Auth::user()->role == 'admin')
                <a href="{{ url('discussion-answer/'.$discussion->id) }}" class="btn btn-info mt-2">Balas</a>
            @elseif(Auth::check() && Auth::user()->role == 'patient')
                <a href="{{ url('discussion-answer/'.$discussion->id) }}" class="btn btn-info mt-2">Lihat</a>
            @endif
        </small>
    </div>
</div>
