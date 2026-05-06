<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SurveyEvent;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Lembur;

class SurveyEventController extends Controller
{
    // ===================== LIST =====================
    public function index()
    {
        $surveys = SurveyEvent::with('users')->latest()->get();
        return view('admin.survey-event.index', compact('surveys'));
    }

    // ===================== CREATE =====================
    public function create()
    {
        $users = User::where('role', 'karyawan')->get();
        return view('admin.survey-event.create', compact('users'));
    }

    // ===================== STORE =====================
    public function store(Request $request)
    {
        $users = array_filter($request->users ?? []);

        $request->validate([
            'judul' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        if (count($users) === 0) {
            return back()->with('error', 'Pilih minimal 1 karyawan');
        }

        foreach ($users as $userId) {

            // ❌ CEK BENTROK SURVEY
            $bentrokSurvey = SurveyEvent::whereHas('users', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->where(function ($q) use ($request) {
                $q->whereBetween('tanggal_mulai', [$request->tanggal_mulai, $request->tanggal_selesai])
                  ->orWhereBetween('tanggal_selesai', [$request->tanggal_mulai, $request->tanggal_selesai])
                  ->orWhere(function ($q2) use ($request) {
                      $q2->where('tanggal_mulai', '<=', $request->tanggal_mulai)
                         ->where('tanggal_selesai', '>=', $request->tanggal_selesai);
                  });
            })
            ->exists();

            if ($bentrokSurvey) {
                return back()->with('error', 'Bentrok dengan survey lain');
            }

            // ❌ CEK ABSENSI
            $absenBentrok = Absensi::where('user_id', $userId)
                ->whereBetween('tanggal', [$request->tanggal_mulai, $request->tanggal_selesai])
                ->exists();

            if ($absenBentrok) {
                return back()->with('error', 'Bentrok dengan absensi');
            }

            // ❌ CEK LEMBUR
            $lemburBentrok = Lembur::where('user_id', $userId)
                ->whereBetween('tanggal', [$request->tanggal_mulai, $request->tanggal_selesai])
                ->exists();

            if ($lemburBentrok) {
                return back()->with('error', 'Bentrok dengan lembur');
            }
        }

        $survey = SurveyEvent::create([
            'judul' => $request->judul,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);

        $survey->users()->attach($users);

        return redirect('/admin/survey-event')->with('success', 'Survey berhasil dibuat');
    }

    // ===================== EDIT =====================
    public function edit($id)
    {
        $survey = SurveyEvent::with('users')->findOrFail($id);
        $users = User::where('role', 'karyawan')->get();

        return view('admin.survey-event.edit', compact('survey', 'users'));
    }

    // ===================== UPDATE =====================
    public function update(Request $request, $id)
    {
        $users = array_filter($request->users ?? []);

        $request->validate([
            'judul' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        if (count($users) === 0) {
            return back()->with('error', 'Pilih minimal 1 karyawan');
        }

        $survey = SurveyEvent::findOrFail($id);

        $survey->update([
            'judul' => $request->judul,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);

        $survey->users()->sync($users);

        return redirect('/admin/survey-event')->with('success', 'Survey berhasil diupdate');
    }

    // ===================== DELETE =====================
    public function destroy($id)
    {
        SurveyEvent::findOrFail($id)->delete();
        return back()->with('success', 'Survey berhasil dihapus');
    }
}