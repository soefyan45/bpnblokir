<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Daftar &mdash; Akun</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
<body style="background: #003e69">
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="assets/img/logo.png" alt="logo" width="150" class="">
                    </div>
                    <div class="card card-warning">
                        <div class="card-header"><h4>Daftar Akun</h4></div>
                        <div class="card-body">
                            <form method="POST" action="{{route('register')}}" class="needs-validation" novalidate="">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" name="name" value="{{ old('name') }}" tabindex="1" required autofocus autocomplete="name">
                                    {{-- <div class="invalid-feedback">
                                    Masukan nama lengkap anda
                                    </div> --}}
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="fullname">No Whatsapp</label>
                                    <input id="nowa" type="text" class="form-control @error('nowa') is-invalid @enderror" name="nowa" name="nowa" value="{{ old('nowa') }}" tabindex="1" required autofocus autocomplete="nowa">
                                    @error('nowa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" name="email" value="{{ old('email') }}" tabindex="1" required autofocus autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="password" class="control-label">Sandi</label>
                                    </div>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" tabindex="2" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="password-confirmation" class="control-label">Konfirmasi Sandi</label>
                                    </div>
                                    <input id="password-confirmation" type="password" class="form-control" @error('password_confirmation') is-invalid @enderror" name="password_confirmation" tabindex="2" required autocomplete="new-password">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mt-5 text-muted text-center text-warning">
                    Sudah punya akun ? <a href="/login">Akses Aplikasi</a>
                    </div>
                    <div class="simple-footer">
                    Copyright &copy; BPN Kab.Kampar 2022
                    </div>
                </div>
                </div>
            </div>
        </section>
    </div>
    <!-- General JS Scripts -->
    <script src="assets/modules/jquery.min.js"></script>
    <script src="assets/modules/popper.js"></script>
    <script src="assets/modules/tooltip.js"></script>
    <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="assets/modules/moment.min.js"></script>
    <script src="assets/js/stisla.js"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
