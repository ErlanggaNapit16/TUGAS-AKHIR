<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Lengkap Prediksi Psikologis</title>
    <style>
        /* Styling umum */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 26px;
            color: #343a40;
            margin-bottom: 20px;
            text-align: center;
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 15px 0;
            padding: 20px;
        }

        .card-header {
            font-size: 18px;
            color: #007bff;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .card-body {
            font-size: 16px;
            color: #333;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            text-align: left;
        }

        .table th {
            background-color: #f8f9fa;
            color: #495057;
        }

        .table td {
            background-color: #ffffff;
            color: #343a40;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
            margin: 5px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Responsive */
        @media screen and (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .card {
                padding: 15px;
            }

            h1 {
                font-size: 22px;
            }
        }

        /* Hide buttons when printing or generating PDF */
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Data Lengkap Prediksi Psikologis - {{ $user->name }}</h1>

        <!-- Data Pengguna -->
        <div class="card">
            <div class="card-header">Data Pengguna</div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>No. Telepon:</strong> {{ $user->phone ?? 'Tidak Tersedia' }}</p>
                <p><strong>Umur:</strong> {{ $user->age ?? '-' }} tahun</p>
            </div>
        </div>

        <!-- Data Prediksi -->
        @foreach ($prediksiPsikologisList as $index => $prediksi)
        <div class="card">
            <div class="card-header">
                Hasil Analisis Kesehatan Mental {{ $urutan[$index] ?? 'Ke-' . ($index + 1) }}
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Hasil Prediksi (Cemas)</th>
                        <td>{{ json_decode($prediksi->hasil_prediksi)->cemas ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Hasil Prediksi (Depresi)</th>
                        <td>{{ json_decode($prediksi->hasil_prediksi)->depresi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Analisis</th>
                        <td>{{ $prediksi->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        @endforeach

        <!-- Tombol Navigasi -->
        <div class="text-center mt-4 no-print">
            @if (empty($isPdf))
            <div class="text-center mt-4 no-print">
                <a href="{{ url('/konselor/dashboard') }}" class="btn">Kembali ke Dashboard</a>
                <a href="{{ route('download.pdf', $user->id) }}" class="btn">Download PDF</a>
            </div>
            @endif

        </div>


    </div>

</body>

</html>