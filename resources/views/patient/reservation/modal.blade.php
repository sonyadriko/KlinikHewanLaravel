<div class="modal fade" id="reservasiModal" tabindex="-1" role="dialog" aria-labelledby="reservasiModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservasiModalLabel">Form Reservasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reservasiForm" action="{{ route('reservation.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="tanggal_reservasi" class="form-label">Tanggal Reservasi</label>
                        <input type="date" class="form-control" id="tanggal_reservasi" name="tanggal_reservasi"
                            min="{{ now()->toDateString() }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="hewan_id" class="form-label">Pilih Hewan</label>
                        <select class="form-control" id="hewan_id" name="hewan_id" required>
                            @foreach ($pets as $pet)
                                <option value="{{ $pet->id_hewan }}">{{ $pet->nama_hewan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="service_type" class="form-label">Jenis Layanan</label>
                        <input type="text" class="form-control" id="service_type" name="service_type"
                            value="pemeriksaan" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="slot_reservasi" class="form-label">Pilih Slot</label>
                        <select class="form-control" id="slot_reservasi" name="slot_reservasi" required></select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
