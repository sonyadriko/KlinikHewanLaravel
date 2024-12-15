@extends('layouts.master2')

@section('title', 'Detail Artikel')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title-content">
                        <h2>{{ $article->judul }}</h2>
                        <p>
                            <strong>Penulis:</strong> {{ $article->penulis }}<br>
                            <strong>Tanggal:</strong>
                            {{ \Carbon\Carbon::parse($article->created_at)->format('d-m-Y H:i:s') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <!-- Pastikan untuk mengecek apakah gambar ada -->
                        <img class="img-fluid card-img-top" src="{{ asset($article->image) }}" alt="" />
                        <div class="card-body">
                            <p style="color: #000;">{!! nl2br(e($article->isi)) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
