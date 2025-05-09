<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Schedule;
use App\Models\RescheduleOption;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function indexUser()
    {
        $konselors = User::where('role', 'konselor')->get();
        $schedules = Schedule::where('user_id', auth()->id())->with('rescheduleOptions', 'konselor')->get();
        return view('jadwal_user', compact('konselors', 'schedules'));
    }

    public function indexKonselor()
    {
        $schedules = Schedule::where('konselor_id', auth()->id())->with('user')->get();
        return view('Konselor.jadwal_konselor', compact('schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'konselor_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        Schedule::create([
            'user_id' => auth()->id(),
            'konselor_id' => $request->konselor_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'requested'
        ]);

        return back()->with('success', 'Jadwal berhasil diajukan!');
    }

    public function approve($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->update(['status' => 'approved']);
        return back()->with('success', 'Jadwal disetujui');
    }
    public function reschedule($id)
    {
        $schedule = Schedule::findOrFail($id);
        // Jangan ubah status di sini!
        return redirect()->route('jadwal.rescheduleForm', ['id' => $id]);
    }

    public function showRescheduleForm($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('Konselor.reschedule_form', compact('schedule'));
    }

    public function sendRescheduleOptions(Request $request, $id)
{
    $request->validate([
        'options' => 'required|array|min:4',
        'options.*.date' => 'required|date',
        'options.*.time' => 'required|date_format:H:i',
    ]);

    $schedule = Schedule::findOrFail($id);
    $schedule->rescheduleOptions()->delete(); // Clear previous options

    foreach ($request->options as $option) {
        RescheduleOption::create([
            'schedule_id' => $schedule->id,
            'date' => $option['date'],
            'time' => $option['time'],
        ]);
    }

    // ⬅ Baru di sini ubah status ke "reschedule"
    $schedule->update(['status' => 'reschedule']);

    return redirect()->route('jadwal.konselor')->with('success', 'Opsi jadwal berhasil dikirim');
}


    public function showRescheduleOptions($id)
    {
        $schedule = Schedule::with('rescheduleOptions')->findOrFail($id);
        return view('reschedule-options', compact('schedule'));
    }

    public function chooseRescheduleOption(Request $request, $id)
    {
        $request->validate([
            'option_id' => 'required|exists:reschedule_options,id',
        ]);
    
        $schedule = Schedule::findOrFail($id);
        $option = RescheduleOption::findOrFail($request->option_id);
    
        // Update jadwal berdasarkan opsi yang dipilih
        $schedule->update([
            'date' => $option->date,
            'time' => $option->time,
            'status' => 'approved',
        ]);
    
        // Hapus semua opsi reschedule terkait jadwal ini
        RescheduleOption::where('schedule_id', $schedule->id)->delete();
    
        return redirect()->route('jadwal.user')->with('success', 'Jadwal berhasil dipilih dan disetujui!');
    }
    
    public function reject(Request $request, $id)
{
    $request->validate([
        'rejection_reason' => 'required|string|max:1000',
    ]);

    $schedule = Schedule::findOrFail($id);
    $schedule->update([
        'status' => 'rejected',
        'rejection_reason' => $request->rejection_reason,
    ]);

    $schedule->status = 'rejected';
$schedule->rejection_reason = $request->input('rejection_reason'); // atau sesuai input field
$schedule->save();

    return back()->with('success', 'Jadwal ditolak dengan alasan yang diberikan.');
}
}
