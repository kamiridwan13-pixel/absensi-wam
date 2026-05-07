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
                        ➕ Tambah Jabatan
                    </h1>

                    <p class="text-sm md:text-base text-gray-500 mt-1">
                        Tambahkan data jabatan dan rate gaji per jam.
                    </p>

                </div>

                {{-- CARD --}}
                <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100">

                    <form method="POST"
                          action="/admin/jabatan"
                          class="space-y-5">

                        @csrf

                        {{-- NAMA JABATAN --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Jabatan
                            </label>

                            <input
                                type="text"
                                name="nama"
                                placeholder="Masukkan nama jabatan"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-green-200 focus:border-green-400 transition text-sm md:text-base"
                                required
                            >

                        </div>

                        {{-- RATE PER JAM --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Rate per Jam
                            </label>

                            <input
                                type="number"
                                name="rate_per_jam"
                                placeholder="Masukkan nominal rate per jam"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-green-200 focus:border-green-400 transition text-sm md:text-base"
                                required
                            >

                        </div>

                        {{-- BUTTON --}}
                        <button
                            class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold transition duration-300 shadow-sm"
                        >
                            💾 Simpan
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>