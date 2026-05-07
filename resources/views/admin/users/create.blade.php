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
                        ➕ Tambah Karyawan
                    </h1>

                    <p class="text-sm md:text-base text-gray-500 mt-1">
                        Tambahkan data karyawan baru ke dalam sistem.
                    </p>

                </div>

                {{-- CARD --}}
                <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100">

                    <form method="POST"
                          action="/admin/users"
                          class="space-y-5">

                        @csrf

                        {{-- NAMA --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-sm md:text-base"
                                placeholder="Masukkan nama karyawan"
                                required
                            >

                        </div>

                        {{-- EMAIL --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-sm md:text-base"
                                placeholder="Masukkan email"
                                required
                            >

                        </div>

                        {{-- PASSWORD --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-sm md:text-base"
                                placeholder="Masukkan password"
                                required
                            >

                        </div>

                        {{-- ROLE --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Role
                            </label>

                            <select
                                name="role"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-sm md:text-base"
                            >

                                <option value="karyawan">
                                    👤 Karyawan
                                </option>

                                <option value="admin">
                                    🛠 Admin
                                </option>

                            </select>

                        </div>

                        {{-- JABATAN --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Jabatan
                            </label>

                            <select
                                name="jabatan_id"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-sm md:text-base"
                                required
                            >

                                <option value="">
                                    -- Pilih Jabatan --
                                </option>

                                @foreach($jabatans as $j)

                                    <option value="{{ $j->id }}">
                                        {{ $j->nama }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        {{-- BUTTON --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-4">

                            <a href="/admin/users"
                               class="text-center bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 rounded-xl font-semibold transition duration-300">
                                ⬅ Kembali
                            </a>

                            <button
                                class="bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold transition duration-300 shadow-sm"
                            >
                                💾 Simpan
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>