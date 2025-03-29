<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota Tim</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <main id="main" class="main p-4">
        <div class="pagetitle">
            <h1>Edit Anggota Tim</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.about_us_admin') }}">About Us</a></li>
                    <li class="breadcrumb-item active">Edit Anggota</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="card p-4 shadow">
                <div class="card-body">
                    <h5 class="card-title">Form Edit Anggota Tim</h5>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('admin.team_members_update', $member->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama:</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $member->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="position" class="form-label">Posisi:</label>
                            <input type="text" name="position" class="form-control" value="{{ old('position', $member->position) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi:</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $member->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Foto:</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        @if ($member->image)
                            <div class="mb-3">
                                <label class="form-label">Foto Saat Ini:</label>
                                <br>
                                <img src="{{ asset($member->image) }}" class="img-fluid rounded" width="150">
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('admin.about_us_admin') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
