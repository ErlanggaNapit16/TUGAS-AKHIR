<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengumuman</title>

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

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            border: none;
        }

        .btn:hover {
            opacity: 0.9;
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
            <h1>Detail Pengumuman</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/konselor/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('konselor.pengumuman') }}">Pengumuman</a></li>
                    <li class="breadcrumb-item active">Detail Pengumuman</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="card">
                <h2 class="card-title">{{ $announcement->title }}</h2>
                <p class="text-muted">Diterbitkan pada: {{ $announcement->created_at->format('d M Y') }}</p>
                <hr>
                <div class="content">
                    {!! nl2br(e($announcement->content)) !!}
                </div>

                @if (!empty($announcement->link))
          <p><strong>🔗 Tautan Pengumuman:</strong> 
            <a href="{{ $announcement->link }}" target="_blank" class="text-primary">
              {{ $announcement->link }}
            </a>
          </p>
        @endif

                <a href="{{ route('konselor.pengumuman') }}" class="btn btn-secondary">Kembali ke Pengumuman</a>
            </div>
        </section>
    </main>

</body>
</html>
