<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = User::where('role', 'customer')->count();
        $jumlahKonselor = User::where('role', 'konselor')->count(); // Sesuaikan field 'role' jika berbeda
        return view('admin.dashboard_admin', compact('totalCustomers', 'jumlahKonselor'));

    }
}
