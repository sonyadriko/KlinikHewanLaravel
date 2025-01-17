@extends('layouts.master2')

@section('title', 'Reservasi')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="page-title-content">
                    <p>Halaman <strong>Reservasi</strong></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Pilih Jenis Layanan</h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            @foreach (['pemeriksaan', 'grooming', 'pet_hotel'] as $serviceType)
                                <div class="col-md-4 col-sm-6 mb-4 d-flex justify-content-center">
                                    <div class="text-center">
                                        <div class="service-card">
                                            <img src="{{ asset("assets/images/{$serviceType}.webp") }}"
                                                alt="{{ ucfirst($serviceType) }}"
                                                class="img-fluid rounded mb-3 service-image">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservasiModal" onclick="setServiceType('{{ $serviceType }}')">
                                                {{ ucfirst($serviceType) }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <p class="text-dark">Cek riwayat reservasi sebelumnya:</p>
                            {{-- Uncomment jika fitur sudah tersedia --}}
                            {{-- <a href="{{ route('reservasi.history') }}" class="btn btn-info btn-user">History</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        .service-card {
            max-width: 250px;
            /* Batasi ukuran maksimal kartu */
        }

        .service-image {
            width: 100%;
            height: 200px; /* Tinggi tetap untuk semua gambar */
            object-fit: cover; /* Jaga proporsi gambar */
        }

        @media (max-width: 576px) {
            .service-card {
                max-width: 100%;
                /* Untuk layar kecil, biarkan gambar memenuhi kolom */
            }
        }
    </style>


    <!-- Modal for Reservasi -->
    @include('patient.reservation.modal')

    <!-- Skrip Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Pastikan fungsi dideklarasikan sebelum digunakan
        function fetchAvailableSlots() {
            const tanggalReservasiInput = document.getElementById('tanggal_reservasi');
            const serviceTypeInput = document.getElementById('service_type');
            const slotReservasiSelect = document.getElementById('slot_reservasi');

            const tanggal_reservasi = tanggalReservasiInput?.value;
            const service_type = serviceTypeInput?.value;

            if (tanggal_reservasi && service_type) {
                fetch('{{ route('reservasi.getAvailableSlots') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ tanggal_reservasi, service_type })
                })
                    .then(response => response.json())
                    .then(slots => {
                        slotReservasiSelect.innerHTML = ''; // Hapus slot sebelumnya
                        Object.entries(slots).forEach(([key, value]) => {
                            const option = new Option(`${key} - ${value}/4`, key);
                            slotReservasiSelect.appendChild(option);
                        });
                    })
                    .catch(() => alert('Error fetching available slots.'));
            }
        }

        // Fungsi global untuk setServiceType
        window.setServiceType = function(serviceType) {
            const serviceTypeInput = document.getElementById('service_type');
            if (serviceTypeInput) {
                serviceTypeInput.value = serviceType;
            }
        }

        // Event listener untuk memanggil fetchAvailableSlots
        document.addEventListener('DOMContentLoaded', () => {
            const tanggalReservasiInput = document.getElementById('tanggal_reservasi');
            const serviceTypeInput = document.getElementById('service_type');

            if (tanggalReservasiInput && serviceTypeInput) {
                tanggalReservasiInput.addEventListener('change', fetchAvailableSlots);
                serviceTypeInput.addEventListener('change', fetchAvailableSlots);
            }
        });
        
    </script>
@endsection
