<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Konten Pembelajaran</title>
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

        .form-label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .mb-3 {
            margin-bottom: 15px;
        }

        .btn {
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            border: none;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
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
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Tambah Konten Pembelajaran</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/konselor/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('konselor.pembelajaran') }}">Pembelajaran</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </nav>
        </div>

        <div class="container card">
            <form action="{{ route('konselor.study.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">Link YouTube</label>
                    <input type="url" name="link" class="form-control" required placeholder="https://www.youtube.com/watch?v=xxxxxxx">
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </main>

</body>

</html>
