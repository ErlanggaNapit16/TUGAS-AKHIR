<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Daftar Ruang Pikiran</title>
    <link rel="stylesheet" href="{{ asset('css/Register.css') }}">
    <script src="{{ asset('js/Register.js') }}" defer></script>


</head>

<body>
    <div class="wrapper">
        <form action="{{ route('registrasi.submit') }}" method="POST">
            @csrf
            <h2>Daftar</h2>

            <div class="input-field">
                <input type="text" name="name" required>
                <label>Nama Lengkap</label>
            </div>
            <div class="input-field">
                <input type="tel" name="phone" id="phone" required inputmode="numeric" pattern="[0-9]{10,15}" maxlength="15">
                <label>No Handphone</label>
                <small id="phone-alert" style="color: red; display: none;">Masukkan Nomor WhatsApp yang aktif</small>
            </div>



            <div class="input-field">
                <input type="number" name="age" id="age" class="form-control" required min="1" max="100" inputmode="numeric" pattern="[0-9]*">
                <label for="age">Umur</label>
                <small id="age-alert" style="color: red; display: none;">Masukkan umur yang valid.</small>
            </div>

            <div class="input-field">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>

            <div class="input-field">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>

            <button type="submit">Daftar</button>
            <br>

            <!-- <div class="or-separator">
                <p>Atau</p>
            </div>
            <br> -->

            <!-- <a href="/auth-google-redirect" class="google-button">
                <img src="{{ asset('images/google.png') }}" alt="Google"> Masuk dengan Google
            </a> -->

            <div class="register">
                <p>Sudah Memiliki Akun? <a href="{{ url('/auth/login') }}">Masuk</a></p>
            </div>
        </form>
    </div>
</body>

</html>