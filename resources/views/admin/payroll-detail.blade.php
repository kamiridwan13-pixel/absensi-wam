<x-app-layout>

    <div class="flex flex-col md:flex-row bg-gray-100 min-h-screen overflow-x-hidden">

        {{-- SIDEBAR --}}
        <x-sidebar-admin />

        {{-- CONTENT --}}
        <div class="flex-1 p-4 md:p-6">

            <div class="max-w-7xl mx-auto">

                {{-- HEADER --}}
                <div class="mb-6">

                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 leading-tight break-words">
                        💰 Detail Gaji - {{ $user->name }}
                    </h1>

                    <p class="text-sm md:text-base text-gray-500 mt-1">
                        Ringkasan payroll, absensi, lembur, dan survey karyawan.
                    </p>

                </div>

                {{-- SUMMARY --}}
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

                    {{-- TOTAL JAM --}}
                    <div class="bg-white p-4 md:p-5 rounded-2xl shadow-sm border border-gray-100 text-center">

                        <p class="text-sm text-gray-500">
                            Total Jam
                        </p>

                        <p class="text-2xl md:text-3xl font-bold text-gray-800 mt-2">
                            {{ $totalJam }}
                        </p>

                    </div>

                    {{-- LEMBUR --}}
                    <div class="bg-purple-50 p-4 md:p-5 rounded-2xl shadow-sm border border-purple-100 text-center">

                        <p class="text-sm text-purple-700">
                            Lembur
                        </p>

                        <p class="text-2xl md:text-3xl font-bold text-purple-600 mt-2">
                            {{ $totalLembur }}
                        </p>

                    </div>

                    {{-- SURVEY --}}
                    <div class="bg-blue-50 p-4 md:p-5 rounded-2xl shadow-sm border border-blue-100 text-center">

                        <p class="text-sm text-blue-700">
                            Hari Survey
                        </p>

                        <p class="text-2xl md:text-3xl font-bold text-blue-600 mt-2">
                            {{ $totalHariSurvey }}
                        </p>

                    </div>

                    {{-- SPJ --}}
                    <div class="bg-indigo-50 p-4 md:p-5 rounded-2xl shadow-sm border border-indigo-100 text-center">

                        <p class="text-sm text-indigo-700">
                            SPJ
                        </p>

                        <p class="text-xl md:text-2xl font-bold text-indigo-600 mt-2 break-words">
                            Rp {{ number_format($totalSPJ) }}
                        </p>

                    </div>

                </div>

                {{-- TOTAL GAJI --}}
                <div class="bg-green-50 border border-green-200 p-5 md:p-6 rounded-2xl mb-6 text-center shadow-sm">

                    <p class="text-base md:text-lg text-gray-600">
                        Total Gaji
                    </p>

                    <p class="text-2xl md:text-4xl font-bold text-green-600 mt-3 break-words">
                        Rp {{ number_format($totalGaji) }}
                    </p>

                </div>

                {{-- ABSENSI --}}
                <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100 mb-6">

                    <h2 class="font-bold text-lg text-gray-800 mb-4">
                        📅 Detail Absensi
                    </h2>

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[650px] text-sm">

                            <thead class="bg-gray-100 text-gray-700">

                                <tr>

                                    <th class="p-4 text-left rounded-l-xl">
                                        Tanggal
                                    </th>

                                    <th class="p-4 text-left">
                                        Jam Kerja
                                    </th>

                                    <th class="p-4 text-left rounded-r-xl">
                                        Status
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($absensi as $a)

                                    <tr class="border-t hover:bg-gray-50 transition">

                                        <td class="p-4 whitespace-nowrap">
                                            {{ $a->tanggal }}
                                        </td>

                                        <td class="p-4 whitespace-nowrap">
                                            {{ $a->jam_kerja }} jam
                                        </td>

                                        <td class="p-4">

                                            <span class="px-3 py-1 rounded-full text-xs font-semibold capitalize
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

                </div>

                {{-- LEMBUR --}}
                <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100 mb-6">

                    <h2 class="font-bold text-lg text-gray-800 mb-4">
                        ⏱️ Detail Lembur
                    </h2>

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[700px] text-sm">

                            <thead class="bg-gray-100 text-gray-700">

                                <tr>

                                    <th class="p-4 text-left rounded-l-xl">
                                        Tanggal
                                    </th>

                                    <th class="p-4 text-left">
                                        Durasi
                                    </th>

                                    <th class="p-4 text-left rounded-r-xl">
                                        Tujuan
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($lembur as $l)

                                    <tr class="border-t hover:bg-gray-50 transition">

                                        <td class="p-4 whitespace-nowrap">
                                            {{ $l->tanggal }}
                                        </td>

                                        <td class="p-4 whitespace-nowrap">
                                            {{ $l->durasi_jam }} jam
                                        </td>

                                        <td class="p-4 break-words">
                                            {{ $l->tujuan }}
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

                {{-- SURVEY --}}
                <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100 mb-6">

                    <h2 class="font-bold text-lg text-gray-800 mb-4">
                        📍 Detail Survey
                    </h2>

                    <p class="mb-4 text-sm text-gray-600">
                        Total Event:
                        <span class="font-semibold">
                            {{ $surveyEvents->count() }}
                        </span>
                    </p>

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[750px] text-sm">

                            <thead class="bg-gray-100 text-gray-700">

                                <tr>

                                    <th class="p-4 text-left rounded-l-xl">
                                        Judul
                                    </th>

                                    <th class="p-4 text-left">
                                        Tanggal
                                    </th>

                                    <th class="p-4 text-left">
                                        Hari
                                    </th>

                                    <th class="p-4 text-left rounded-r-xl">
                                        SPJ
                                    </th>

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

                                    <tr class="border-t hover:bg-gray-50 transition">

                                        <td class="p-4 font-medium break-words">
                                            {{ $s->judul }}
                                        </td>

                                        <td class="p-4 whitespace-nowrap">
                                            {{ $s->tanggal_mulai }} - {{ $s->tanggal_selesai }}
                                        </td>

                                        <td class="p-4 whitespace-nowrap">
                                            {{ $hari }} hari
                                        </td>

                                        <td class="p-4 whitespace-nowrap text-blue-600 font-semibold">
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

    </div>

</x-app-layout>