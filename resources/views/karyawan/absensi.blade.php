<x-app-layout>

    <div class="flex flex-col md:flex-row bg-gray-100 min-h-screen overflow-x-hidden">

        {{-- SIDEBAR --}}
        <x-sidebar />

        {{-- CONTENT --}}
        <div class="flex-1 p-4 md:p-6">

            {{-- HEADER --}}
            <div class="mb-6">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 leading-tight">
                    📍 Absensi Karyawan
                </h1>

                <p class="text-sm md:text-base text-gray-500 mt-1 break-words">
                    Lakukan absensi harian dengan benar dan tepat waktu.
                </p>
            </div>

            {{-- ALERT --}}
            @if(session('success'))
                <div class="mb-5 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl shadow-sm">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl shadow-sm">
                    ❌ {{ session('error') }}
                </div>
            @endif

            {{-- STATUS --}}
            <div class="bg-white rounded-2xl shadow-sm p-4 md:p-6 mb-6 border border-gray-100">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">
                            Status Absensi Hari Ini
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ now()->translatedFormat('l, d F Y') }}
                        </p>
                    </div>

                    {{-- STATUS BADGE --}}
                    <div class="w-full md:w-auto">

                        @if($sedangSurvey)

                            <span class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-semibold text-sm">
                                📍 Sedang Survey
                            </span>

                        @elseif(!$absen)

                            <span class="inline-flex items-center px-4 py-2 rounded-full bg-gray-100 text-gray-700 font-semibold text-sm">
                                ⏳ Belum Absen
                            </span>

                        @elseif($absen->status == 'pending')

                            <span class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 font-semibold text-sm">
                                🟡 Menunggu Approval
                            </span>

                        @elseif($absen->status == 'approved')

                            <span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 font-semibold text-sm">
                                ✅ Sudah Absen
                            </span>

                        @endif

                    </div>

                </div>

                {{-- INFO ABSEN --}}
                @if($absen)

                    <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

                        <div class="bg-gray-50 rounded-xl p-4 border">
                            <p class="text-sm text-gray-500">
                                Tipe Absensi
                            </p>

                            <h3 class="font-bold text-gray-800 mt-1 capitalize break-words">
                                {{ $absen->tipe }}
                            </h3>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4 border">
                            <p class="text-sm text-gray-500">
                                Jam Masuk
                            </p>

                            <h3 class="font-bold text-gray-800 mt-1">
                                {{ \Carbon\Carbon::parse($absen->jam_masuk)->format('H:i') }}
                            </h3>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4 border">
                            <p class="text-sm text-gray-500">
                                Status Hadir
                            </p>

                            <h3 class="font-bold text-gray-800 mt-1 capitalize break-words">
                                {{ $absen->status_hadir ?? '-' }}
                            </h3>
                        </div>

                    </div>

                @endif

            </div>

            {{-- ACTION --}}
            @if(!$sedangSurvey)

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    {{-- ABSEN KANTOR --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-6">

                        <div class="flex items-start gap-3 mb-5">

                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-2xl shrink-0">
                                🏢
                            </div>

                            <div>
                                <h2 class="font-bold text-lg text-gray-800">
                                    Absen Kantor
                                </h2>

                                <p class="text-sm text-gray-500 break-words">
                                    Hanya bisa dilakukan menggunakan WiFi kantor
                                </p>
                            </div>

                        </div>

                        <form method="POST" action="{{ route('absen.kantor') }}">
                            @csrf

                            <button
                                class="w-full py-3 rounded-xl font-semibold transition duration-300 text-sm md:text-base
                                {{ $absen
                                    ? 'bg-gray-300 text-gray-600 cursor-not-allowed'
                                    : 'bg-blue-600 hover:bg-blue-700 text-white shadow-lg'
                                }}"
                                {{ $absen ? 'disabled' : '' }}
                            >
                                {{ $absen ? 'Sudah Absen' : 'Konfirmasi Absen Kantor' }}
                            </button>

                        </form>

                    </div>

                    {{-- ABSEN LUAR --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-6">

                        <div class="flex items-start gap-3 mb-5">

                            <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center text-2xl shrink-0">
                                🌍
                            </div>

                            <div>
                                <h2 class="font-bold text-lg text-gray-800">
                                    Absen Luar Kantor
                                </h2>

                                <p class="text-sm text-gray-500 break-words">
                                    Digunakan jika bekerja di luar kantor
                                </p>
                            </div>

                        </div>

                        <form method="POST" action="{{ route('absen.luar') }}">
                            @csrf

                            <textarea
                                name="alasan"
                                rows="4"
                                class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 text-sm md:text-base"
                                placeholder="Masukkan alasan bekerja di luar kantor..."
                                {{ $absen ? 'disabled' : '' }}
                                required
                            ></textarea>

                            <button
                                class="w-full mt-4 py-3 rounded-xl font-semibold transition duration-300 text-sm md:text-base
                                {{ $absen
                                    ? 'bg-gray-300 text-gray-600 cursor-not-allowed'
                                    : 'bg-yellow-500 hover:bg-yellow-600 text-white shadow-lg'
                                }}"
                                {{ $absen ? 'disabled' : '' }}
                            >
                                {{ $absen ? 'Sudah Absen' : 'Ajukan Absensi Luar' }}
                            </button>

                        </form>

                    </div>

                </div>

            @else

                {{-- SURVEY --}}
                <div class="bg-blue-100 border border-blue-300 text-blue-700 rounded-2xl p-4 md:p-6 shadow-sm">
                    <h2 class="font-bold text-lg mb-2">
                        📍 Sedang Survey
                    </h2>

                    <p class="break-words">
                        Kamu sedang berada dalam jadwal survey sehingga absensi kantor maupun luar kantor dinonaktifkan.
                    </p>
                </div>

            @endif

        </div>

    </div>

</x-app-layout>