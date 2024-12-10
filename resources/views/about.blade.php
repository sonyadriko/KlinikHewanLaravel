@extends('layouts.master')

@section('title', 'Tentang Kami')

@section('content')

    <div class="about-us section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section-title text-center">
                        <h2>Tentang Kami</h2>
                        <p>
                            Klinik Hewan kami berdedikasi untuk memberikan layanan kesehatan yang komprehensif dan
                            berkualitas tinggi bagi hewan peliharaan Anda.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <img src="../assets/images/people/about-us.jpg" class="img-fluid" alt="Tentang Kami">
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="about-content">
                        <h3>Visi Kami</h3>
                        <p>
                            Menjadi klinik hewan terkemuka yang dipercaya oleh para pemilik hewan peliharaan karena
                            dedikasi kami dalam menyediakan layanan kesehatan terbaik.
                        </p>
                        <h3>Misi Kami</h3>
                        <ul>
                            <li>Menyediakan perawatan veteriner yang profesional dan penuh kasih.</li>
                            <li>Memberikan edukasi kepada pemilik hewan peliharaan tentang kesehatan dan
                                kesejahteraan
                                hewan mereka.</li>
                            <li>Melibatkan teknologi canggih dalam diagnosis dan perawatan medis hewan peliharaan.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row section-padding">
                <div class="col-xl-12">
                    <div class="team-section">
                        <h3 class="text-center">Tim Kami</h3>
                        <p class="text-center">
                            Klinik kami didukung oleh tim dokter hewan berpengalaman dan staf yang berkomitmen untuk
                            memberikan perawatan terbaik.
                        </p>
                        <div class="row justify-content-center">
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                <div class="team-member">
                                    <img src="../assets/images/people/doctor1.jpg" class="img-fluid" alt="Dr. Fajar">
                                    <h4>Dr. Fajar Santoso</h4>
                                    <p>Dokter Hewan Senior</p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                <div class="team-member">
                                    <img src="../assets/images/people/doctor2.jpg" class="img-fluid" alt="Dr. Indah">
                                    <h4>Dr. Indah Wulandari</h4>
                                    <p>Dokter Spesialis Bedah Hewan</p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                <div class="team-member">
                                    <img src="../assets/images/people/doctor3.jpg" class="img-fluid" alt="Dr. Arif">
                                    <h4>Dr. Arif Prasetyo</h4>
                                    <p>Dokter Hewan Umum</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="values section-padding bg-light">
                <div class="container">
                    <h3 class="text-center">Nilai-Nilai Kami</h3>
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <div class="value-box">
                                <span><i class="bi bi-heart"></i></span>
                                <h4>Kasih Sayang</h4>
                                <p>
                                    Kami memperlakukan setiap hewan peliharaan dengan cinta dan perhatian seperti
                                    layaknya anggota keluarga.
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <div class="value-box">
                                <span><i class="bi bi-book"></i></span>
                                <h4>Pendidikan</h4>
                                <p>
                                    Kami berkomitmen untuk mengedukasi pemilik hewan peliharaan mengenai kesehatan
                                    hewan mereka.
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <div class="value-box">
                                <span><i class="bi bi-lightbulb"></i></span>
                                <h4>Inovasi</h4>
                                <p>
                                    Kami terus menerapkan teknologi terbaru untuk memberikan perawatan yang optimal.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
