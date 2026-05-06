<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lembur;
use App\Models\SurveyEvent;
use App\Models\Absensi;

class LemburController extends Controller
{
    public function halamanLembur()
    {
        $user = auth()->user();
        return view('karyawan.lembur', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'durasi_jam' => 'required|integer|min:1',
            'tujuan' => 'required'
        ]);

        $userId = auth()->id();
        $tanggal = $request->tanggal;

        // ❌ CEK SURVEY
        $sedangSurvey = SurveyEvent::whereHas('users', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->whereDate('tanggal_mulai', '<=', $tanggal)
            ->whereDate('tanggal_selesai', '>=', $tanggal)
            ->exists();

        if ($sedangSurvey) {
            return back()->with('error', 'Tidak bisa lembur saat survey');
        }

        // ❌ CEK ABSENSI
        $sudahAbsen = Absensi::where('user_id', $userId)
            ->whereDate('tanggal', $tanggal)
            ->exists();

        if ($sudahAbsen) {
            return back()->with('error', 'Sudah ada absensi di tanggal tersebut');
        }

        Lembur::create([
            'user_id' => $userId,
            'tanggal' => $tanggal,
            'durasi_jam' => $request->durasi_jam,
            'tujuan' => $request->tujuan,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Pengajuan lembur dikirim');
    }
}