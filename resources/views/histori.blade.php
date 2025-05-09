<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Histori Progres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Histori Progres</h2>

        <!-- Menampilkan persentase progres keseluruhan -->
        <div class="mb-4">
            <h4>Progres Keseluruhan</h4>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: {{ $completionPercentage }}%" aria-valuenow="{{ $completionPercentage }}" aria-valuemin="0" aria-valuemax="100">
                    {{ $completionPercentage }}%
                </div>
            </div>
        </div>

        <!-- Looping untuk menampilkan setiap task dengan progres -->
        @foreach ($tasksWithProgress as $task)
            <div class="mb-4">
                <h5>{{ $task->judul }}</h5>
                <p>Status: {{ $task->progress }}</p>

                <!-- Tombol untuk lanjut ke detail task -->
                @if ($task->progress === 'Selesai')
                    <span class="text-success">Selesai</span>
                @else
                <a href="{{ route('task.detail', ['taskId' => $task->id]) }}" class="btn btn-primary">Lanjutkan Task</a>
                @endif
            </div>
        @endforeach

        <a href="{{ route('homepage') }}" class="btn btn-secondary mt-4">Kembali ke Homepage</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
