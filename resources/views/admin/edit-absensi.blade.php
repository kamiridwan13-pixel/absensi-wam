<x-app-layout>

    <div class="flex flex-col md:flex-row bg-gray-100 min-h-screen overflow-x-hidden">

        {{-- SIDEBAR --}}
        <x-sidebar-admin />

        {{-- CONTENT --}}
        <div class="flex-1 p-4 md:p-6">

            <div class="max-w-xl mx-auto">

                {{-- HEADER --}}
                <div class="mb-6">

                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 leading-tight">
                        ✏️ Edit Absensi
                    </h1>

                    <p class="text-sm md:text-base text-gray-500 mt-1">
                        Perbarui data absensi karyawan dengan benar.
                    </p>

                </div>

                {{-- CARD --}}
                <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100">

                    {{-- INFO --}}
                    <div class="mb-6 p-4 bg-gray-50 rounded-xl border border-gray-100">

                        <div class="space-y-2 text-sm text-gray-600">

                            <div class="break-words">
                                Nama:
                                <span class="font-semibold text-gray-800">
                                    {{ $absen->user->name ?? '-' }}
                                </span>
                            </div>

                            <div>
                                Tanggal:
                                <span class="font-semibold text-gray-800">
                                    {{ $absen->tanggal }}
                                </span>
                            </div>

                        </div>

                    </div>

                    {{-- FORM --}}
                    <form method="POST"
                          action="/admin/absensi/{{ $absen->id }}/update"
                          class="space-y-5">

                        @csrf

                        {{-- JAM MASUK --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Jam Masuk
                            </label>

                            <input
                                type="time"
                                name="jam_masuk"
                                value="{{ \Carbon\Carbon::parse($absen->jam_masuk)->format('H:i') }}"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-sm md:text-base"
                            >

                        </div>

                        {{-- STATUS HADIR --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Status Kehadiran
                            </label>

                            <select
                                name="status_hadir"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-sm md:text-base"
                            >

                                <option value="hadir"
                                    {{ $absen->status_hadir == 'hadir' ? 'selected' : '' }}>
                                    🟢 Hadir
                                </option>

                                <option value="telat"
                                    {{ $absen->status_hadir == 'telat' ? 'selected' : '' }}>
                                    🟡 Telat
                                </option>

                                <option value="alpha"
                                    {{ $absen->status_hadir == 'alpha' ? 'selected' : '' }}>
                                    🔴 Alpha
                                </option>

                            </select>

                        </div>

                        {{-- BUTTON --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-4">

                            <a href="/admin/monitoring"
                               class="text-center bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 rounded-xl font-semibold transition duration-300">
                                ⬅ Kembali
                            </a>

                            <button
                                class="bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition duration-300 shadow-sm"
                            >
                                💾 Update Data
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>