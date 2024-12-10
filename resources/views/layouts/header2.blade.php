<div class="header bg-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-12">
                <div class="header-content">
                    <div class="header-left">
                        <!-- You can add the brand logo here if needed -->
                    </div>

                    <div class="header-right">
                        <div class="dark-light-toggle" onclick="themeToggle()">
                            <span class="dark"><i class="bi bi-moon"></i></span>
                            <span class="light"><i class="bi bi-brightness-high"></i></span>
                        </div>

                        <div class="profile_log dropdown">
                            <div class="user" data-toggle="dropdown">
                                @php
                                    $role = session('role');
                                    $nama = session('nama');
                                    $email = session('email');
                                @endphp

                                @if ($role == 'admin')
                                    <span class="thumb"><img src="../assets/images/profile/admin.png"
                                            alt="" /></span>
                                @elseif ($role == 'dokter')
                                    <span class="thumb"><img src="../assets/images/profile/dokter.png"
                                            alt="" /></span>
                                @elseif ($role == 'pasien')
                                    <span class="thumb"><img src="../assets/images/profile/pasien.png"
                                            alt="" /></span>
                                @endif

                                <span class="arrow"><i class="icofont-angle-down"></i></span>
                            </div>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="user-email">
                                    <div class="user">
                                        @if ($role == 'admin')
                                            <span class="thumb"><img src="../assets/images/profile/admin.png"
                                                    alt="" /></span>
                                        @elseif ($role == 'dokter')
                                            <span class="thumb"><img src="../assets/images/profile/dokter.png"
                                                    alt="" /></span>
                                        @elseif ($role == 'pasien')
                                            <span class="thumb"><img src="../assets/images/profile/pasien.png"
                                                    alt="" /></span>
                                        @endif
                                        <div class="user-info">
                                            <h5>{{ $nama }}</h5>
                                            <span>{{ $email }}</span>
                                        </div>
                                    </div>
                                </div>

                                <a href="profile.php" class="dropdown-item">
                                    <i class="bi bi-person"></i>Profile
                                </a>
                                <a href="logout.php" class="dropdown-item logout">
                                    <i class="bi bi-power"></i> Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
