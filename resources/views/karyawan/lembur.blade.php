<x-app-layout>

    <div class="flex flex-col md:flex-row bg-gray-100 min-h-screen overflow-x-hidden">

        {{-- SIDEBAR --}}
        <x-sidebar />

        {{-- CONTENT --}}
        <div class="flex-1 p-4 md:p-6">

            <div class="max-w-xl mx-auto">

                {{-- HEADER --}}
                <div class="mb-6">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 leading-tight">
                        ⏱ Pengajuan Lembur
                    </h1>

                    <p class="text-sm md:text-base text-gray-500 mt-1">
                        Ajukan lembur sesuai kebutuhan pekerjaan dan kuota yang tersedia.
                    </p>
                </div>

                {{-- ALERT --}}
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-2xl shadow-sm break-words">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-200 text-red-700 rounded-2xl shadow-sm break-words">
                        ❌ {{ session('error') }}
                    </div>
                @endif

                {{-- KUOTA --}}
                <div class="bg-purple-50 border border-purple-200 p-5 rounded-2xl mb-6 text-center shadow-sm">

                    <p class="text-sm text-purple-700">
                        Sisa Kuota Lembur
                    </p>

                    <p class="text-2xl md:text-3xl font-bold text-purple-600 mt-2 break-words">
                        {{ $user->sisa_kuota_lembur }} Jam
                    </p>

                </div>

                {{-- FORM --}}
                <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100">

                    <form method="POST" action="/lembur" class="space-y-5">
                        @csrf

                        {{-- TANGGAL --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Lembur
                            </label>

                            <input
                                type="date"
                                name="tanggal"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition text-sm md:text-base"
                                required
                            >

                        </div>

                        {{-- DURASI --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Durasi (Jam)
                            </label>

                            <input
                                type="number"
                                name="durasi_jam"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition text-sm md:text-base"
                                placeholder="Contoh: 2"
                                required
                            >

                        </div>

                        {{-- TUJUAN --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tujuan Lembur
                            </label>

                            <textarea
                                name="tujuan"
                                rows="4"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-purple-200 focus:border-purple-400 transition text-sm md:text-base"
                                placeholder="Jelaskan alasan lembur..."
                                required
                            ></textarea>

                        </div>

                        {{-- BUTTON --}}
                        <button
                            class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-xl font-semibold transition duration-300 shadow-sm text-sm md:text-base"
                        >
                            🚀 Ajukan Lembur
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>