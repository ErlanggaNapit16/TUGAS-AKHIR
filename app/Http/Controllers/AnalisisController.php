<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\PrediksiPsikologis;
use Illuminate\Support\Facades\Auth;



class AnalisisController extends Controller
{
    public function showForm()
    {
        $pertanyaan = [
            'cemas' => [
                'Limbung, Pening atau lemas',
                'Kegelisahan atau gemetar di dalam diri',
                'Jantung berdebar kuat atau amat cepat',
                'Gemetaran',
                'Merasa tegang atau terhimpit',
                'Sakit kepala',
                'Merasa amat ketakutan atau panik',
                'Merasa resah, tidak dapat diam tenang',
            ],
            'depresi' => [
                'Merasa kurang bertenaga, melamban',
                'Mempersalahkan diri sendiri untuk bermacam-macam hal atau berbagai hal',
                'Mudah menangis',
                'Kehilangan minat atau kesenangan seksual',
                'Selera makan terganggu (berkurang)',
                'Sulit tidur atau mudah terbangun/terjaga',
                'Merasa tidak memiliki harapan mengenai masa depan',
                'Merasa kesepian',
                'Merasa sedih',
                'Berpikir untuk mengakhiri hidup Anda',
                'Merasa terperangkap atau terjebak, tidak dapat keluar dari suatu situasi',
                'Terlalu mengkhawatirkan banyak hal',
                'Merasa tidak tertarik atau tidak berminat terhadap segala hal',
                'Merasa bahwa segala sesuatu memerlukan usaha keras atau terasa berat',
                'Merasa tidak berharga',
            ]
        ];

        return view('analisis_gejala', compact('pertanyaan'));
    }

    public function predict(Request $request)
    {
        $cemas = $request->input('cemas');
        $depresi = $request->input('depresi');

        $pilihanValid = [
            'Sama sekali tidak pernah',
            'Sekali-sekali',
            'Agak sering',
            'Sering'
        ];

        if (empty($cemas) || empty($depresi)) {
            return back()->with('error', 'Semua pertanyaan wajib diisi.');
        }

        foreach (array_merge($cemas, $depresi) as $value) {
            if (!in_array($value, $pilihanValid)) {
                return back()->with('error', 'Terdapat jawaban yang tidak valid.');
            }
        }

        try {
            $mappingJawaban = [
                'Sama sekali tidak pernah' => 1,
                'Sekali-sekali' => 2,
                'Agak sering' => 3,
                'Sering' => 4
            ];

            $cemasMapped = array_map(fn($answer) => $mappingJawaban[$answer], $cemas);
            $depresiMapped = array_map(fn($answer) => $mappingJawaban[$answer], $depresi);

            $data = [
                'cemas' => $cemasMapped,
                'depresi' => $depresiMapped
            ];

            $response = Http::timeout(10)->post('http://127.0.0.1:5000/predict', $data);

            if ($response->successful()) {
                $hasil = $response->json();

                // Simpan ke database
                PrediksiPsikologis::create([
                    'user_id' => Auth::id(),
                    'gejala' => array_merge($cemasMapped, $depresiMapped),
                    'hasil_prediksi' => json_encode([
                        'cemas' => $hasil['prediksi_cemas'] ?? null,
                        'depresi' => $hasil['prediksi_depresi'] ?? null,
                    ]),
                ]);
                

                // Tambahkan log respons API
                Log::info('Data yang dikirim ke API Flask:', ['data' => $data]);
                Log::info('Response dari API Flask:', ['hasil' => $hasil]);

                return view('hasil_prediksi', [
                    'hasil_cemas' => $hasil['prediksi_cemas'] ?? null,
                    'hasil_depresi' => $hasil['prediksi_depresi'] ?? null,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Gagal memanggil API Flask: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghubungi server analisis.');
        }
    }
}
