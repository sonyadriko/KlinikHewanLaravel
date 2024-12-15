<div class="sidebar">
    <div class="brand-logo">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/images/logo.jpg') }}" alt="Logo" width="30" />
        </a>
    </div>
    <div class="menu">
        <ul>
            <li>
                <a href="{{ route('dashboard') }}" data-toggle="tooltip" data-placement="right" title="Home">
                    <span><i class="bi bi-house"></i></span><br>
                    <span>Home</span>
                </a>
            </li>

            {{-- @if (auth()->check() && auth()->user()->role == 'admin') --}}
            <li>
                <a href="{{ route('article.index') }}" data-toggle="tooltip" data-placement="right" title="Artikel">
                    <span><i class="bi bi-globe"></i></span><br>
                    <span>Artikel</span>
                </a>
            </li>

            <li>
                <a href="{{ route('akun-pasien.index') }}" data-toggle="tooltip" data-placement="right"
                    title="Akun Pasien">
                    <span><i class="bi bi-person-circle"></i></span><br>
                    <span>Akun Pemilik Hewan</span>
                </a>
            </li>
            {{-- @endif --}}



            {{-- @if (auth()->user()->role == 'admin' || auth()->user()->role == 'pasien') --}}
            <li>
                <a href="{{ route('reservasi.index') }}" data-toggle="tooltip" data-placement="right" title="Reservasi">
                    <span><i class="bi bi-calendar-check"></i></span><br>
                    <span>Reservasi</span>
                </a>
            </li>
            {{-- @endif --}}

            {{-- @if (auth()->user()->role == 'dokter') --}}
            <li>
                <a href="{{ route('rekam-medis.index') }}" data-toggle="tooltip" data-placement="right"
                    title="Pemeriksaan">
                    <span><i class="bi bi-file-earmark-medical"></i></span><br>
                    <span>Pemeriksaan</span>
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('rekam-medis-grooming.index') }}" data-toggle="tooltip" data-placement="right"
                    title="Grooming">
                    <span><i class="bi bi-file-earmark-medical"></i></span><br>
                    <span>Grooming</span>
                </a>
            </li>
            <li>
                <a href="{{ route('rekam-medis-pethotel.index') }}" data-toggle="tooltip" data-placement="right"
                    title="Pet Hotel">
                    <span><i class="bi bi-file-earmark-medical"></i></span><br>
                    <span>Pet Hotel</span>
                </a>
            </li> --}}
            {{-- @endif --}}

            {{-- @if (auth()->user()->role == 'pasien') --}}
            {{-- <li>
                <a href="{{ route('profile') }}" data-toggle="tooltip" data-placement="right" title="Profile">
                    <span><i class="bi bi-person-circle"></i></span><br>
                    <span>Profile</span>
                </a>
            </li> --}}
            {{-- @endif --}}

            {{-- @if (auth()->user()->role == 'dokter' || auth()->user()->role == 'pasien') --}}
            <li>
                <a href="{{ route('forum.index') }}" data-toggle="tooltip" data-placement="right" title="Forum Diskusi">
                    <span><i class="bi bi-chat-left-text"></i></span><br>
                    <span>Forum Diskusi</span>
                </a>
            </li>
            {{-- @endif --}}

            <li>
                <a href="{{ route('logout') }}" data-toggle="tooltip" data-placement="right" title="Signout">
                    <span><i class="bi bi-box-arrow-right"></i></span><br>
                    <span>Signout</span>
                </a>
            </li>
        </ul>
    </div>
</div>
