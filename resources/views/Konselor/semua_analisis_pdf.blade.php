<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Hasil Analisis</title>

    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px; /* Menyesuaikan ukuran font untuk landscape */
        }

        h1 {
            font-size: 2rem;
            font-weight: 600;
            text-align: center;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Button Styling */
        .btn-custom {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            border-radius: 0.375rem;
            text-decoration: none;
            font-size: 1rem;
            margin-bottom: 1rem;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #45a049;
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        th, td {
            padding: 10px 20px;
            text-align: left;
            font-size: 1rem;
            color: #555;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        td {
            border-top: 1px solid #ddd;
        }

        td strong {
            color: #333;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }

            th, td {
                padding: 8px;
            }

            .container {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Heading -->
        <h1>Semua Hasil Analisis Psikologis</h1>

        <!-- Button Kembali and Download -->
        @if(!isset($isPdf) || !$isPdf)
        <div class="text-center">
            <a href="{{ route('konselor.dashboard') }}" class="btn-custom">
                Kembali
            </a>
        </div>
        @endif

        @if(!isset($isPdf) || !$isPdf)
        <div class="text-center mt-4">
            <a href="{{ route('konselor.downloadSemuaAnalisisPdf') }}" class="btn-custom">
                Download Semua Analisis (PDF)
            </a>
        </div>
        @endif

        <!-- Table -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Age</th>
                    <th>Hasil Analisis</th>
                    <th>Tanggal Analisis</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prediksiPsikologisList as $index => $prediksi)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $prediksi->user->name }}</td>
                        <td>{{ $prediksi->user->email }}</td>
                        <td>{{ $prediksi->user->phone }}</td>
                        <td>{{ $prediksi->user->age }}</td>
                        <td>
                            <strong>Cemas:</strong> {{ json_decode($prediksi->hasil_prediksi, true)['cemas'] ?? '-' }} <br>
                            <strong>Depresi:</strong> {{ json_decode($prediksi->hasil_prediksi, true)['depresi'] ?? '-' }}
                        </td>
                        <td>{{ $prediksi->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
