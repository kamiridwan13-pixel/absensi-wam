<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\SurveyEvent;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function absenKantor()
    {
        $user = auth()->user();
        $today = now()->toDateString();

        // 🔥 CEK SEDANG SURVEY
        $sedangSurvey = SurveyEvent::whereHas('users', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->whereDate('tanggal_mulai', '<=', $today)
            ->whereDate('tanggal_selesai', '>=', $today)
            ->exists();

        if ($sedangSurvey) {
            return back()->with('error', 'Anda sedang dalam jadwal survey');
        }

        // ❗ cegah double absen
        if (Absensi::where('user_id', $user->id)->whereDate('tanggal', $today)->exists()) {
            return back()->with('error', 'Kamu sudah absen hari ini');
        }

        $jam = now()->format('H:i:s');

        if ($jam <= '10:00:00') {
            $jamKerja = 8;
            $status = 'hadir';
        } elseif ($jam <= '11:00:00') {
            $jamKerja = 7;
            $status = 'telat';
        } elseif ($jam <= '12:00:00') {
            $jamKerja = 6;
            $status = 'telat';
        } else {
            $jamKerja = 0;
            $status = 'alpha';
        }

        Absensi::create([
            'user_id' => $user->id,
            'tanggal' => $today,
            'tipe' => 'kantor',
            'status' => 'approved',
            'jam_masuk' => now(),
            'jam_kerja' => $jamKerja,
            'status_hadir' => $status,
        ]);

        return back()->with('success', 'Absen berhasil');
    }

    public function absenLuar(Request $request)
    {
        $request->validate([
            'alasan' => 'required'
        ]);

        $user = auth()->user();
        $today = now()->toDateString();

        // 🔥 CEK SEDANG SURVEY
        $sedangSurvey = SurveyEvent::whereHas('users', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->whereDate('tanggal_mulai', '<=', $today)
            ->whereDate('tanggal_selesai', '>=', $today)
            ->exists();

        if ($sedangSurvey) {
            return back()->with('error', 'Anda sedang dalam jadwal survey');
        }

        // ❗ cegah double absen
        if (Absensi::where('user_id', $user->id)->whereDate('tanggal', $today)->exists()) {
            return back()->with('error', 'Kamu sudah absen hari ini');
        }

        Absensi::create([
            'user_id' => $user->id,
            'tanggal' => $today,
            'tipe' => 'luar',
            'status' => 'pending',
            'jam_masuk' => now(),
            'alasan' => $request->alasan,
        ]);

        return back()->with('success', 'Pengajuan absensi dikirim');
    }

    public function halamanAbsensi()
    {
        $user = auth()->user();
        $today = now()->toDateString();

        // 🔥 CEK SURVEY
        $sedangSurvey = SurveyEvent::whereHas('users', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->whereDate('tanggal_mulai', '<=', $today)
            ->whereDate('tanggal_selesai', '>=', $today)
            ->exists();

        // 🔥 CEK ABSEN HARI INI
        $absen = Absensi::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->first();

        return view('karyawan.absensi', compact('sedangSurvey', 'absen'));
    }
}