@extends('layouts.master2')

@section('title', 'Forum Diskusi')

@section('content')
<div class="container mt-4">

    <h2>Pertanyaan Diskusi</h2>
    @foreach ($discussions as $discussion)
        @include('components.discussion-card', ['discussion' => $discussion])
    @endforeach

</div>
@endsection
