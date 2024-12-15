@extends('layouts.master2')

@section('title', 'Create Article')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Artikel</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" name="judul" id="judul" class="form-control"
                                    value="{{ old('judul') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="isi" class="form-label">Isi Artikel</label>
                                <textarea name="isi" id="isi" class="form-control" rows="10" required>{{ old('isi') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Unggah Gambar</label>
                                <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
