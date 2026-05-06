<x-app-layout>
<div class="flex">

<x-sidebar-admin />

<div class="flex-1 p-6 bg-gray-100 min-h-screen">

<div class="max-w-6xl mx-auto">

{{-- HEADER --}}
<h1 class="text-2xl font-bold mb-6">
    Detail Gaji - {{ $user->name }}
</h1>

{{-- SUMMARY --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

    <div class="bg-white p-4 rounded-xl shadow text-center">
        <p class="text-sm text-gray-500">Total Jam</p>
        <p class="text-2xl font-bold text-gray-800">{{ $totalJam }}</p>
    </div>

    <div class="bg-white p-4 rounded-xl shadow text-center">
        <p class="text-sm text-gray-500">Lembur</p>
        <p class="text-2xl font-bold text-purple-600">{{ $totalLembur }}</p>
    </div>

    <div class="bg-white p-4 rounded-xl shadow text-center">
        <p class="text-sm text-gray-500">Hari Survey</p>
        <p class="text-2xl font-bold text-blue-600">{{ $totalHariSurvey }}</p>
    </div>

    <div class="bg-white p-4 rounded-xl shadow text-center">
        <p class="text-sm text-gray-500">SPJ</p>
        <p class="text-2xl font-bold text-indigo-600">
            Rp {{ number_format($totalSPJ) }}
        </p>
    </div>

</div>

{{-- TOTAL GAJI --}}
<div class="bg-green-50 border border-green-200 p-6 rounded-2xl mb-6 text-center shadow">
    <p class="text-lg text-gray-600">Total Gaji</p>
    <p class="text-3xl font-bold text-green-600 mt-2">
        Rp {{ number_format($totalGaji) }}
    </p>
</div>

{{-- ABSENSI --}}
<div class="bg-white p-6 rounded-2xl shadow mb-6">
    <h2 class="font-bold text-lg mb-4">📅 Detail Absensi</h2>

    <table class="w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Tanggal</th>
                <th class="p-3 text-left">Jam Kerja</th>
                <th class="p-3 text-left">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensi as $a)
            <tr class="border-t">
                <td class="p-3">{{ $a->tanggal }}</td>
                <td class="p-3">{{ $a->jam_kerja }} jam</td>
                <td class="p-3">
                    <span class="px-2 py-1 rounded text-xs
                        {{ $a->status_hadir == 'hadir' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $a->status_hadir == 'telat' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $a->status_hadir == 'alpha' ? 'bg-red-100 text-red-700' : '' }}">
                        {{ $a->status_hadir }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- LEMBUR --}}
<div class="bg-white p-6 rounded-2xl shadow mb-6">
    <h2 class="font-bold text-lg mb-4">⏱️ Detail Lembur</h2>

    <table class="w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Tanggal</th>
                <th class="p-3 text-left">Durasi</th>
                <th class="p-3 text-left">Tujuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lembur as $l)
            <tr class="border-t">
                <td class="p-3">{{ $l->tanggal }}</td>
                <td class="p-3">{{ $l->durasi_jam }} jam</td>
                <td class="p-3">{{ $l->tujuan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- SURVEY --}}
<div class="bg-white p-6 rounded-2xl shadow mb-6">
    <h2 class="font-bold text-lg mb-4">📍 Detail Survey</h2>

    <p class="mb-3 text-sm text-gray-600">
        Total Event: <b>{{ $surveyEvents->count() }}</b>
    </p>

    <table class="w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Judul</th>
                <th class="p-3 text-left">Tanggal</th>
                <th class="p-3 text-left">Hari</th>
                <th class="p-3 text-left">SPJ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($surveyEvents as $s)

            @php
                $start = \Carbon\Carbon::parse($s->tanggal_mulai);
                $end = \Carbon\Carbon::parse($s->tanggal_selesai);
                $hari = $start->diffInDays($end) + 1;
                $spjPerEvent = \App\Models\Setting::where('key','spj')->value('value') ?? 0;
            @endphp

            <tr class="border-t">
                <td class="p-3">{{ $s->judul }}</td>
                <td class="p-3">
                    {{ $s->tanggal_mulai }} - {{ $s->tanggal_selesai }}
                </td>
                <td class="p-3">{{ $hari }} hari</td>
                <td class="p-3 text-blue-600 font-semibold">
                    Rp {{ number_format($spjPerEvent) }}
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>

</div>
</div>
</div>
</x-app-layout>