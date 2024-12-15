@extends('layouts.master2')

@section('title', 'Tambah Hewan')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="page-title-content">
                    <p>
                        Halaman
                        <strong>Tambah Hewan</strong>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Tambah Hewan</h4>
                    </div>
                    <div class="card-body">
                        {{-- Form --}}
                        <form action="{{ route('hewan.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_hewan" class="form-label">Nama Hewan</label>
                                <input type="text" class="form-control" id="nama_hewan" name="nama_hewan"
                                    placeholder="Masukkan nama hewan" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="Jantan">Jantan</option>
                                    <option value="Betina">Betina</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_hewan" class="form-label">Jenis Hewan</label>
                                <select class="form-control" id="jenis_hewan" name="jenis_hewan" required>
                                    <option value="Kucing">Kucing</option>
                                    <option value="Anjing">Anjing</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="ras_hewan" class="form-label">Ras Hewan</label>
                                <input type="text" class="form-control" id="ras_hewan" name="ras_hewan"
                                    placeholder="Masukkan ras hewan" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SweetAlert for Success Message --}}
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Sukses',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route('profile') }}';
                }
            });
        </script>
    @endif
@endsection
