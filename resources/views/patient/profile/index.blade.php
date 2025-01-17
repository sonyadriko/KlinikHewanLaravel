@extends('layouts.master2')

@section('title', 'Profil')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Informasi</h4>
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm"
                            style="text-decoration: none;">Edit Profil</a>
                    </div>
                    <div class="card-body">
                        @if ($user)
                            <div class="row">
                                <div class="col-lg-4 col-md-6 ">
                                    <div class="user-info">
                                        <h5 class="mb-2">Nama</h5>
                                        <p class="lead">{{ $user->nama ?? 'Kosong' }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 ">
                                    <div class="user-info">
                                        <h5 class="mb-2">Email Address</h5>
                                        <p class="lead">{{ $user->email ?? 'Kosong' }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 ">
                                    <div class="user-info">
                                        <h5 class="mb-2">Alamat</h5>
                                        <p class="lead">{{ $user->alamat ?? 'Kosong' }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 ">
                                    <div class="user-info">
                                        <h5 class="mb-2">Nomor Telepon</h5>
                                        <p class="lead">{{ $user->notelp ?? 'Kosong' }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 ">
                                    <div class="user-info">
                                        <h5 class="mb-2">Role</h5>
                                        <p class="lead">{{ $user->role ?? 'Kosong' }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning" role="alert">
                                Data tidak ditemukan
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Hewan</h4>
                        <a href="{{ route('hewan.create') }}" class="btn btn-primary" style="text-decoration: none;">Tambah
                            Data Hewan</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="areaTable" class="table table-hover table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Hewan</th>
                                        <th>Jenis Hewan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Ras Hewan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($animals as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->nama_hewan }}</td>
                                            <td>{{ $item->jenis_hewan }}</td>
                                            <td>{{ $item->jenis_kelamin }}</td>
                                            <td>{{ $item->ras_hewan }}</td>
                                            <td>
                                                <div class="action-buttons d-flex">
                                                    <a href="{{ route('hewan.edit', $item->id_hewan) }}"
                                                        class="btn btn-primary btn-user me-2">Ubah</a>
                                                    <form action="{{ route('hewan.delete', $item->id_hewan) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data hewan ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">Data tidak tersedia</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#areaTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "lengthChange": true,
                "pageLength": 10,
                "language": {
                    "paginate": {
                        "previous": "<i class='bi bi-arrow-left'></i>",
                        "next": "<i class='bi bi-arrow-right'></i>"
                    }
                }
            });
        });
    </script>
@endsection
