<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembelajaran</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .main {
            padding: 20px;
        }

        .pagetitle h1 {
            font-size: 24px;
            color: #333;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            list-style: none;
            padding: 10px 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 16px;
        }

        .breadcrumb-item {
            font-weight: 500;
            color: #6c757d;
            display: flex;
            align-items: center;
        }

        .breadcrumb-item a {
            text-decoration: none;
            color: #007bff;
            transition: color 0.3s ease-in-out;
        }

        .breadcrumb-item a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: ">";
            color: #6c757d;
            margin: 0 8px;
        }

        .breadcrumb-item.active {
            color: #495057;
            font-weight: bold;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        .card-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
        }

        .text-muted {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 15px;
        }

        .content {
            font-size: 16px;
            line-height: 1.6;
            color: #444;
        }

        .video-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .video-container video {
            width: 100%;
            max-width: 800px;
            border-radius: 8px;
        }

        .img-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .img-container img {
            width: 100%;
            max-width: 800px;
            border-radius: 8px;
        }

        .link-box {
            margin-top: 20px;
        }

        .btn {
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            text-align: center;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-outline-primary {
            background-color: transparent;
            color: #007bff;
            border: 1px solid #007bff;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            border: none;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .description {
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 15px;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .card {
                padding: 15px;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Detail Pembelajaran</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/konselor/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('konselor.pembelajaran') }}">Pembelajaran</a></li>
                    <li class="breadcrumb-item active">Detail Pembelajaran</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="card">
                <h2 class="card-title">{{ $pembelajaran->judul }}</h2>
                <p class="text-muted">Diterbitkan pada: {{ $pembelajaran->created_at->format('d M Y') }}</p>
                <hr>

                <!-- Konten Berdasarkan Tipe -->
                <div class="mb-4">
                    @if ($pembelajaran->tipe == 'video')
                    <div class="video-container">
                        <video controls>
                            <source src="{{ asset($pembelajaran->konten) }}" type="video/mp4">
                            Browser Anda tidak mendukung pemutaran video.
                        </video>
                    </div>
                    @elseif ($pembelajaran->tipe == 'gambar')
                    <div class="img-container">
                        <img src="{{ asset($pembelajaran->konten) }}" alt="Gambar Pembelajaran">
                    </div>
                    @elseif ($pembelajaran->tipe == 'artikel')
                    <div class="content">
                        {!! nl2br(e($pembelajaran->konten)) !!}
                    </div>
                    @elseif ($pembelajaran->tipe == 'link')
                    <div class="link-box">
                        <a href="{{ $pembelajaran->konten }}" class="btn btn-primary" target="_blank">🔗 Buka Link Konten</a>
                    </div>
                    @endif
                </div>

                <!-- Deskripsi Pembelajaran -->
                @if ($pembelajaran->deskripsi)
                <div class="description">
                    <h5>📝 Deskripsi Materi:</h5>
                    @php
                    $lines = explode("\n", $pembelajaran->deskripsi);
                    $inList = false;
                    @endphp
                    @foreach ($lines as $line)
                    @php $trimmed = trim($line); @endphp
                    @if (preg_match('/^[-•]/', $trimmed))
                    @if (!$inList)
                    <ul class="ms-3">
                        @php $inList = true; @endphp
                        @endif
                        <li>{{ ltrim($trimmed, '-• ') }}</li>
                        @else
                        @if ($inList)
                    </ul>
                    @php $inList = false; @endphp
                    @endif
                    <p class="mb-1">{{ $trimmed }}</p>
                    @endif
                    @endforeach
                    @if ($inList)
                    </ul>
                    @endif
                </div>
                @endif

                <!-- Tombol Kembali -->
                <div class="text-end">
                    <a href="{{ route('konselor.pembelajaran') }}" class="btn btn-outline-primary">⬅️ Kembali ke Daftar Pembelajaran</a>
                </div>
            </div>
        </section>
    </main>

</body>

</html>