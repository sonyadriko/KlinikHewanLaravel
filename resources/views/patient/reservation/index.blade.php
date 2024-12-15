@extends('layouts.master2')

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
                        <h4 class="card-title">Pilih Jenis Layanan</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach (['pemeriksaan', 'grooming', 'pet_hotel'] as $serviceType)
                                <div class="col-md-4 mb-4">
                                    <div class="text-center">
                                        <img src="{{ asset("assets/images/{$serviceType}.webp") }}"
                                            alt="{{ ucfirst($serviceType) }}" class="img-fluid rounded mb-3 img-equal-size">
                                        <br>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#reservasiModal"
                                            onclick="setServiceType('{{ $serviceType }}')">{{ ucfirst($serviceType) }}</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="history-button mt-4">
                            <p class="text-dark">Cek riwayat reservasi sebelumnya:</p>
                            {{-- <a href="{{ route('reservasi.history') }}" class="btn btn-info btn-user">History</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ensure the modal is ready and elements exist before adding event listeners
            const tanggalReservasiInput = document.getElementById('tanggal_reservasi');
            const serviceTypeInput = document.getElementById('service_type');
            const slotReservasiSelect = document.getElementById('slot_reservasi');

            // Check if the elements exist to avoid errors
            if (tanggalReservasiInput && serviceTypeInput && slotReservasiSelect) {
                // Add event listeners only if elements exist
                tanggalReservasiInput.addEventListener('change', fetchAvailableSlots);
                serviceTypeInput.addEventListener('change', fetchAvailableSlots);
            }

            // Function to set the service type value in the modal
            window.setServiceType = function(serviceType) {
                document.getElementById('service_type').value = serviceType;
            }

            // Function to fetch available slots based on selected date and service type
            function fetchAvailableSlots() {
                var tanggal_reservasi = tanggalReservasiInput.value;
                var service_type = serviceTypeInput.value;

                // Check if both date and service type are selected
                if (tanggal_reservasi && service_type) {
                    $.ajax({
                        url: '{{ route('reservasi.getAvailableSlots') }}',
                        type: 'POST',
                        data: {
                            tanggal_reservasi: tanggal_reservasi,
                            service_type: service_type,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            var slots = response;
                            slotReservasiSelect.innerHTML = ''; // Clear previous slots

                            // Add available slots to the dropdown
                            Object.keys(slots).forEach(function(key) {
                                var option = document.createElement('option');
                                option.value = key;
                                option.text = `${key} - ${slots[key]}/4`; // Display slot count
                                slotReservasiSelect.appendChild(option);
                            });
                        },
                        error: function() {
                            alert('Error fetching available slots.');
                        }
                    });
                }
            }
        });
    </script>

    <!-- Modal for Reservasi -->
    @include('patient.reservation.modal')
@endsection
