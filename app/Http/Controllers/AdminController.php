<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Lembur;
use App\Models\User;
use App\Models\SurveyEvent;
use Carbon\Carbon;

class AdminController extends Controller
{
    // ===================== ABSENSI =====================

    public function absensiPending()
    {
        $data = Absensi::with('user')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.absensi', compact('data'));
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'jam_masuk' => 'required'
        ]);

        $absen = Absensi::findOrFail($id);

        $jamMasuk = $request->jam_masuk;

        // default aman
        $jamKerja = 0;
        $status = 'alpha';

        if ($jamMasuk <= '10:00') {
            $jamKerja = 8;
            $status = 'hadir';
        } elseif ($jamMasuk <= '11:00') {
            $jamKerja = 7;
            $status = 'telat';
        } elseif ($jamMasuk <= '12:00') {
            $jamKerja = 6;
            $status = 'telat';
        }

        $absen->update([
            'jam_masuk' => $jamMasuk,
            'jam_kerja' => $jamKerja,
            'status_hadir' => $request->status_hadir ?? $status,
            'status' => 'approved'
        ]);

        return back()->with('success', 'Absensi di-approve');
    }

    public function reject($id)
    {
        Absensi::findOrFail($id)->update([
            'status' => 'rejected'
        ]);

        return back()->with('error', 'Absensi ditolak');
    }

    // ===================== LEMBUR =====================

    public function lemburPending()
    {
        $data = Lembur::with('user')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.lembur', compact('data'));
    }

    public function approveLembur($id)
    {
        $lembur = Lembur::findOrFail($id);
        $user = $lembur->user;

        if ($user->sisa_kuota_lembur < $lembur->durasi_jam) {
            return back()->with('error', 'Kuota lembur tidak cukup');
        }

        $user->decrement('sisa_kuota_lembur', $lembur->durasi_jam);

        $lembur->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'Lembur disetujui');
    }

    public function rejectLembur($id)
    {
        Lembur::findOrFail($id)->update([
            'status' => 'rejected'
        ]);

        return back()->with('error', 'Lembur ditolak');
    }

    // ===================== MONITORING =====================

    public function monitoring()
    {
        $today = now()->toDateString();

        $users = User::where('role', 'karyawan')->get();

        $data = [];

        foreach ($users as $user) {

            $absen = Absensi::where('user_id', $user->id)
                ->whereDate('tanggal', $today)
                ->first();

            $sedangSurvey = SurveyEvent::whereHas('users', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->whereDate('tanggal_mulai', '<=', $today)
                ->whereDate('tanggal_selesai', '>=', $today)
                ->exists();

            $status = 'Alpha';

            if ($sedangSurvey) {
                $status = 'Survey';
            } elseif ($absen) {
                $status = $absen->status_hadir;
            }

            $data[] = [
                'user' => $user,
                'absen' => $absen,
                'status' => $status,
                'survey' => $sedangSurvey
            ];
        }

        return view('admin.monitoring', compact('data'));
    }

    // ===================== EDIT ABSENSI =====================

    public function editAbsensi($id)
    {
        $absen = Absensi::with('user')->findOrFail($id);

        return view('admin.edit-absensi', compact('absen'));
    }

    public function updateAbsensi(Request $request, $id)
    {
        $request->validate([
            'jam_masuk' => 'required'
        ]);

        $absen = Absensi::findOrFail($id);

        $jamMasuk = $request->jam_masuk;

        $jamKerja = 0;
        $status = 'alpha';

        if ($jamMasuk <= '10:00') {
            $jamKerja = 8;
            $status = 'hadir';
        } elseif ($jamMasuk <= '11:00') {
            $jamKerja = 7;
            $status = 'telat';
        } elseif ($jamMasuk <= '12:00') {
            $jamKerja = 6;
            $status = 'telat';
        }

        $absen->update([
            'jam_masuk' => $jamMasuk,
            'jam_kerja' => $jamKerja,
            'status_hadir' => $request->status_hadir ?? $status,
            'status' => 'approved'
        ]);

        return redirect('/admin/monitoring')->with('success', 'Data berhasil diubah');
    }
    public function dashboard()
{
    $totalKaryawan = \App\Models\User::where('role', 'karyawan')->count();

    $absensiPending = \App\Models\Absensi::where('status', 'pending')->count();

    $lemburPending = \App\Models\Lembur::where('status', 'pending')->count();

    $hariIni = now()->toDateString();

    // hadir hari ini
    $hadirHariIni = \App\Models\Absensi::whereDate('tanggal', $hariIni)
        ->where('status', 'approved')
        ->count();

    // survey hari ini (jumlah karyawan yg ikut survey)
    $surveyHariIni = \App\Models\SurveyEvent::whereDate('tanggal_mulai', '<=', $hariIni)
        ->whereDate('tanggal_selesai', '>=', $hariIni)
        ->withCount('users')
        ->get()
        ->sum('users_count');

    // 🔥 FIX LOGIC
    $belumAbsen = $totalKaryawan - $hadirHariIni - $surveyHariIni;

    if ($belumAbsen < 0) {
        $belumAbsen = 0;
    }

    return view('admin.dashboard', compact(
        'totalKaryawan',
        'absensiPending',
        'lemburPending',
        'hadirHariIni',
        'surveyHariIni',
        'belumAbsen'
    ));
}
}