@extends('layouts.master2')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="page-title-content">
                    <p>
                        Halaman
                        <strong> Ubah Hewan</strong>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Ubah Hewan</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('hewan.update', $hewan->id_hewan) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id_hewan" value="{{ $hewan->id_hewan }}">

                            <div class="mb-3">
                                <label for="nama_hewan" class="form-label">Nama Hewan</label>
                                <input type="text" class="form-control" id="nama_hewan" name="nama_hewan"
                                    value="{{ old('nama_hewan', $hewan->nama_hewan) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="Jantan" {{ $hewan->jenis_kelamin == 'Jantan' ? 'selected' : '' }}>Jantan
                                    </option>
                                    <option value="Betina" {{ $hewan->jenis_kelamin == 'Betina' ? 'selected' : '' }}>Betina
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="jenis_hewan" class="form-label">Jenis Hewan</label>
                                <select class="form-control" id="jenis_hewan" name="jenis_hewan" required>
                                    <option value="Kucing" {{ $hewan->jenis_hewan == 'Kucing' ? 'selected' : '' }}>Kucing
                                    </option>
                                    <option value="Anjing" {{ $hewan->jenis_hewan == 'Anjing' ? 'selected' : '' }}>Anjing
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="ras_hewan" class="form-label">Ras Hewan</label>
                                <input type="text" class="form-control" id="ras_hewan" name="ras_hewan"
                                    value="{{ old('ras_hewan', $hewan->ras_hewan) }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    title: 'Sukses',
                    text: 'Data hewan berhasil diubah!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ route('profile.index') }}';
                    }
                });
            @endif
        });
    </script>
@endpush
