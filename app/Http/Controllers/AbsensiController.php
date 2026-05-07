<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\SurveyEvent;
use App\Models\Setting;

class AbsensiController extends Controller
{
    // =====================================================
    // ABSEN KANTOR
    // =====================================================

    public function absenKantor(Request $request)
    {
        $user = auth()->user();
        $today = now()->toDateString();

        // =====================================================
        // VALIDASI WIFI KANTOR
        // =====================================================

        // ambil IP kantor dari settings
        $ipKantor = Setting::where('key', 'ip_kantor')
            ->value('value');

        // ambil real IP user dari Railway proxy
        $forwarded = $request->header('X-Forwarded-For');

        if ($forwarded) {

            $ipUser = trim(explode(',', $forwarded)[0]);

        } else {

            $ipUser = $request->ip();
        }

        // izinkan localhost
        if (
            $ipUser !== '127.0.0.1' &&
            $ipUser !== '::1'
        ) {

            // cek apakah IP sesuai
            if (
                $ipKantor &&
                substr($ipUser, 0, strlen($ipKantor)) !== $ipKantor
            ) {

                return back()->with(
                    'error',
                    'Absen kantor hanya bisa menggunakan WiFi kantor'
                );
            }
        }

        // =====================================================
        // CEK SEDANG SURVEY
        // =====================================================

        $sedangSurvey = SurveyEvent::whereHas('users', function ($q) use ($user) {

                $q->where('user_id', $user->id);

            })
            ->whereDate('tanggal_mulai', '<=', $today)
            ->whereDate('tanggal_selesai', '>=', $today)
            ->exists();

        if ($sedangSurvey) {

            return back()->with(
                'error',
                'Anda sedang dalam jadwal survey'
            );
        }

        // =====================================================
        // CEGAH DOUBLE ABSEN
        // =====================================================

        $sudahAbsen = Absensi::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->exists();

        if ($sudahAbsen) {

            return back()->with(
                'error',
                'Kamu sudah absen hari ini'
            );
        }

        // =====================================================
        // HITUNG STATUS HADIR
        // =====================================================

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

        // =====================================================
        // SIMPAN ABSENSI
        // =====================================================

        Absensi::create([

            'user_id' => $user->id,
            'tanggal' => $today,
            'tipe' => 'kantor',
            'status' => 'approved',
            'jam_masuk' => now(),
            'jam_kerja' => $jamKerja,
            'status_hadir' => $status,

        ]);

        return back()->with(
            'success',
            'Absen kantor berhasil'
        );
    }

    // =====================================================
    // ABSEN LUAR
    // =====================================================

    public function absenLuar(Request $request)
    {
        $request->validate([
            'alasan' => 'required'
        ]);

        $user = auth()->user();
        $today = now()->toDateString();

        // =====================================================
        // CEK SEDANG SURVEY
        // =====================================================

        $sedangSurvey = SurveyEvent::whereHas('users', function ($q) use ($user) {

                $q->where('user_id', $user->id);

            })
            ->whereDate('tanggal_mulai', '<=', $today)
            ->whereDate('tanggal_selesai', '>=', $today)
            ->exists();

        if ($sedangSurvey) {

            return back()->with(
                'error',
                'Anda sedang dalam jadwal survey'
            );
        }

        // =====================================================
        // CEGAH DOUBLE ABSEN
        // =====================================================

        $sudahAbsen = Absensi::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->exists();

        if ($sudahAbsen) {

            return back()->with(
                'error',
                'Kamu sudah absen hari ini'
            );
        }

        // =====================================================
        // SIMPAN ABSENSI LUAR
        // =====================================================

        Absensi::create([

            'user_id' => $user->id,
            'tanggal' => $today,
            'tipe' => 'luar',
            'status' => 'pending',
            'jam_masuk' => now(),
            'alasan' => $request->alasan,

        ]);

        return back()->with(
            'success',
            'Pengajuan absensi luar dikirim'
        );
    }

    // =====================================================
    // HALAMAN ABSENSI
    // =====================================================

    public function halamanAbsensi()
    {
        $user = auth()->user();
        $today = now()->toDateString();

        // =====================================================
        // CEK SURVEY
        // =====================================================

        $sedangSurvey = SurveyEvent::whereHas('users', function ($q) use ($user) {

                $q->where('user_id', $user->id);

            })
            ->whereDate('tanggal_mulai', '<=', $today)
            ->whereDate('tanggal_selesai', '>=', $today)
            ->exists();

        // =====================================================
        // CEK ABSEN HARI INI
        // =====================================================

        $absen = Absensi::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->first();

        return view(
            'karyawan.absensi',
            compact(
                'sedangSurvey',
                'absen'
            )
        );
    }
}