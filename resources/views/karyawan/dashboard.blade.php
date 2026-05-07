<x-app-layout>

    <div class="flex flex-col md:flex-row bg-gray-100 min-h-screen overflow-x-hidden">

        {{-- SIDEBAR --}}
        <x-sidebar />

        {{-- CONTENT --}}
        <div class="flex-1 p-4 md:p-6">

            <div class="max-w-5xl mx-auto">

                {{-- HEADER --}}
                <div class="mb-6">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 leading-tight break-words">
                        👋 Halo, {{ $user->name }}
                    </h1>

                    <p class="text-sm md:text-base text-gray-500 mt-1">
                        Selamat datang kembali di dashboard absensi.
                    </p>
                </div>

                {{-- STATUS --}}
                <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100 mb-6">

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">

                        <div>
                            <h2 class="font-bold text-lg text-gray-800">
                                Status Hari Ini
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ now()->translatedFormat('l, d F Y') }}
                            </p>
                        </div>

                    </div>

                    @if($sedangSurvey)

                        <div class="p-4 bg-blue-100 text-blue-700 rounded-xl">
                            📍 Kamu sedang mengikuti Survey
                        </div>

                    @elseif($absen)

                        @if($absen->status_hadir == 'hadir')

                            <div class="p-4 bg-green-100 text-green-700 rounded-xl">
                                <div class="font-semibold">
                                    🟢 Hadir
                                </div>

                                <div class="mt-1 text-sm">
                                    Jam Masuk:
                                    {{ $absen->jam_masuk }}
                                </div>
                            </div>

                        @elseif($absen->status_hadir == 'telat')

                            <div class="p-4 bg-yellow-100 text-yellow-700 rounded-xl">
                                <div class="font-semibold">
                                    🟡 Telat
                                </div>

                                <div class="mt-1 text-sm">
                                    Jam Masuk:
                                    {{ $absen->jam_masuk }}
                                </div>
                            </div>

                        @else

                            <div class="p-4 bg-red-100 text-red-700 rounded-xl">
                                🔴 Alpha
                            </div>

                        @endif

                    @else

                        <div class="p-4 bg-gray-100 text-gray-700 rounded-xl">
                            ⚪ Belum Absen Hari Ini
                        </div>

                    @endif

                </div>

                {{-- SUMMARY --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-6">

                    {{-- KUOTA LEMBUR --}}
                    <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100 text-center">

                        <p class="text-gray-500 text-sm">
                            Sisa Lembur
                        </p>

                        <p class="text-2xl md:text-3xl font-bold text-purple-600 mt-2 break-words">
                            {{ $user->sisa_kuota_lembur }} Jam
                        </p>

                    </div>

                    {{-- JAM MASUK --}}
                    <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100 text-center">

                        <p class="text-gray-500 text-sm">
                            Jam Masuk
                        </p>

                        <p class="text-xl md:text-2xl font-bold mt-2 break-words">
                            {{ $absen->jam_masuk ?? '-' }}
                        </p>

                    </div>

                    {{-- STATUS --}}
                    <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100 text-center">

                        <p class="text-gray-500 text-sm">
                            Status
                        </p>

                        <p class="text-lg md:text-xl font-bold mt-2 capitalize break-words">
                            {{ $sedangSurvey ? 'Survey' : ($absen->status_hadir ?? 'Belum Absen') }}
                        </p>

                    </div>

                </div>

                {{-- ACTION --}}
                <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100">

                    <h2 class="font-bold text-lg text-gray-800 mb-4">
                        Aksi Cepat
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <a href="/karyawan/absensi"
                           class="text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition duration-300 shadow-sm">
                            📍 Absen
                        </a>

                        <a href="/karyawan/lembur"
                           class="text-center bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-xl font-semibold transition duration-300 shadow-sm">
                            ⏱ Ajukan Lembur
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>