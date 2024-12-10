<style>
    .footer {
        background-color: #f8f9fa;
        /* Light gray background */
        padding: 40px 0;
        /* Padding for spacing */
        color: #343a40;
        /* Text color */
        border-top: 2px solid #007bff;
        /* Add a top border for emphasis */
    }

    .footer-widget {
        font-size: 1rem;
        line-height: 1.8;
    }

    .footer-widget p {
        margin-bottom: 15px;
        color: #6c757d;
        /* Muted text color */
    }

    .footer-links {
        list-style: none;
        padding: 0;
    }

    .footer-links li {
        margin-bottom: 10px;
    }

    .footer-links a {
        color: #007bff;
        text-decoration: none;
        transition: color 0.3s;
    }

    .footer-links a:hover {
        color: #0056b3;
        /* Darker shade on hover */
    }

    .footer-social a {
        font-size: 1.25rem;
        margin-right: 15px;
        color: #007bff;
        transition: color 0.3s;
    }

    .footer-social a:hover {
        color: #0056b3;
        /* Darker shade on hover */
    }

    .footer-copyright {
        text-align: center;
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 20px;
        border-top: 1px solid #dee2e6;
        padding-top: 15px;
    }
</style>

<div class="footer">
    <div class="container">
        <div class="row">
            <!-- About Section -->
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="footer-widget">
                    <h5>Tentang Kami</h5>
                    <p>
                        Berdedikasi untuk memberikan perawatan hewan terbaik untuk hewan kesayangan Anda.
                    </p>
                </div>
            </div>

            <!-- Useful Links -->
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="footer-widget">
                    <h5>Link Berguna</h5>
                    <ul class="footer-links">
                        <li><a href="{{ url('/about') }}">Tentang Kami</a></li>
                        <li><a href="{{ url('/service') }}">Layanan Kami</a></li>
                        {{-- <li><a href="{{ url('/about') }}">Kontak</a></li> --}}
                    </ul>
                </div>
            </div>

            <!-- Social Media -->
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="footer-widget">
                    <h5>Ikuti Kami</h5>
                    <div class="footer-social">
                        <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="row">
            <div class="col-12">
                <div class="footer-copyright">
                    &copy; {{ date('Y') }} Vet Pawn Print. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</div>
