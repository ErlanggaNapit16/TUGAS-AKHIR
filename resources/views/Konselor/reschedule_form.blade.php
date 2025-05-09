<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reschedule Jadwal</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            font-size: 22px;
            color: #333;
            margin-bottom: 25px;
            text-align: center;
        }

        .option-block {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f1f1f1;
            transition: background-color 0.2s ease;
        }

        .option-block:hover {
            background-color: #e9ecef;
        }

        .form-group {
            flex: 1;
            min-width: 150px;
            margin-bottom: 15px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            background-color: #fff;
            cursor: pointer;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-back {
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 6px;
            display: flex;
            /* Menggunakan flexbox untuk penataan */
            align-items: center;
            /* Menjajarkan teks secara vertikal */
            justify-content: center;
            /* Menjajarkan teks secara horizontal */
            width: auto;
            /* Biarkan lebar tombol mengikuti panjang teks */
        }

        .btn-back:hover {
            background-color: #0056b3;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #333;
        }

        input[type="date"],
        input[type="time"] {
            appearance: none;
            -webkit-appearance: none;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .row {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                margin-top: 10px;
            }

            .button-group {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h3>Beri 4 Opsi Jadwal Baru</h3>

        <form method="POST" action="{{ route('jadwal.sendRescheduleOptions', $schedule->id) }}">
            @csrf
            @for($i = 0; $i < 4; $i++)
                <div class="option-block" onclick="this.querySelector('input').focus()">
                <h5>Opsi Jadwal {{ $i + 1 }}</h5>
                <div class="row">
                    <div class="form-group">
                        <label for="date_{{ $i }}">Tanggal</label>
                        <input type="date" id="date_{{ $i }}" name="options[{{ $i }}][date]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="time_{{ $i }}">Waktu</label>
                        <input type="time" id="time_{{ $i }}" name="options[{{ $i }}][time]" class="form-control" required>
                    </div>
                </div>
    </div>
    @endfor

    <!-- Tombol Kembali dan Kirim Opsi Jadwal -->
    <div class="button-group">
        <button type="submit" class="btn btn-success">Kirim Opsi Jadwal</button>
        <a href="{{ route('jadwal.konselor') }}" class="btn-back">Batal</a>

    </div>
    </form>
    </div>

</body>

</html>