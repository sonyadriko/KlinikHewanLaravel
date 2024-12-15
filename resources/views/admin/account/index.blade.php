@extends('layouts.master2')

@section('title', 'Akun Pemilik Hewan')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="page-title-content">
                    <p>
                        Halaman
                        <strong> Akun Pemilik Hewan</strong>
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Akun Pemilik Hewan</h4>
                        <a href="{{ route('account-patient.create') }}" class="btn btn-primary">
                            Tambah Data Pemilik Hewan
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="areaTable" class="table table-hover table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <!-- <th>Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $user->email }}</td>
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
