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
                            @php
                                $serviceLabels = [
                                    'pemeriksaan' => 'Pemeriksaan',
                                    'grooming' => 'Grooming',
                                    'pet_hotel' => 'Pet Hotel',
                                ];
                            @endphp
                            @foreach (['pemeriksaan', 'grooming', 'pet_hotel'] as $serviceType)
                                <div class="col-md-4 col-sm-6 mb-4 d-flex justify-content-center">
                                    <div class="text-center">
                                        <div class="service-card">
                                            <img src="{{ asset("assets/images/{$serviceType}.webp") }}"
                                                 alt="{{ $serviceLabels[$serviceType] }}"
                                                 class="img-fluid rounded mb-3 service-image">
                                            <button type="button" class="btn btn-primary"
                                                    data-toggle="modal"
                                                    data-target="#reservasiModal"
                                                    onclick="setServiceType('{{ $serviceType }}')">
                                                {{ $serviceLabels[$serviceType] }}
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


    <script>
        // Pastikan fungsi dideklarasikan sebelum digunakan
        function fetchAvailableSlots() {
            const tanggalReservasiInput = document.getElementById('reservation_date');
            const serviceTypeInput = document.getElementById('service_type');
            const slotReservasiSelect = document.getElementById('reservation_slot');

            const reservation_date = tanggalReservasiInput?.value;
            const service_type = serviceTypeInput?.value;

            const slotLabels = {
                "pemeriksaan_pagi": "Pemeriksaan Pagi",
                "pemeriksaan_sore": "Pemeriksaan Sore",
                "grooming_pagi": "Grooming Pagi",
                "grooming_sore": "Grooming Sore",
                "pet_hotel": "Pet Hotel"
            };

            if (reservation_date && service_type) {
                fetch('{{ route('reservasi.getAvailableSlots') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ reservation_date, service_type })
                })
                    .then(response => response.json())
                    .then(slots => {
                        slotReservasiSelect.innerHTML = ''; // Hapus slot sebelumnya
                        Object.entries(slots).forEach(([key, value]) => {
                            // Pastikan hanya slot yang sesuai dengan service_type ditampilkan
                            if ((service_type === 'pemeriksaan' && key.startsWith('pemeriksaan')) ||
                                (service_type === 'grooming' && key.startsWith('grooming')) ||
                                (service_type === 'pet_hotel' && key === 'pet_hotel')) {
                                const optionText = `${key.replace('_', ' ')} - ${value}/4`;
                                const option = new Option(optionText, key);
                                slotReservasiSelect.appendChild(option);
                            }
                        });
                    })
                    .catch(() => alert('Error fetching available slots.'));
            }
        }

        // Fungsi untuk mengatur service type
        window.setServiceType = function(serviceType) {
            const serviceTypeInput = document.getElementById('service_type');
            const serviceTypeLabel = {
                pemeriksaan: "Pemeriksaan",
                grooming: "Grooming",
                pet_hotel: "Pet Hotel",
            };

            if (serviceTypeInput) {
                // Atur value untuk dikirim ke backend
                serviceTypeInput.value = serviceType;

                // Ganti placeholder tampilan label di modal
                serviceTypeInput.setAttribute('placeholder', serviceTypeLabel[serviceType] || serviceType);

                console.log("Service type updated:", serviceType);
            } else {
                console.error("Service type input not found!");
            }
        };


        // Event listener untuk memanggil fetchAvailableSlots
        document.addEventListener('DOMContentLoaded', () => {
            const tanggalReservasiInput = document.getElementById('reservation_date');
            const serviceTypeInput = document.getElementById('service_type');

            if (tanggalReservasiInput && serviceTypeInput) {
                tanggalReservasiInput.addEventListener('change', fetchAvailableSlots);
                serviceTypeInput.addEventListener('change', fetchAvailableSlots);
            }
        });



    </script>
@endsection
@include('patient.reservation.modal')
