<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Lembur;
use App\Models\SurveyEvent;
use Carbon\Carbon;

class KaryawanController extends Controller
{
public function dashboard()
{
    $user = auth()->user();
    $today = now()->toDateString();

    $absen = Absensi::where('user_id', $user->id)
        ->whereDate('tanggal', $today)
        ->first();

    $sedangSurvey = SurveyEvent::whereHas('users', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
        ->whereDate('tanggal_mulai', '<=', $today)
        ->whereDate('tanggal_selesai', '>=', $today)
        ->exists();

    return view('karyawan.dashboard', compact(
        'user',
        'absen',
        'sedangSurvey'
    ));
}

public function riwayat(Request $request)
{
    $user = auth()->user();

    $bulanInput = $request->bulan ?? now()->format('Y-m');
    $bulan = date('m', strtotime($bulanInput));

    // ABSENSI
    $absensi = Absensi::where('user_id', $user->id)
        ->whereMonth('tanggal', $bulan)
        ->latest()
        ->get();

    // LEMBUR
    $lembur = Lembur::where('user_id', $user->id)
        ->whereMonth('tanggal', $bulan)
        ->latest()
        ->get();

    // SURVEY
    $survey = SurveyEvent::whereHas('users', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
        ->whereMonth('tanggal_mulai', $bulan)
        ->get();

    return view('karyawan.riwayat', compact(
        'absensi',
        'lembur',
        'survey',
        'bulanInput'
    ));
}
}
