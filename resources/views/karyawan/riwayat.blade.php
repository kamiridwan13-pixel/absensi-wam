<x-app-layout>
<div class="flex">

<x-sidebar />

<div class="flex-1 p-6 bg-gray-100 min-h-screen">

<div class="max-w-6xl mx-auto">

<h1 class="text-2xl font-bold mb-6">📊 Riwayat Aktivitas</h1>

{{-- FILTER --}}
<form method="GET" class="mb-6 flex gap-3 items-center">
    <input type="month" name="bulan"
        value="{{ $bulanInput }}"
        class="border p-2 rounded-lg">

    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
        Filter
    </button>
</form>

{{-- ================= ABSENSI ================= --}}
<div class="bg-white p-6 rounded-2xl shadow mb-6">
    <h2 class="font-bold mb-4">📅 Absensi</h2>

    <table class="w-full text-sm">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="p-3 text-left">Tanggal</th>
                <th class="p-3 text-left">Jam</th>
                <th class="p-3 text-left">Status</th>
            </tr>
        </thead>

        <tbody>
        @forelse($absensi as $a)
            <tr class="border-t hover:bg-gray-50">
                <td class="p-3">{{ $a->tanggal }}</td>
                <td class="p-3">{{ $a->jam_masuk }}</td>
                <td class="p-3">
                    <span class="px-2 py-1 rounded text-xs
                        {{ $a->status_hadir == 'hadir' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $a->status_hadir == 'telat' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $a->status_hadir == 'alpha' ? 'bg-red-100 text-red-700' : '' }}">
                        {{ $a->status_hadir }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center p-4 text-gray-400">
                    Tidak ada data absensi
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

{{-- ================= LEMBUR ================= --}}
<div class="bg-white p-6 rounded-2xl shadow mb-6">
    <h2 class="font-bold mb-4">⏱ Lembur</h2>

    <table class="w-full text-sm">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="p-3 text-left">Tanggal</th>
                <th class="p-3 text-left">Durasi</th>
                <th class="p-3 text-left">Status</th>
            </tr>
        </thead>

        <tbody>
        @forelse($lembur as $l)
            <tr class="border-t hover:bg-gray-50">
                <td class="p-3">{{ $l->tanggal }}</td>
                <td class="p-3">{{ $l->durasi_jam }} jam</td>
                <td class="p-3">
                    <span class="px-2 py-1 rounded text-xs
                        {{ $l->status == 'approved' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $l->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $l->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                        {{ $l->status }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center p-4 text-gray-400">
                    Tidak ada data lembur
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

{{-- ================= SURVEY ================= --}}
<div class="bg-white p-6 rounded-2xl shadow">
    <h2 class="font-bold mb-4">📍 Survey</h2>

    <table class="w-full text-sm">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="p-3 text-left">Judul</th>
                <th class="p-3 text-left">Tanggal</th>
                <th class="p-3 text-left">Durasi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($survey as $s)

            @php
                $start = \Carbon\Carbon::parse($s->tanggal_mulai);
                $end = \Carbon\Carbon::parse($s->tanggal_selesai);
                $hari = $start->diffInDays($end) + 1;
            @endphp

            <tr class="border-t hover:bg-gray-50">
                <td class="p-3 font-medium">{{ $s->judul }}</td>
                <td class="p-3">
                    {{ $s->tanggal_mulai }} - {{ $s->tanggal_selesai }}
                </td>
                <td class="p-3">{{ $hari }} hari</td>
            </tr>

        @empty
            <tr>
                <td colspan="3" class="text-center p-4 text-gray-400">
                    Tidak ada data survey
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

</div>
</div>
</div>
</x-app-layout>