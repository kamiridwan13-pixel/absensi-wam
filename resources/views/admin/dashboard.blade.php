<x-app-layout>
<div class="flex">

<x-sidebar-admin />

<div class="flex-1 p-6 bg-gray-100 min-h-screen">

<h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

{{-- TOP CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    <div class="bg-white p-6 rounded-2xl shadow">
        <p class="text-gray-500 text-sm">Total Karyawan</p>
        <p class="text-3xl font-bold mt-2">{{ $totalKaryawan }}</p>
    </div>

    <div class="bg-yellow-50 p-6 rounded-2xl shadow">
        <p class="text-yellow-700 text-sm">Absensi Pending</p>
        <p class="text-3xl font-bold mt-2 text-yellow-600">
            {{ $absensiPending }}
        </p>
    </div>

    <div class="bg-blue-50 p-6 rounded-2xl shadow">
        <p class="text-blue-700 text-sm">Lembur Pending</p>
        <p class="text-3xl font-bold mt-2 text-blue-600">
            {{ $lemburPending }}
        </p>
    </div>

</div>

{{-- RINGKASAN --}}
<div class="bg-white p-6 rounded-2xl shadow">

    <h2 class="text-lg font-bold mb-4">Ringkasan Hari Ini</h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">

        {{-- HADIR --}}
        <div class="bg-green-50 p-4 rounded-xl">
            <p class="text-green-700 text-sm">Hadir</p>
            <p class="text-2xl font-bold text-green-600">
                {{ $hadirHariIni }}
            </p>
        </div>

        {{-- SURVEY --}}
        <div class="bg-blue-50 p-4 rounded-xl">
            <p class="text-blue-700 text-sm">Survey</p>
            <p class="text-2xl font-bold text-blue-600">
                {{ $surveyHariIni }}
            </p>
        </div>

        {{-- BELUM ABSEN --}}
        <div class="bg-gray-50 p-4 rounded-xl">
            <p class="text-gray-700 text-sm">Belum Absen</p>
            <p class="text-2xl font-bold text-gray-600">
                {{ $belumAbsen }}
            </p>
        </div>

        {{-- PERLU PERHATIAN --}}
        <div class="bg-red-50 p-4 rounded-xl">
            <p class="text-red-700 text-sm">Perlu Perhatian</p>
            <p class="text-2xl font-bold text-red-600">
                {{ $absensiPending + $lemburPending }}
            </p>
        </div>

    </div>

</div>

</div>
</div>
</x-app-layout>