@extends('layouts.master2')

@section('title', 'Dashboard')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title-content">
                        <p>
                            Selamat Datang,
                            <strong>{{ Auth::user()->role }}</strong>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="row">
                        @foreach ($articles as $article)
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="blog-grid">
                                    <div class="card">
                                        <img class="img-fluid card-img-top" src="{{ Storage::url($article->image) }}"
                                            alt="" />
                                        <div class="card-body">
                                            <h4 class="card-title">{{ $article->judul }}</h4>
                                            <a href="{{ route('article.show', ['id' => $article->id_artikel]) }}">Read
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endsection
