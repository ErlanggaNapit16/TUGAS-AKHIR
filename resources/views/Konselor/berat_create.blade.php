<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Tambah Task Berat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f9f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-container {
      background-color: #ffffff;
      max-width: 700px;
      margin: 50px auto;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #1e3d59;
      margin-bottom: 30px;
    }

    label {
      font-weight: 600;
      color: #34495e;
    }

    .btn-primary {
      background-color: #1abc9c;
      border-color: #1abc9c;
    }

    .btn-primary:hover {
      background-color: #16a085;
      border-color: #16a085;
    }

    .btn-secondary {
      margin-left: 10px;
    }

    .alert-danger {
      border-left: 5px solid #e74c3c;
      border-radius: 8px;
    }
  </style>
</head>

<body>

  <div class="form-container">
    <h2>Tambah Task Berat</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form action="{{ route('konselor.task_berat.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required>
      </div>

      <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi') }}</textarea>
      </div>

      <div class="mb-4">
        <label for="link" class="form-label">Link Video (YouTube)</label>
        <input type="url" name="link" id="link" class="form-control" value="{{ old('link') }}" required
          oninput="validateYouTubeLink(this)">
        <div id="link-error" class="text-danger mt-1" style="display:none;">Masukkan link YouTube yang valid.</div>
      </div>

      <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('konselor.task_berat.index') }}" class="btn btn-secondary">Batal</a>
      </div>
    </form>
  </div>
</body>

<script>
  function validateYouTubeLink(input) {
    const value = input.value;
    const errorEl = document.getElementById('link-error');
    const isYouTube = /^(https?\:\/\/)?(www\.youtube\.com|youtu\.be)\/.+$/.test(value);
    if (!isYouTube) {
      errorEl.style.display = 'block';
      input.setCustomValidity("Link harus dari YouTube");
    } else {
      errorEl.style.display = 'none';
      input.setCustomValidity("");
    }
  }
</script>

</html>
