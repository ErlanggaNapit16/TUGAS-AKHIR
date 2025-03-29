<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    // Menampilkan daftar feedback (Hanya untuk Konselor)
    public function index()
{
    $feedbacks = Feedback::with('user')->latest()->paginate(10); // Menampilkan 10 feedback per halaman
    // Mengambil feedback beserta user
    return view('konselor.feedback_konselor', compact('feedbacks'));
}

    // Menyimpan feedback baru (Hanya untuk User yang login)
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|min:5',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Feedback berhasil dikirim.');
    }

       // Menghapus feedback (User hanya bisa hapus miliknya, Konselor bisa hapus semua)
       public function destroy(Feedback $feedback)
       {
           $user = Auth::user();
   
           // Konselor bisa menghapus semua feedback
           if ($user->role === 'konselor') {
               $feedback->delete();
               return redirect()->back()->with('success', 'Feedback berhasil dihapus oleh Konselor.');
           }
   
           // User hanya bisa menghapus feedback miliknya sendiri
           if ($user->id === $feedback->user_id) {
               $feedback->delete();
               return redirect()->back()->with('success', 'Feedback Anda berhasil dihapus.');
           }
   
           return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus feedback ini.');
       }
    public function userFeedback()
    {
        $feedbacks = Feedback::with('user')->latest()->paginate(5);
        return view('feedback_user', compact('feedbacks'));
        
    }
    
}

