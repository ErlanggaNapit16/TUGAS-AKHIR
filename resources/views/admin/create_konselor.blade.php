<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Konselor</title>
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
    .breadcrumb-item + .breadcrumb-item::before {
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
    .btn-success {
      background-color: #28a745;
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
    .alert {
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 15px;
    }
    .alert-danger {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
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
      <h1>Tambah Konselor</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.create_konselor_admin') }}">Konselor</a></li>
          <li class="breadcrumb-item active">Tambah Konselor</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Form Tambah Konselor</h5>

          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <form action="{{ route('admin.store_konselor_admin') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Nama</label>
              <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label">Telepon</label>
              <input type="text" name="phone" class="form-control">
            </div>

            <div class="mb-3">
              <label for="age" class="form-label">Umur</label>
              <input type="number" name="age" class="form-control">
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.create_konselor_admin') }}" class="btn btn-secondary">Batal</a>
          </form>
        </div>
      </div>
    </section>
  </main>
</body>
</html>
