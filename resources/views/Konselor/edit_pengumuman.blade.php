<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengumuman</title>

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
            font-size: 20px;
            margin-bottom: 15px;
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
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Pengumuman</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/konselor/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('konselor.pengumuman') }}">Pengumuman</a></li>
                    <li class="breadcrumb-item active">Edit Pengumuman</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Edit Pengumuman</h5>
                    
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    <form action="{{ route('konselor.update', $announcement->id) }}" method="POST" id="editPengumumanForm">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Pengumuman</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $announcement->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Isi Pengumuman</label>
                            <textarea class="form-control" id="content" name="content" rows="4" required>{{ old('content', $announcement->content) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="link" class="form-label">Tautan (opsional)</label>
                            <input type="url" class="form-control" id="link" name="link" value="{{ old('link', $announcement->link) }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('konselor.pengumuman') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("editPengumumanForm");

            form.addEventListener("submit", function(event) {
                let isValid = true;
                const title = document.getElementById("title");
                const content = document.getElementById("content");

                if (title.value.trim() === "") {
                    alert("Judul Pengumuman tidak boleh kosong!");
                    isValid = false;
                }

                if (content.value.trim() === "") {
                    alert("Isi Pengumuman tidak boleh kosong!");
                    isValid = false;
                }

                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>

</body>
</html>
