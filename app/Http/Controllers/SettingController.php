<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
class SettingController extends Controller
{
    public function index()
{
    return view('admin.setting', [
        'rate_lembur' => Setting::where('key','rate_lembur')->value('value'),
        'spj' => Setting::where('key','spj')->value('value'),
    ]);
}

public function update(Request $request)
{
    Setting::updateOrCreate(
        ['key' => 'rate_lembur'],
        ['value' => $request->rate_lembur]
    );

    Setting::updateOrCreate(
        ['key' => 'spj'],
        ['value' => $request->spj]
    );

    return back()->with('success','Setting berhasil disimpan');
}
}
