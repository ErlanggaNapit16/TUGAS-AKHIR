<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisis Gejala Psikologis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #e1f5fe, #f5f5f5);
            min-height: 100vh;
            padding: 60px 20px;
        }

        h1 {
            font-size: 2.4rem;
            color: #1a1a1a;
            letter-spacing: 0.5px;
            margin-bottom: 40px;
            text-align: center;
        }

        h2 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 20px;
            margin-top: 40px;
            text-align: center;
        }

        .question-box {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .question-box:hover {
            transform: scale(1.02);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 1rem;
            color: #444;
        }

        button[type="submit"],
        .btn-back {
            margin-top: 40px;
            width: 48%;
            padding: 16px;
            font-size: 1.15rem;
            font-weight: 600;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s;
        }

        button[type="submit"] {
            background: linear-gradient(135deg, #0077ff, #00c6ff);
            color: #fff;
        }

        button[type="submit"]:hover {
            background: linear-gradient(135deg, #005fd4, #00aaff);
            transform: translateY(-2px);
        }

        .btn-back {
            background: #f44336;
            color: #fff;
            text-align: center;
            line-height: normal;
            display: inline-block;
            text-decoration: none;
        }

        .btn-back:hover {
            background: #d32f2f;
            transform: translateY(-2px);
        }

        .result-box {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 12px;
            margin-top: 40px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('analisis.predict') }}" method="POST">
            @csrf
            <h1>Analisis Gejala Psikologis</h1>

            <div class="row">
                @foreach ($pertanyaan['cemas'] as $index => $item)
                    <div class="col-md-6 mb-4">
                        <div class="question-box">
                            <p class="fw-bold">{{ $item }}</p>
                            <label>
                                <input type="radio" name="cemas[{{ $index }}]" value="Sama sekali tidak pernah" required>
                                Sama sekali tidak pernah
                            </label>
                            <label>
                                <input type="radio" name="cemas[{{ $index }}]" value="Sekali-sekali">
                                Sekali-sekali
                            </label>
                            <label>
                                <input type="radio" name="cemas[{{ $index }}]" value="Agak sering">
                                Agak sering
                            </label>
                            <label>
                                <input type="radio" name="cemas[{{ $index }}]" value="Sering">
                                Sering
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Memberikan jarak antar jenis pertanyaan -->
            <div style="margin-top: 40px;"></div>

            <div class="row">
                @foreach ($pertanyaan['depresi'] as $index => $item)
                    <div class="col-md-6 mb-4">
                        <div class="question-box">
                            <p class="fw-bold">{{ $item }}</p>
                            <label>
                                <input type="radio" name="depresi[{{ $index }}]" value="Sama sekali tidak pernah" required>
                                Sama sekali tidak pernah
                            </label>
                            <label>
                                <input type="radio" name="depresi[{{ $index }}]" value="Sekali-sekali">
                                Sekali-sekali
                            </label>
                            <label>
                                <input type="radio" name="depresi[{{ $index }}]" value="Agak sering">
                                Agak sering
                            </label>
                            <label>
                                <input type="radio" name="depresi[{{ $index }}]" value="Sering">
                                Sering
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-between">
                <a href="/" class="btn btn-back">🏠 Kembali ke Homepage</a>
                <button type="submit" class="btn">🔍 Analisis Sekarang</button>
            </div>
        </form>

        @if(isset($hasil_cemas) || isset($hasil_depresi))
            <div class="result-box">
                <h3>Hasil Analisis</h3>
                <p><strong>Cemas:</strong> {{ $hasil_cemas ?? 'Tidak Teridentifikasi' }}</p>
                <p><strong>Depresi:</strong> {{ $hasil_depresi ?? 'Tidak Teridentifikasi' }}</p>

                <h4>Kesimpulan</h4>
                <p>
                    @if ($hasil_cemas == 'Cemas' || $hasil_depresi == 'Depresi')
                        Kondisi Anda memerlukan perhatian lebih lanjut. Kami sarankan Anda untuk mencari dukungan lebih lanjut.
                    @else
                        Kondisi Anda tampak sehat. Namun, jika Anda merasa tidak nyaman, pertimbangkan untuk berkonsultasi lebih lanjut.
                    @endif
                </p>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
