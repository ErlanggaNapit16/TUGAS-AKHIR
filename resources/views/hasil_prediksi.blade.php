<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Analisis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7fa;
            color: #333;
        }

        .container {
            margin-top: 50px;
            max-width: 900px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h2 {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        .card {
            margin-bottom: 30px;
        }

        h4 {
            font-size: 1.5rem;
            color: #34495e;
            margin-top: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #ddd;
        }

        .hasil {
            font-size: 1.25rem;
            font-weight: 600;
            margin-top: 10px;
        }

        .hasil.text-success {
            color: #27ae60;
        }

        .hasil.text-warning {
            color: #f39c12;
        }

        .hasil.text-danger {
            color: #e74c3c;
        }

        p {
            font-size: 1.1rem;
            color: #7f8c8d;
        }

        .btn-primary {
            display: inline-block;
            margin-top: 30px;
            font-size: 1.1rem;
            padding: 12px 25px;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover {
            background-color: #2980b9;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .btn-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .alert {
            font-size: 1.1rem;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .alert-success {
            background-color: #2ecc71;
            color: white;
        }

        .alert-warning {
            background-color: #f39c12;
            color: white;
        }

        .alert-danger {
            background-color: #e74c3c;
            color: white;
        }

        .section-divider {
            margin: 40px 0;
            height: 2px;
            background-color: #ddd;
            border: none;
        }
    </style>

</head>

<body>
    <div class="container">
        <h2>Hasil Analisis Gejala</h2>

        <!-- Bagian Hasil Kecemasan -->
        <div class="card">
            <div class="card-body">
                <h4>Gejala Kecemasan</h4>
                @if($hasil_cemas == 'Tidak Cemas')
                <p class="hasil text-success">Tidak Cemas</p>
                <p>Gejala Anda tidak menunjukkan kecemasan.</p>
                @elseif($hasil_cemas == 'Cenderung Cemas')
                <p class="hasil text-warning">Cenderung Cemas</p>
                <p>Anda menunjukkan gejala kecemasan. Perhatikan kesehatan mental Anda.</p>
                @else
                <p class="hasil text-danger">Hasil Kecemasan Tidak Tersedia</p>
                @endif
            </div>
        </div>

        <!-- Bagian Hasil Depresi -->
        <div class="card">
            <div class="card-body">
                <h4>Gejala Depresi</h4>
                @if($hasil_depresi == 'Tidak depresi')
                <p class="hasil text-success">Tidak Depresi</p>
                <p>Gejala Anda tidak menunjukkan depresi.</p>
                @elseif($hasil_depresi == 'Cenderung depresi')
                <p class="hasil text-danger">Cenderung Depresi</p>
                <p>Gejala Anda menunjukkan tanda-tanda depresi. Sebaiknya konsultasikan ke profesional.</p>
                @else
                <p class="hasil text-danger">Hasil Depresi Tidak Tersedia</p>
                @endif
            </div>
        </div>

        <!-- Kondisi untuk menampilkan button sesuai hasil analisis -->
        <div class="section-divider"></div>

        <h4>Masih merasa tidak puas? Coba analisis ulang atau ambil tindakan lainnya:</h4>

        <!-- Button Grup -->
        <div class="btn-group">
            @if($hasil_cemas == 'Tidak Cemas' && $hasil_depresi == 'Tidak depresi')
            <!-- Jika Tidak Cemas dan Tidak Depresi -->
            <a href="{{ route('homepage') }}" class="btn btn-primary">Kembali Ke Halaman Utama</a>
            <a href="{{ route('analisis.form') }}" class="btn btn-primary">Analisis Ulang</a>
            <a href="{{ route('jadwal.user') }}" class="btn btn-primary">Buat Jadwal dengan Konselor</a>
            <a href="{{ route('pembelajaran_user') }}" class="btn btn-primary">Ke Halaman Pembelajaran</a>
            @elseif($hasil_cemas == 'Tidak Cemas' && $hasil_depresi == 'Cenderung depresi')
            <!-- Jika Tidak Cemas dan Cenderung Depresi -->
            <a href="{{ route('homepage') }}" class="btn btn-primary">Kembali Ke Halaman Utama</a>
            <a href="{{ route('analisis.form') }}" class="btn btn-primary">Analisis Ulang</a>
            <a href="{{ route('jadwal.user') }}" class="btn btn-primary">Buat Jadwal dengan Konselor</a>
            </a>
            <a href="{{ route('user_depresi') }}" class="btn btn-primary">
                Atasi Depresi Mu
            </a> @elseif($hasil_cemas == 'Cenderung Cemas' && $hasil_depresi == 'Tidak depresi')
            <!-- Jika Cenderung Cemas dan Tidak Depresi -->
            <a href="{{ route('homepage') }}" class="btn btn-primary">Kembali Ke Halaman Utama</a>
            <a href="{{ route('analisis.form') }}" class="btn btn-primary">Analisis Ulang</a>
            <a href="{{ route('jadwal.user') }}" class="btn btn-primary">Buat Jadwal dengan Konselor</a>
            <a href="{{ route('user_cemas') }}" class="btn btn-primary">Atasi Cemas Mu</a>
            @elseif($hasil_cemas == 'Cenderung Cemas' && $hasil_depresi == 'Cenderung depresi')
            <!-- Jika Cenderung Cemas dan Cenderung Depresi -->
            <a href="{{ route('homepage') }}" class="btn btn-primary">Kembali Ke Halaman Utama</a>
            <a href="{{ route('analisis.form') }}" class="btn btn-primary">Analisis Ulang</a>
            <a href="{{ route('jadwal.user') }}" class="btn btn-primary">Buat Jadwal dengan Konselor</a>
            <a href="{{ route('user_berat') }}" class="btn btn-primary">
                Atasi Masalah Cemas Dan Depresi Mu
            </a> @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>