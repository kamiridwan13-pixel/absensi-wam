<x-app-layout>

    <div class="flex flex-col md:flex-row bg-gray-100 min-h-screen overflow-x-hidden">

        {{-- SIDEBAR --}}
        <x-sidebar />

        {{-- CONTENT --}}
        <div class="flex-1 p-4 md:p-6">

            <div class="max-w-6xl mx-auto">

                {{-- HEADER --}}
                <div class="mb-6">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 leading-tight">
                        📊 Riwayat Aktivitas
                    </h1>

                    <p class="text-sm md:text-base text-gray-500 mt-1">
                        Lihat riwayat absensi, lembur, dan survey berdasarkan bulan.
                    </p>
                </div>

                {{-- FILTER --}}
                <div class="bg-white p-4 md:p-5 rounded-2xl shadow-sm border border-gray-100 mb-6">

                    <form method="GET"
                          class="flex flex-col sm:flex-row gap-3 sm:items-center">

                        <input
                            type="month"
                            name="bulan"
                            value="{{ $bulanInput }}"
                            class="w-full sm:w-auto border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-sm md:text-base"
                        >

                        <button
                            class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-semibold transition duration-300 shadow-sm">
                            Filter
                        </button>

                    </form>

                </div>

                {{-- ================= ABSENSI ================= --}}
                <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100 mb-6">

                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-bold text-lg text-gray-800">
                            📅 Absensi
                        </h2>
                    </div>

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[500px] text-sm">

                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="p-3 text-left rounded-l-xl">
                                        Tanggal
                                    </th>

                                    <th class="p-3 text-left">
                                        Jam
                                    </th>

                                    <th class="p-3 text-left rounded-r-xl">
                                        Status
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                            @forelse($absensi as $a)

                                <tr class="border-t hover:bg-gray-50 transition">

                                    <td class="p-3 whitespace-nowrap">
                                        {{ $a->tanggal }}
                                    </td>

                                    <td class="p-3 whitespace-nowrap">
                                        {{ $a->jam_masuk }}
                                    </td>

                                    <td class="p-3">

                                        <span class="px-3 py-1 rounded-full text-xs font-semibold capitalize
                                            {{ $a->status_hadir == 'hadir' ? 'bg-green-100 text-green-700' : '' }}
                                            {{ $a->status_hadir == 'telat' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                            {{ $a->status_hadir == 'alpha' ? 'bg-red-100 text-red-700' : '' }}">

                                            {{ $a->status_hadir }}

                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="3" class="text-center p-6 text-gray-400">
                                        Tidak ada data absensi
                                    </td>
                                </tr>

                            @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

                {{-- ================= LEMBUR ================= --}}
                <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100 mb-6">

                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-bold text-lg text-gray-800">
                            ⏱ Lembur
                        </h2>
                    </div>

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[500px] text-sm">

                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="p-3 text-left rounded-l-xl">
                                        Tanggal
                                    </th>

                                    <th class="p-3 text-left">
                                        Durasi
                                    </th>

                                    <th class="p-3 text-left rounded-r-xl">
                                        Status
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                            @forelse($lembur as $l)

                                <tr class="border-t hover:bg-gray-50 transition">

                                    <td class="p-3 whitespace-nowrap">
                                        {{ $l->tanggal }}
                                    </td>

                                    <td class="p-3 whitespace-nowrap">
                                        {{ $l->durasi_jam }} jam
                                    </td>

                                    <td class="p-3">

                                        <span class="px-3 py-1 rounded-full text-xs font-semibold capitalize
                                            {{ $l->status == 'approved' ? 'bg-green-100 text-green-700' : '' }}
                                            {{ $l->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                            {{ $l->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">

                                            {{ $l->status }}

                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="3" class="text-center p-6 text-gray-400">
                                        Tidak ada data lembur
                                    </td>
                                </tr>

                            @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

                {{-- ================= SURVEY ================= --}}
                <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100">

                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-bold text-lg text-gray-800">
                            📍 Survey
                        </h2>
                    </div>

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[600px] text-sm">

                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="p-3 text-left rounded-l-xl">
                                        Judul
                                    </th>

                                    <th class="p-3 text-left">
                                        Tanggal
                                    </th>

                                    <th class="p-3 text-left rounded-r-xl">
                                        Durasi
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                            @forelse($survey as $s)

                                @php
                                    $start = \Carbon\Carbon::parse($s->tanggal_mulai);
                                    $end = \Carbon\Carbon::parse($s->tanggal_selesai);
                                    $hari = $start->diffInDays($end) + 1;
                                @endphp

                                <tr class="border-t hover:bg-gray-50 transition">

                                    <td class="p-3 font-medium break-words">
                                        {{ $s->judul }}
                                    </td>

                                    <td class="p-3 whitespace-nowrap">
                                        {{ $s->tanggal_mulai }} - {{ $s->tanggal_selesai }}
                                    </td>

                                    <td class="p-3 whitespace-nowrap">
                                        {{ $hari }} hari
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="3" class="text-center p-6 text-gray-400">
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

    </div>

</x-app-layout>