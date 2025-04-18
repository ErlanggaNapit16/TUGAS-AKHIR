<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pembelajaran</title>

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
            <h1>Edit Pembelajaran</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/konselor/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('konselor.pembelajaran') }}">Pembelajaran</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>

        <div class="container">
            <h1>Edit Konten Pembelajaran</h1>

            <form action="{{ route('konselor.pembelajaran.update', $pembelajaran->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ $pembelajaran->judul }}" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control">{{ $pembelajaran->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="tipe">Tipe Konten</label>
                    <select name="tipe" class="form-control" required onchange="toggleInput(this.value)">
                        <option value="video" {{ $pembelajaran->tipe === 'video' ? 'selected' : '' }}>Video</option>
                        <option value="gambar" {{ $pembelajaran->tipe === 'gambar' ? 'selected' : '' }}>Gambar</option>
                        <option value="artikel" {{ $pembelajaran->tipe === 'artikel' ? 'selected' : '' }}>Artikel</option>
                        <option value="link" {{ $pembelajaran->tipe === 'link' ? 'selected' : '' }}>Link</option>
                    </select>
                </div>

                {{-- Tampilkan preview konten lama --}}
                @if(in_array($pembelajaran->tipe, ['video', 'gambar']))
                <div class="mb-3">
                    <label>Konten Lama:</label><br>
                    @if($pembelajaran->tipe === 'gambar')
                    <img src="{{ asset($pembelajaran->konten) }}" width="200" class="img-fluid">
                    @else
                    <video controls width="300">
                        <source src="{{ asset($pembelajaran->konten) }}" type="video/mp4">
                    </video>
                    @endif
                </div>
                @endif

                {{-- Input Konten --}}
                <div class="mb-3" id="konten-upload" style="display: none;">
                    <label for="konten">Konten Baru (Opsional)</label>
                    <input type="file" name="konten" class="form-control">
                </div>

                <div class="mb-3" id="konten-text" style="display: none;">
                    <label for="konten">Konten</label>
                    <input type="text" name="konten" class="form-control" value="{{ $pembelajaran->konten }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>

        <script>
            function toggleInput(tipe) {
                document.getElementById('konten-upload').style.display = (tipe === 'video' || tipe === 'gambar') ? 'block' : 'none';
                document.getElementById('konten-text').style.display = (tipe === 'artikel' || tipe === 'link') ? 'block' : 'none';
            }

            // Trigger saat halaman dibuka
            toggleInput('{{ $pembelajaran->tipe }}');
        </script>


        <script>
            function toggleInput(value) {
                const upload = document.getElementById('konten-upload');
                if (value === 'video' || value === 'gambar') {
                    upload.style.display = 'block';
                } else {
                    upload.style.display = 'none';
                }
            }

            // Menjalankan saat halaman pertama kali diload
            document.addEventListener("DOMContentLoaded", function() {
                const tipe = document.getElementById("tipe").value;
                toggleInput(tipe); 
            });
        </script>

    </main>

    <script>
        function toggleInput(tipe) {
            document.getElementById('konten-upload').style.display = (tipe === 'video' || tipe === 'gambar') ? 'block' : 'none';
            document.getElementById('konten-text').style.display = (tipe === 'artikel' || tipe === 'link') ? 'block' : 'none';
        }

        // Inisialisasi saat halaman dimuat
        window.onload = function() {
            toggleInput('{{ $pembelajaran->tipe }}');
        }
    </script>

</body>

</html>