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
                        ✏️ Edit Jabatan
                    </h1>

                    <p class="text-sm md:text-base text-gray-500 mt-1">
                        Perbarui data jabatan dan rate gaji per jam.
                    </p>

                </div>

                {{-- CARD --}}
                <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100">

                    <form method="POST"
                          action="/admin/jabatan/{{ $jabatan->id }}"
                          class="space-y-5">

                        @csrf
                        @method('PUT')

                        {{-- NAMA JABATAN --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Jabatan
                            </label>

                            <input
                                type="text"
                                name="nama"
                                value="{{ $jabatan->nama }}"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-sm md:text-base"
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
                                value="{{ $jabatan->rate_per_jam }}"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-sm md:text-base"
                                required
                            >

                        </div>

                        {{-- BUTTON --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">

                            <a href="/admin/jabatan"
                               class="text-center bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 rounded-xl font-semibold transition duration-300">
                                ⬅ Kembali
                            </a>

                            <button
                                class="bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition duration-300 shadow-sm"
                            >
                                💾 Update
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>