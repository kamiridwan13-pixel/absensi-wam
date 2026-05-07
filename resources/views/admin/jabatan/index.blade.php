<x-app-layout>

    <div class="flex flex-col md:flex-row bg-gray-100 min-h-screen overflow-x-hidden">

        {{-- SIDEBAR --}}
        <x-sidebar-admin />

        {{-- CONTENT --}}
        <div class="flex-1 p-4 md:p-6">

            <div class="max-w-6xl mx-auto">

                {{-- HEADER --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

                    <div>

                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 leading-tight">
                            🏢 Manajemen Jabatan
                        </h1>

                        <p class="text-sm md:text-base text-gray-500 mt-1">
                            Kelola daftar jabatan dan rate gaji per jam.
                        </p>

                    </div>

                    {{-- BUTTON --}}
                    <a href="/admin/jabatan/create"
                       class="w-full sm:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow-sm font-semibold transition duration-300">
                        + Tambah Jabatan
                    </a>

                </div>

                {{-- TABLE CARD --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-6">

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[700px] text-sm">

                            {{-- TABLE HEAD --}}
                            <thead class="bg-gray-100 text-gray-700">

                                <tr>

                                    <th class="p-4 text-left rounded-l-xl font-semibold">
                                        Nama Jabatan
                                    </th>

                                    <th class="p-4 text-left font-semibold">
                                        Rate per Jam
                                    </th>

                                    <th class="p-4 text-left rounded-r-xl font-semibold">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>

                            {{-- TABLE BODY --}}
                            <tbody>

                                @forelse($jabatans as $j)

                                    <tr class="border-t hover:bg-gray-50 transition duration-200">

                                        {{-- NAMA --}}
                                        <td class="p-4 font-medium text-gray-800 whitespace-nowrap">
                                            {{ $j->nama }}
                                        </td>

                                        {{-- RATE --}}
                                        <td class="p-4">

                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap">
                                                Rp {{ number_format($j->rate_per_jam) }} / jam
                                            </span>

                                        </td>

                                        {{-- AKSI --}}
                                        <td class="p-4">

                                            <div class="flex flex-wrap gap-2">

                                                {{-- EDIT --}}
                                                <a href="/admin/jabatan/{{ $j->id }}/edit"
                                                   class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-xl text-xs font-semibold transition duration-300 shadow-sm whitespace-nowrap">

                                                    ✏ Edit

                                                </a>

                                                {{-- DELETE --}}
                                                <form action="/admin/jabatan/{{ $j->id }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Yakin ingin menghapus jabatan ini?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl text-xs font-semibold transition duration-300 shadow-sm whitespace-nowrap"
                                                    >
                                                        🗑 Hapus
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="3"
                                            class="text-center p-8 text-gray-400">

                                            Belum ada data jabatan

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