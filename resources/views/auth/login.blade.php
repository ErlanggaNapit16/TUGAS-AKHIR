<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login Ruang Pikiran</title>
    <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
</head>

<body>
    <div class="wrapper">
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf   
            <h2>Login</h2>

            {{-- Menampilkan pesan error jika login gagal --}}
            @if(session('gagal'))
                <div class="alert alert-danger">
                    <p>{{ session('gagal') }}</p>
                </div>
            @endif

            {{-- Input Email --}}
            <div class="input-field">
                <input type="email" name="email" required autofocus>
                <label>Email</label>
            </div>

            {{-- Input Password --}}
            <div class="input-field">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>

            <div class="forget">
                <a href="#">Lupa Password?</a>
            </div>

            {{-- Tombol Login --}}
            <button type="submit">Masuk</button>
            <br>

            {{-- Pemisah --}}
            <div class="or-separator">
                <p>Atau</p>
            </div>
            <br>

            {{-- Login dengan Google --}}
            <a href="/auth-google-redirect" class="google-button">
                <img src="{{ asset('images/google.png') }}" alt="Google"> Masuk dengan Google
            </a>

            <div class="register">
                <p>Belum memiliki akun? <a href="{{ route('registrasi.tampil') }}">Daftar</a></p>
            </div>
        </form>
    </div>
</body>

</html>
