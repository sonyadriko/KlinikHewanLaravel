<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.ico') }}" />
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
</head>

<body>
    <div id="preloader"><i>.</i><i>.</i><i>.</i></div>

    <div id="main-wrapper">
        <div class="authincation section-padding">
            <div class="container h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-xl-5 col-md-6">
                        <div class="mini-logo text-center my-4">
                            <img src="{{ asset('assets/images/logo.jpg') }}" alt="Logo" width="100"
                                height="100" />
                            <h4 class="card-title mt-5">Masuk ke Klinik Hewan</h4>
                        </div>
                        <div class="auth-form card">
                            <div class="card-body">
                                <!-- Login Form -->
                                <form id="loginForm" class="signin_validate row g-3" method="POST">
                                    @csrf
                                    <div class="col-12">
                                        <input type="email" class="form-control" placeholder="Masukkan alamat email"
                                            name="email" id="email" required autofocus />
                                    </div>
                                    <div class="col-12">
                                        <input type="password" class="form-control" placeholder="Kata Sandi"
                                            name="password" id="password" required />
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            Sign in
                                        </button>
                                    </div>
                                </form>
                                <p class="mt-3 mb-0">
                                    Tidak memiliki akun?
                                    <a class="text-primary" href="{{ route('register') }}">Daftar</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        async function handleSubmit(event) {
            event.preventDefault();
            const form = document.getElementById('loginForm');
            const formData = new FormData(form);

            try {
                const response = await fetch('{{ route('login.process') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token')
                    }
                });

                const jsonData = await response.json();
                if (jsonData.success) {
                    Swal.fire({
                        title: 'Login Berhasil',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = jsonData.redirect_url;
                        console.log(jsonData.redirect_url);
                    });
                } else {
                    Swal.fire({
                        title: 'Login Gagal',
                        text: jsonData.message,
                        icon: 'error'
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Terjadi Kesalahan',
                    text: 'Tidak dapat menghubungi server. Coba lagi nanti.',
                    icon: 'error'
                });
            }
        }

        document.getElementById('loginForm').addEventListener('submit', handleSubmit);
    </script>
</body>

</html>
