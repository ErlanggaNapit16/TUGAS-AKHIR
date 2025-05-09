<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Konten Mengelola Depresi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: scale(1.01);
        }

        .card-body {
            padding: 25px;
        }

        .card-body h4 {
            color: #34495e;
            margin-bottom: 10px;
        }

        .card-body p {
            color: #555;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        iframe {
            width: 100%;
            height: 315px;
            border: none;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .btn-success {
            background-color: #27ae60;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
            margin-top: 15px;
            display: block;
            width: fit-content;
            margin: 20px auto;
        }

        .btn-success:hover {
            background-color: #219150;
        }

        .disabled-card {
            opacity: 0.5;
            pointer-events: none;
        }

        .btn-homepage {
            display: block;
            width: fit-content;
            margin: 20px auto;
            text-decoration: none;
            background-color: #3498db;
            color: #fff;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .btn-homepage:hover {
            background-color: #2980b9;
        }

        .btn-reset {
            background-color: #f39c12;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .btn-reset:hover {
            background-color: #e67e22;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Konten untuk Mengelola Depresi</h2>

        @php $allowAccess = true; @endphp
        @foreach($tasks as $task)
        @php $selesai = $progressData[$task->id] ?? false; @endphp

        <div class="card {{ $allowAccess ? '' : 'disabled-card' }}">
            <div class="card-body">
                <h4>{{ $task->judul }}</h4>
                <p>{{ $task->deskripsi }}</p>

                @if ($allowAccess)
                <iframe src="{{ str_replace('watch?v=', 'embed/', $task->link) }}" allowfullscreen></iframe>

                @if ($selesai)
                <p style="color: green; font-weight: bold;">✅ Sudah Selesai</p>
                @else
                <form action="{{ route('progress.depresi.complete', ['taskId' => $task->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-success">✓ Tandai Selesai</button>
                </form>
                @endif
                @else
                <p><em>🔒 Silakan selesaikan task sebelumnya untuk membuka task ini.</em></p>
                @endif
            </div>
        </div>

        @php if (!$selesai) $allowAccess = false; @endphp
        @endforeach

        @php
        $allTasksCompleted = collect($tasks)->every(function($task) use ($progressData) {
        return $progressData[$task->id] ?? false;
        });
        @endphp

        @if ($allTasksCompleted)
        <div style="text-align: center;">
            <a href="{{ route('homepage') }}" class="btn-homepage">← Kembali ke Homepage</a>
            <form action="{{ route('task_depresi.reset') }}" method="POST" style="display:inline-block;">
                @csrf
                <button type="submit" class="btn-reset" onclick="return confirm('Apakah kamu yakin ingin mengulang semua task depresi?')">
                    🔄 Mulai Ulang Task Depresi
                </button>
            </form>
        </div>
        @else
        <a href="#" class="btn-homepage" style="background-color: #bdc3c7; cursor: not-allowed; pointer-events: none;">← Kembali ke Homepage</a>
        @endif
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if ($allTasksCompleted)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: '🎉 Selamat!',
            text: 'Kamu telah menyelesaikan semua task mengelola depresi. Kamu luar biasa!',
            icon: 'success',
            confirmButtonText: 'Selesai',
            backdrop: `
                rgba(0,0,123,0.4)
                url("https://media.giphy.com/media/111ebonMs90YLu/giphy.gif")
                left top
                no-repeat
            `
        });
    });
</script>
@endif

</html>