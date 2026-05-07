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
                        💰 Rekap Gaji Bulanan
                    </h1>

                    <p class="text-sm md:text-base text-gray-500 mt-1">
                        Lihat rekap payroll dan total gaji seluruh karyawan.
                    </p>

                </div>

                {{-- CARD --}}
                <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-4 md:p-6">

                    {{-- FORM PILIH BULAN --}}
                    <form method="GET"
                          action="/admin/payroll/show"
                          class="mb-6">

                        <div class="flex flex-col sm:flex-row gap-4 sm:items-center">

                            <input
                                type="month"
                                name="bulan"
                                value="{{ $bulanInput ?? '' }}"
                                class="w-full sm:w-auto border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-sm md:text-base"
                                required
                            >

                            <button
                                class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-semibold transition duration-300 shadow-sm"
                            >
                                Lihat
                            </button>

                        </div>

                    </form>

                    {{-- INFO AWAL --}}
                    @if(!isset($data))

                        <div class="p-4 bg-gray-100 text-gray-600 rounded-2xl border border-gray-200">
                            Silakan pilih bulan terlebih dahulu
                        </div>

                    @endif

                    {{-- TABEL --}}
                    @if(isset($data))

                        <div class="overflow-x-auto">

                            <table class="w-full min-w-[850px] text-sm">

                                {{-- TABLE HEAD --}}
                                <thead class="bg-gray-100 text-gray-700">

                                    <tr>

                                        <th class="p-4 text-left rounded-l-xl font-semibold">
                                            Nama
                                        </th>

                                        <th class="p-4 text-left font-semibold">
                                            Jam Kerja
                                        </th>

                                        <th class="p-4 text-left font-semibold">
                                            Lembur
                                        </th>

                                        <th class="p-4 text-left font-semibold">
                                            Total Gaji
                                        </th>

                                        <th class="p-4 text-center rounded-r-xl font-semibold">
                                            Detail
                                        </th>

                                    </tr>

                                </thead>

                                {{-- TABLE BODY --}}
                                <tbody>

                                    @forelse($data as $item)

                                        <tr class="border-t hover:bg-gray-50 transition duration-200">

                                            {{-- NAMA --}}
                                            <td class="p-4 font-medium text-gray-800 whitespace-nowrap">
                                                {{ $item['nama'] }}
                                            </td>

                                            {{-- JAM --}}
                                            <td class="p-4 whitespace-nowrap text-gray-700">
                                                {{ $item['jam'] }} jam
                                            </td>

                                            {{-- LEMBUR --}}
                                            <td class="p-4 whitespace-nowrap text-gray-700">
                                                {{ $item['lembur'] }} jam
                                            </td>

                                            {{-- GAJI --}}
                                            <td class="p-4 font-semibold text-green-600 whitespace-nowrap">
                                                Rp {{ number_format($item['gaji']) }}
                                            </td>

                                            {{-- DETAIL --}}
                                            <td class="p-4 text-center">

                                                <a href="/admin/payroll/detail/{{ $item['user_id'] }}?bulan={{ $bulanInput }}"
                                                   class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-xs md:text-sm font-semibold transition duration-300 shadow-sm whitespace-nowrap">

                                                    Detail

                                                </a>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="5"
                                                class="p-8 text-center text-gray-400">

                                                Tidak ada data

                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                        {{-- TOTAL --}}
                        <div class="mt-6 flex justify-end">

                            <div class="bg-blue-50 border border-blue-100 px-5 py-4 rounded-2xl text-right shadow-sm">

                                <p class="text-sm text-gray-600">
                                    Total Semua Gaji
                                </p>

                                <p class="text-xl md:text-2xl font-bold text-blue-600 mt-1 break-words">
                                    Rp {{ number_format(collect($data)->sum('gaji')) }}
                                </p>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>