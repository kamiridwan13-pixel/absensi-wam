<x-app-layout>

    <div class="flex flex-col md:flex-row bg-gray-100 min-h-screen overflow-x-hidden">

        {{-- SIDEBAR --}}
        <x-sidebar-admin />

        {{-- CONTENT --}}
        <div class="flex-1 p-4 md:p-6">

            <div class="max-w-7xl mx-auto">

                {{-- HEADER --}}
                <div class="mb-6">

                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 leading-tight">
                        📡 Monitoring Harian
                    </h1>

                    <p class="text-sm md:text-base text-gray-500 mt-1">
                        Pantau status kehadiran seluruh karyawan secara realtime.
                    </p>

                </div>

                {{-- SUMMARY --}}
                @php
                    $total = count($data);
                    $hadir = collect($data)->where('status','hadir')->count();
                    $survey = collect($data)->where('survey',true)->count();
                    $alpha = collect($data)->where('status','Alpha')->count();
                @endphp

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6 text-center">

                    {{-- TOTAL --}}
                    <div class="bg-white p-4 md:p-5 rounded-2xl shadow-sm border border-gray-100">

                        <p class="text-sm text-gray-500">
                            Total
                        </p>

                        <p class="text-2xl md:text-3xl font-bold text-gray-800 mt-2">
                            {{ $total }}
                        </p>

                    </div>

                    {{-- HADIR --}}
                    <div class="bg-green-50 p-4 md:p-5 rounded-2xl shadow-sm border border-green-100">

                        <p class="text-sm text-green-700">
                            Hadir
                        </p>

                        <p class="text-2xl md:text-3xl font-bold text-green-600 mt-2">
                            {{ $hadir }}
                        </p>

                    </div>

                    {{-- SURVEY --}}
                    <div class="bg-blue-50 p-4 md:p-5 rounded-2xl shadow-sm border border-blue-100">

                        <p class="text-sm text-blue-700">
                            Survey
                        </p>

                        <p class="text-2xl md:text-3xl font-bold text-blue-600 mt-2">
                            {{ $survey }}
                        </p>

                    </div>

                    {{-- ALPHA --}}
                    <div class="bg-red-50 p-4 md:p-5 rounded-2xl shadow-sm border border-red-100">

                        <p class="text-sm text-red-700">
                            Alpha
                        </p>

                        <p class="text-2xl md:text-3xl font-bold text-red-600 mt-2">
                            {{ $alpha }}
                        </p>

                    </div>

                </div>

                {{-- TABLE --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-6">

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[700px] text-sm">

                            {{-- TABLE HEAD --}}
                            <thead class="bg-gray-100 text-gray-700">

                                <tr>

                                    <th class="p-4 text-left rounded-l-xl font-semibold">
                                        Nama
                                    </th>

                                    <th class="p-4 text-left font-semibold">
                                        Status
                                    </th>

                                    <th class="p-4 text-left font-semibold">
                                        Jam Masuk
                                    </th>

                                    <th class="p-4 text-left rounded-r-xl font-semibold">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>

                            {{-- TABLE BODY --}}
                            <tbody>

                                @foreach($data as $d)

                                    <tr class="border-t hover:bg-gray-50 transition duration-200">

                                        {{-- NAMA --}}
                                        <td class="p-4 font-medium text-gray-800 whitespace-nowrap">
                                            {{ $d['user']->name }}
                                        </td>

                                        {{-- STATUS --}}
                                        <td class="p-4">

                                            @if($d['survey'])

                                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 whitespace-nowrap">
                                                    📍 Survey
                                                </span>

                                            @elseif($d['absen'])

                                                @if($d['absen']->status_hadir == 'hadir')

                                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 whitespace-nowrap">
                                                        🟢 Hadir
                                                    </span>

                                                @elseif($d['absen']->status_hadir == 'telat')

                                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700 whitespace-nowrap">
                                                        🟡 Telat
                                                    </span>

                                                @else

                                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700 whitespace-nowrap">
                                                        🔴 Alpha
                                                    </span>

                                                @endif

                                            @else

                                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-200 text-gray-700 whitespace-nowrap">
                                                    ⚪ Belum Absen
                                                </span>

                                            @endif

                                        </td>

                                        {{-- JAM MASUK --}}
                                        <td class="p-4 whitespace-nowrap text-gray-700">
                                            {{ $d['absen']->jam_masuk ?? '-' }}
                                        </td>

                                        {{-- AKSI --}}
                                        <td class="p-4">

                                            @if($d['absen'])

                                                <a href="/admin/absensi/{{ $d['absen']->id }}/edit"
                                                   class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-xl text-xs font-semibold transition duration-300 shadow-sm whitespace-nowrap">

                                                    ✏ Edit

                                                </a>

                                            @else

                                                <span class="text-gray-400 text-xs">
                                                    -
                                                </span>

                                            @endif

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