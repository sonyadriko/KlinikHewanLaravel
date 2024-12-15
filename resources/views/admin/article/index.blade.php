@extends('layouts.master2')

@section('title', 'Article')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="page-title-content">
                    <p>
                        Halaman <strong>Artikel</strong>
                    </p>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Data Artikel</h4>
                        <a href="{{ route('article.create') }}" class="btn btn-primary">Tambah Data Artikel</a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="areaTable" class="table table-hover table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Isi</th>
                                        <th>Penulis</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($articles as $key => $article)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $article->judul }}</td>
                                            <td>{{ Str::limit($article->isi, 500, '...') }}</td>
                                            <td>{{ $article->penulis }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('article.edit', $article->id_artikel) }}"
                                                        class="btn btn-primary btn-sm">Ubah</a>
                                                    <form action="{{ route('article.destroy', $article->id_artikel) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin ingin menghapus artikel ini?')">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- Memuat jQuery versi terbaru -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Menginisialisasi DataTable
            $('#areaTable').DataTable({
                "responsive": true, // Menyusun ulang tabel agar responsif
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/Indonesian.json" // Opsional, untuk bahasa Indonesia
                }
            });
        });
    </script>
@endsection
