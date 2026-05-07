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
                        ⚙️ Setting
                    </h1>

                    <p class="text-sm md:text-base text-gray-500 mt-1">
                        Kelola pengaturan sistem payroll dan lembur.
                    </p>

                </div>

                {{-- CARD --}}
                <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100">

                    <form method="POST"
                          action="/admin/setting"
                          class="space-y-5">

                        @csrf

                        {{-- RATE LEMBUR --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Rate Lembur
                            </label>

                            <input
                                type="number"
                                name="rate_lembur"
                                value="{{ $rate_lembur }}"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-sm md:text-base"
                                placeholder="Masukkan rate lembur"
                            >

                        </div>

                        {{-- SPJ --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                SPJ
                            </label>

                            <input
                                type="number"
                                name="spj"
                                value="{{ $spj }}"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-sm md:text-base"
                                placeholder="Masukkan nominal SPJ"
                            >

                        </div>

                        {{-- BUTTON --}}
                        <button
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition duration-300 shadow-sm"
                        >
                            💾 Simpan Pengaturan
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>