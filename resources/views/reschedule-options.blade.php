<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Jadwal Reschedule</title>

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

        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        .option-card {
            display: block;
            background-color: #f1f1f1;
            border: 2px solid transparent;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: border-color 0.3s, background-color 0.3s;
        }

        .option-card:hover {
            background-color: #e9ecef;
        }

        input[type="radio"] {
            display: none;
        }

        input[type="radio"]:checked + .option-card {
            border-color: #007bff;
            background-color: #e7f1ff;
        }

        .btn {
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            border: none;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .btn {
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>

<main class="main">
    <div class="pagetitle">
        <h1>Pilih Jadwal Baru</h1>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Silakan pilih salah satu opsi jadwal</h5>

                <form method="POST" action="{{ route('jadwal.chooseOption', $schedule->id) }}">
                    @csrf

                    @foreach($schedule->rescheduleOptions as $option)
                        <label>
                            <input type="radio" name="option_id" value="{{ $option->id }}" required>
                            <div class="option-card">
                                {{ \Carbon\Carbon::parse($option->date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($option->time)->format('H:i') }}
                            </div>
                        </label>
                    @endforeach

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Pilih Jadwal</button>
                        <a href="{{ route('jadwal.user') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>

            </div>
        </div>
    </section>
</main>

</body>
</html>
