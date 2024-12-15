@extends('layouts.master2')

@section('title', 'Edit Article')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-xl-12">
                <div class="page-title-content">
                    <p>
                        Halaman
                        <strong>Edit Artikel</strong>
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Edit Artikel</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('article.update', $article->id_artikel) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" required
                                    value="{{ old('judul', $article->judul) }}">
                            </div>

                            <div class="mb-3">
                                <label for="isi" class="form-label">Isi Artikel</label>
                                <textarea class="form-control" style="height: auto;" id="isi" name="isi" rows="10">{{ old('isi', $article->isi) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="gambar" name="gambar">

                                @if ($article->image && Storage::disk('public')->exists($article->image))
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="Gambar Artikel"
                                        width="200">
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
