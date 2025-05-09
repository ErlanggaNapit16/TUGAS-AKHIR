<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PrediksiPsikologis;  // Pastikan model PrediksiPsikologis di-import
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // perbaiki import PDF
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Models\TaskCemas;
use App\Models\Progress;




class DashboardKonselorController extends Controller
{
   public function index()
{
    // Ambil semua user yang memiliki prediksi psikologis
    $users = User::whereHas('prediksiPsikologis') // hanya user yang punya prediksi
        ->with('prediksiPsikologis') // eager loading supaya lebih cepat
        ->get();
    
        
    // Ambil data progres user
    $userProgress = $this->tampilkanProgresUser(); // Sesuaikan dengan metode yang Anda gunakan
    
    // Kirim data ke view
    return view('Konselor.dashboardkonselor', compact('users', 'userProgress'));
}

    


    // Fungsi untuk menampilkan data lengkap berdasarkan user
    public function dataLengkap($id)
    {
        // Ambil semua data prediksi psikologis berdasarkan user
        $prediksiPsikologisList = PrediksiPsikologis::where('user_id', $id)->get();
        $user = User::find($id);
    
        if (!$user) {
            return redirect()->route('konselor.dashboard')->with('error', 'User tidak ditemukan');
        }
    
        // Ambil prediksi psikologis terbaru untuk user
        $prediksiPsikologis = $user->prediksiPsikologis()->latest()->first();
    
        if (!$prediksiPsikologis) {
            return redirect()->route('konselor.dashboard')->with('error', 'Data prediksi tidak ditemukan');
        }
    
        // Pastikan hasil_prediksi ada dan valid (seharusnya dalam bentuk JSON)
        $hasilPrediksi = json_decode($prediksiPsikologis->hasil_prediksi, true);
    
        if (is_null($hasilPrediksi)) {
            return redirect()->route('konselor.dashboard')->with('error', 'Data prediksi tidak valid');
        }
    
        // Pastikan untuk mengirimkan $prediksiPsikologisList ke view
        return view('Konselor.data_lengkap', compact('user', 'prediksiPsikologis', 'hasilPrediksi', 'prediksiPsikologisList'));
    }



    public function downloadPdf($userId)
    {
        $user = User::findOrFail($userId);
        $prediksiPsikologisList = PrediksiPsikologis::where('user_id', $userId)->get();
    
        $pdf = PDF::loadView('Konselor.data_lengkap', [
            'user' => $user,
            'prediksiPsikologisList' => $prediksiPsikologisList,
            'isPdf' => true,
        ]);
        return $pdf->download('data-prediksi-'.$user->name.'.pdf');
    }

          // Fungsi untuk menampilkan halaman semua analisis
    public function semuaAnalisis()
    {
        // Ambil semua prediksi psikologis dengan relasi user
        $prediksiPsikologisList = PrediksiPsikologis::with('user')->get();
        
        return view('Konselor.semua_analisis_pdf', compact('prediksiPsikologisList'));
    }

    public function downloadSemuaAnalisisPdf()
{
    // Ambil semua prediksi psikologis dengan relasi user
    $prediksiPsikologisList = PrediksiPsikologis::with('user')->get();

    // Generate PDF dengan orientasi landscape
    $pdf = Pdf::loadView('Konselor.semua_analisis_pdf', [
        'prediksiPsikologisList' => $prediksiPsikologisList,
        'isPdf' => true,  // Flag untuk menunjukkan ini adalah PDF
    ])
    ->setOption('orientation', 'landscape') // Set orientation to landscape
    ->setOption('no-outline', true) // Menonaktifkan outline pada PDF
    ->setPaper('a4', 'landscape'); // Gunakan kertas A4 dengan orientasi landscape

    // Download PDF dengan nama yang sesuai
    return $pdf->download('semua_analisis_psikologis.pdf');
}

public function tampilkanProgresUser()
{
    $users = User::whereHas('prediksiPsikologis') // Memastikan hanya user yang sudah memiliki prediksi psikologis
        ->where('role', 'customer')
        ->get();

    $totalTasks = TaskCemas::count();

    $userProgress = [];

    foreach ($users as $user) {
        $completedTasks = Progress::where('user_id', $user->id)->where('is_completed', true)->count();
        $percentage = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        // Ambil prediksi psikologis terbaru untuk user
        $prediksiPsikologis = $user->prediksiPsikologis()->latest()->first();

        // Ambil hasil prediksi jika ada
        $hasilPrediksi = $prediksiPsikologis ? json_decode($prediksiPsikologis->hasil_prediksi, true) : null;

        $userProgress[] = [
            'name' => $user->name,
            'age' => $user->age,
            'phone' => $user->phone,
            'email' => $user->email,
            'progress' => "$completedTasks dari $totalTasks",
            'start_date' => $user->created_at->format('Y-m-d'),
            'percentage' => $percentage . '%',
            'hasil_prediksi' => $hasilPrediksi ? implode(', ', $hasilPrediksi) : 'Tidak Ada Prediksi',  // Ambil hasil prediksi
        ];
    }

    return $userProgress;
}


    
}
