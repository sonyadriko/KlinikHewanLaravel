<style>
    /* Logo text styling */
    .logo-text {
        font-size: 1.75rem;
        /* Adjust size as needed */
        font-weight: bold;
        color: #007bff;
        /* Primary color for the text */
        text-transform: uppercase;
        /* Make text uppercase */
        letter-spacing: 1px;
        /* Spacing between letters */
        transition: color 0.3s ease-in-out;
        /* Smooth color transition */
    }

    .logo-text:hover {
        color: #0056b3;
        /* Darker shade on hover */
    }
</style>

<div class="header landing {{ $headerClass ?? '' }}">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="navigation">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="brand-logo">
                            <a href="{{ url('/') }}">
                                <span class="logo-text">Vet Pawn Print</span>
                            </a>
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/about') }}">Tentang Kami</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/service') }}">Layanan Kami</a>
                                </li>
                                <!-- <li class="nav-item">
                                        <a class="nav-link" href="{{ asset('assets/app.html') }}">Blog</a>
                                    </li> -->
                            </ul>
                        </div>

                        <div class="signin-btn">
                            <a class="btn btn-primary" href="{{ url('/login') }}">Sign in</a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
