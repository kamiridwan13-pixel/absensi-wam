<x-app-layout>
<div class="flex">

<x-sidebar />

<div class="flex-1 p-6 bg-gray-100 min-h-screen">

<div class="max-w-5xl mx-auto">

<h1 class="text-2xl font-bold mb-6">
    👋 Halo, {{ $user->name }}
</h1>

{{-- STATUS --}}
<div class="bg-white p-6 rounded-2xl shadow mb-6">

    <h2 class="font-bold mb-4">Status Hari Ini</h2>

    @if($sedangSurvey)
        <div class="p-4 bg-blue-100 text-blue-700 rounded-lg">
            📍 Kamu sedang mengikuti Survey
        </div>

    @elseif($absen)

        @if($absen->status_hadir == 'hadir')
            <div class="p-4 bg-green-100 text-green-700 rounded-lg">
                🟢 Hadir
                <br>
                Jam Masuk: {{ $absen->jam_masuk }}
            </div>

        @elseif($absen->status_hadir == 'telat')
            <div class="p-4 bg-yellow-100 text-yellow-700 rounded-lg">
                🟡 Telat
                <br>
                Jam Masuk: {{ $absen->jam_masuk }}
            </div>

        @else
            <div class="p-4 bg-red-100 text-red-700 rounded-lg">
                🔴 Alpha
            </div>
        @endif

    @else
        <div class="p-4 bg-gray-100 text-gray-700 rounded-lg">
            ⚪ Belum Absen Hari Ini
        </div>
    @endif

</div>

{{-- SUMMARY --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

    {{-- KUOTA LEMBUR --}}
    <div class="bg-white p-6 rounded-2xl shadow text-center">
        <p class="text-gray-500 text-sm">Sisa Lembur</p>
        <p class="text-3xl font-bold text-purple-600">
            {{ $user->sisa_kuota_lembur }} Jam
        </p>
    </div>

    {{-- JAM MASUK --}}
    <div class="bg-white p-6 rounded-2xl shadow text-center">
        <p class="text-gray-500 text-sm">Jam Masuk</p>
        <p class="text-2xl font-bold">
            {{ $absen->jam_masuk ?? '-' }}
        </p>
    </div>

    {{-- STATUS --}}
    <div class="bg-white p-6 rounded-2xl shadow text-center">
        <p class="text-gray-500 text-sm">Status</p>
        <p class="text-xl font-bold">
            {{ $sedangSurvey ? 'Survey' : ($absen->status_hadir ?? 'Belum Absen') }}
        </p>
    </div>

</div>

{{-- ACTION --}}
<div class="bg-white p-6 rounded-2xl shadow">

    <h2 class="font-bold mb-4">Aksi Cepat</h2>

    <div class="flex gap-4">

        <a href="/karyawan/absensi"
           class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl transition">
            📍 Absen
        </a>

        <a href="/karyawan/lembur"
           class="flex-1 text-center bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-xl transition">
            ⏱ Ajukan Lembur
        </a>

    </div>

</div>

</div>

</div>
</div>
</x-app-layout>