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
                        📋 Approval Absensi
                    </h1>

                    <p class="text-sm md:text-base text-gray-500 mt-1">
                        Kelola pengajuan absensi karyawan yang membutuhkan persetujuan.
                    </p>

                </div>

                {{-- CARD --}}
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
                                        Tanggal
                                    </th>

                                    <th class="p-4 text-left font-semibold">
                                        Alasan
                                    </th>

                                    <th class="p-4 text-center rounded-r-xl font-semibold">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>

                            {{-- TABLE BODY --}}
                            <tbody>

                                @forelse($data as $item)

                                    <tr class="border-t hover:bg-gray-50 transition duration-200">

                                        {{-- NAMA --}}
                                        <td class="p-4 font-medium text-gray-800 whitespace-nowrap">
                                            {{ $item->user->name }}
                                        </td>

                                        {{-- TANGGAL --}}
                                        <td class="p-4 whitespace-nowrap text-gray-600">
                                            {{ $item->tanggal }}
                                        </td>

                                        {{-- ALASAN --}}
                                        <td class="p-4 text-gray-700 break-words">
                                            {{ $item->alasan }}
                                        </td>

                                        {{-- AKSI --}}
                                        <td class="p-4">

                                            <div class="flex items-center justify-center gap-2">

                                                {{-- APPROVE --}}
                                                <form method="POST"
                                                      action="/admin/absensi/{{ $item->id }}/approve">
                                                    @csrf

                                                    <button
                                                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl transition duration-200 shadow-sm"
                                                    >
                                                        ✔
                                                    </button>

                                                </form>

                                                {{-- REJECT --}}
                                                <form method="POST"
                                                      action="/admin/absensi/{{ $item->id }}/reject">
                                                    @csrf

                                                    <button
                                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl transition duration-200 shadow-sm"
                                                    >
                                                        ✖
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="4"
                                            class="text-center p-8 text-gray-400">

                                            Tidak ada data approval absensi

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