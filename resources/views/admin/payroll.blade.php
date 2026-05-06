<x-app-layout>
    <div class="flex">

        {{-- SIDEBAR --}}
        <x-sidebar-admin />

        {{-- CONTENT --}}
        <div class="flex-1 p-6 bg-gray-100 min-h-screen">

            <h1 class="text-xl font-bold mb-6">Rekap Gaji Bulanan</h1>

            <div class="bg-white shadow rounded-lg p-6">

                {{-- FORM PILIH BULAN --}}
                <form method="GET" action="/admin/payroll/show" class="mb-6">
                    <div class="flex gap-4 items-center">

                        <input type="month"
                               name="bulan"
                               value="{{ $bulanInput ?? '' }}"
                               class="border p-2 rounded"
                               required>

                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Lihat
                        </button>

                    </div>
                </form>

                {{-- INFO AWAL --}}
                @if(!isset($data))
                    <div class="p-4 bg-gray-100 text-gray-600 rounded">
                        Silakan pilih bulan terlebih dahulu
                    </div>
                @endif

                {{-- TABEL --}}
                @if(isset($data))

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm border">

                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="p-3 text-left">Nama</th>
                                    <th class="p-3 text-left">Jam Kerja</th>
                                    <th class="p-3 text-left">Lembur</th>
                                    <th class="p-3 text-left">Total Gaji</th>
                                    <th class="p-3 text-center">Detail</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($data as $item)
                                    <tr class="border-t hover:bg-gray-50">

                                        <td class="p-3">{{ $item['nama'] }}</td>

                                        <td class="p-3">
                                            {{ $item['jam'] }} jam
                                        </td>

                                        <td class="p-3">
                                            {{ $item['lembur'] }} jam
                                        </td>

                                        <td class="p-3 font-semibold text-green-600">
                                            Rp {{ number_format($item['gaji']) }}
                                        </td>

                                        <td class="p-3 text-center">
                                            <a href="/admin/payroll/detail/{{ $item['user_id'] }}?bulan={{ $bulanInput }}"
                                               class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                                Detail
                                            </a>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-4 text-center text-gray-500">
                                            Tidak ada data
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                    {{-- TOTAL GAJI SEMUA --}}
                    <div class="mt-6 text-right">
                        <p class="text-lg font-bold">
                            Total Semua Gaji:
                            <span class="text-blue-600">
                                Rp {{ number_format(collect($data)->sum('gaji')) }}
                            </span>
                        </p>
                    </div>

                @endif

            </div>

        </div>

    </div>
</x-app-layout>