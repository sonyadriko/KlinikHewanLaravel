@extends('layouts.master')

@section('title', 'Layanan Kami')

@section('content')
    <div class="services section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section-title text-center">
                        <h2>Layanan Kami</h2>
                        <p>Kami menyediakan berbagai layanan terbaik untuk hewan peliharaan Anda, memastikan mereka
                            tetap sehat dan bahagia.</p>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <!-- Pemeriksaan -->
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="service-box">
                        <img src="../assets/images/service/service1.jpg" class="img-fluid" alt="Pemeriksaan">
                        <h3>Pemeriksaan</h3>
                        <p>Kami menyediakan pemeriksaan kesehatan lengkap dengan dokter hewan profesional untuk
                            hewan peliharaan Anda.</p>
                    </div>
                </div>

                <!-- Grooming -->
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="service-box">
                        <img src="../assets/images/service/service2.jpg" class="img-fluid" alt="Grooming">
                        <h3>Grooming</h3>
                        <p>Layanan grooming kami memastikan hewan peliharaan Anda tetap bersih, sehat, dan tampil
                            menawan.</p>
                    </div>
                </div>

                <!-- Pet Hotel -->
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="service-box">
                        <img src="../assets/images/service/service3.jpg" class="img-fluid" alt="Pet Hotel">
                        <h3>Pet Hotel</h3>
                        <p>Pet hotel kami menyediakan tempat menginap yang nyaman dan aman saat Anda bepergian.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
