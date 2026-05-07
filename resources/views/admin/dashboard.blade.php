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
                        📊 Dashboard Admin
                    </h1>

                    <p class="text-sm md:text-base text-gray-500 mt-1">
                        Pantau aktivitas absensi, lembur, dan status karyawan hari ini.
                    </p>

                </div>

                {{-- TOP CARDS --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

                    {{-- TOTAL KARYAWAN --}}
                    <div class="bg-white p-5 md:p-6 rounded-2xl shadow-sm border border-gray-100">

                        <p class="text-gray-500 text-sm">
                            Total Karyawan
                        </p>

                        <p class="text-3xl font-bold text-gray-800 mt-3">
                            {{ $totalKaryawan }}
                        </p>

                    </div>

                    {{-- ABSENSI PENDING --}}
                    <div class="bg-yellow-50 p-5 md:p-6 rounded-2xl shadow-sm border border-yellow-100">

                        <p class="text-yellow-700 text-sm">
                            Absensi Pending
                        </p>

                        <p class="text-3xl font-bold mt-3 text-yellow-600">
                            {{ $absensiPending }}
                        </p>

                    </div>

                    {{-- LEMBUR PENDING --}}
                    <div class="bg-blue-50 p-5 md:p-6 rounded-2xl shadow-sm border border-blue-100">

                        <p class="text-blue-700 text-sm">
                            Lembur Pending
                        </p>

                        <p class="text-3xl font-bold mt-3 text-blue-600">
                            {{ $lemburPending }}
                        </p>

                    </div>

                </div>

                {{-- RINGKASAN --}}
                <div class="bg-white p-5 md:p-6 rounded-2xl shadow-sm border border-gray-100">

                    <div class="flex items-center justify-between mb-5">

                        <div>
                            <h2 class="text-lg md:text-xl font-bold text-gray-800">
                                Ringkasan Hari Ini
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                Statistik aktivitas karyawan hari ini
                            </p>
                        </div>

                    </div>

                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

                        {{-- HADIR --}}
                        <div class="bg-green-50 p-4 rounded-2xl text-center border border-green-100">

                            <p class="text-green-700 text-sm">
                                Hadir
                            </p>

                            <p class="text-2xl md:text-3xl font-bold text-green-600 mt-2">
                                {{ $hadirHariIni }}
                            </p>

                        </div>

                        {{-- SURVEY --}}
                        <div class="bg-blue-50 p-4 rounded-2xl text-center border border-blue-100">

                            <p class="text-blue-700 text-sm">
                                Survey
                            </p>

                            <p class="text-2xl md:text-3xl font-bold text-blue-600 mt-2">
                                {{ $surveyHariIni }}
                            </p>

                        </div>

                        {{-- BELUM ABSEN --}}
                        <div class="bg-gray-50 p-4 rounded-2xl text-center border border-gray-100">

                            <p class="text-gray-700 text-sm">
                                Belum Absen
                            </p>

                            <p class="text-2xl md:text-3xl font-bold text-gray-600 mt-2">
                                {{ $belumAbsen }}
                            </p>

                        </div>

                        {{-- PERLU PERHATIAN --}}
                        <div class="bg-red-50 p-4 rounded-2xl text-center border border-red-100">

                            <p class="text-red-700 text-sm">
                                Perlu Perhatian
                            </p>

                            <p class="text-2xl md:text-3xl font-bold text-red-600 mt-2">
                                {{ $absensiPending + $lemburPending }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>