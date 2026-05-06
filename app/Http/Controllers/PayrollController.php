<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Lembur;
use App\Models\User;
use App\Models\SurveyEvent;
use App\Models\Setting;
use Carbon\Carbon;

class PayrollController extends Controller
{
    public function index()
    {
        return view('admin.payroll');
    }

    public function rekap(Request $request)
    {
        $bulanInput = $request->bulan;
        $bulan = date('m', strtotime($bulanInput));

        $users = User::where('role', 'karyawan')->get();

        // 🔥 ambil setting sekali saja (biar tidak query berulang)
        $rateLembur = Setting::where('key', 'rate_lembur')->value('value') ?? 0;
        $spjValue = Setting::where('key', 'spj')->value('value') ?? 0;

        $data = [];

        foreach ($users as $user) {

            // =====================
            // ABSENSI
            // =====================
            $totalJam = Absensi::where('user_id', $user->id)
                ->whereMonth('tanggal', $bulan)
                ->where('status', 'approved')
                ->sum('jam_kerja');

            // =====================
            // LEMBUR
            // =====================
            $totalLembur = Lembur::where('user_id', $user->id)
                ->whereMonth('tanggal', $bulan)
                ->where('status', 'approved')
                ->sum('durasi_jam');

            // =====================
            // SURVEY
            // =====================
            $surveyEvents = SurveyEvent::whereHas('users', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->whereMonth('tanggal_mulai', $bulan)
                ->get();

            $totalHariSurvey = 0;
            $totalSPJ = 0;

            foreach ($surveyEvents as $event) {

                $start = Carbon::parse($event->tanggal_mulai);
                $end = Carbon::parse($event->tanggal_selesai);

                $hari = $start->diffInDays($end) + 1;

                $totalHariSurvey += $hari;

                // 1 event = 1 SPJ
                $totalSPJ += $spjValue;
            }

            // tambah jam survey
            $totalJam += ($totalHariSurvey * 8);

            // =====================
            // GAJI
            // =====================
            $rate = $user->jabatan->rate_per_jam ?? 0;

            $gajiPokok = $totalJam * $rate;
            $gajiLembur = $totalLembur * $rateLembur;

            $totalGaji = $gajiPokok + $gajiLembur + $totalSPJ;

            $data[] = [
                'user_id' => $user->id,
                'nama' => $user->name,
                'jam' => $totalJam,
                'lembur' => $totalLembur,
                'gaji' => $totalGaji
            ];
        }

        return view('admin.payroll', compact('data', 'bulanInput'));
    }

    public function detail(Request $request, $id)
    {
        $bulanInput = $request->bulan;
        $bulan = date('m', strtotime($bulanInput));

        $user = User::findOrFail($id);

        // 🔥 setting
        $rateLembur = Setting::where('key', 'rate_lembur')->value('value') ?? 0;
        $spjValue = Setting::where('key', 'spj')->value('value') ?? 0;

        // =====================
        // ABSENSI
        // =====================
        $absensi = Absensi::where('user_id', $id)
            ->whereMonth('tanggal', $bulan)
            ->where('status', 'approved')
            ->get();

        // =====================
        // LEMBUR
        // =====================
        $lembur = Lembur::where('user_id', $id)
            ->whereMonth('tanggal', $bulan)
            ->where('status', 'approved')
            ->get();

        // =====================
        // SURVEY
        // =====================
        $surveyEvents = SurveyEvent::whereHas('users', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->whereMonth('tanggal_mulai', $bulan)
            ->get();

        $totalHariSurvey = 0;
        $totalSPJ = 0;

        foreach ($surveyEvents as $event) {

            $start = Carbon::parse($event->tanggal_mulai);
            $end = Carbon::parse($event->tanggal_selesai);

            $hari = $start->diffInDays($end) + 1;

            $totalHariSurvey += $hari;
            $totalSPJ += $spjValue;
        }

        // =====================
        // TOTAL
        // =====================
        $totalJam = $absensi->sum('jam_kerja') + ($totalHariSurvey * 8);
        $totalLembur = $lembur->sum('durasi_jam');

        $rate = $user->jabatan->rate_per_jam ?? 0;

        $gajiPokok = $totalJam * $rate;
        $gajiLembur = $totalLembur * $rateLembur;

        $totalGaji = $gajiPokok + $gajiLembur + $totalSPJ;

        return view('admin.payroll-detail', compact(
            'user',
            'absensi',
            'lembur',
            'totalJam',
            'totalLembur',
            'totalGaji',
            'totalSPJ',
            'totalHariSurvey',
            'surveyEvents', 
            'bulanInput'
        ));
    }
}