<x-app-layout>

    <div class="flex flex-col md:flex-row bg-gray-100 min-h-screen overflow-x-hidden">

        {{-- SIDEBAR --}}
        <x-sidebar-admin />

        {{-- CONTENT --}}
        <div class="flex-1 p-4 md:p-6">

            <div class="max-w-2xl mx-auto">

                {{-- HEADER --}}
                <div class="mb-6">

                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 leading-tight">
                        ✏️ Edit Survey Event
                    </h1>

                    <p class="text-sm md:text-base text-gray-500 mt-1">
                        Perbarui data survey dan daftar karyawan yang bertugas.
                    </p>

                </div>

                {{-- CARD --}}
                <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100">

                    <form method="POST"
                          action="/admin/survey-event/{{ $survey->id }}"
                          class="space-y-5">

                        @csrf
                        @method('PUT')

                        {{-- JUDUL --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Judul Survey
                            </label>

                            <input
                                type="text"
                                name="judul"
                                value="{{ $survey->judul }}"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-sm md:text-base"
                                required
                            >

                        </div>

                        {{-- TANGGAL --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            {{-- TANGGAL MULAI --}}
                            <div>

                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Tanggal Mulai
                                </label>

                                <input
                                    type="date"
                                    name="tanggal_mulai"
                                    value="{{ $survey->tanggal_mulai }}"
                                    class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-sm md:text-base"
                                    required
                                >

                            </div>

                            {{-- TANGGAL SELESAI --}}
                            <div>

                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Tanggal Selesai
                                </label>

                                <input
                                    type="date"
                                    name="tanggal_selesai"
                                    value="{{ $survey->tanggal_selesai }}"
                                    class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-sm md:text-base"
                                    required
                                >

                            </div>

                        </div>

                        {{-- KARYAWAN --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                Pilih Karyawan
                            </label>

                            <div id="karyawan-wrapper" class="space-y-3">

                                {{-- DATA LAMA --}}
                                @foreach($survey->users as $selected)

                                    <div class="flex flex-col sm:flex-row gap-2">

                                        <select
                                            name="users[]"
                                            class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-sm md:text-base"
                                        >

                                            <option value="">
                                                -- Pilih Karyawan --
                                            </option>

                                            @foreach($users as $u)

                                                <option value="{{ $u->id }}"
                                                    {{ $selected->id == $u->id ? 'selected' : '' }}>

                                                    {{ $u->name }}

                                                </option>

                                            @endforeach

                                        </select>

                                        <button
                                            type="button"
                                            onclick="hapusBaris(this)"
                                            class="w-full sm:w-auto bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-xl transition duration-300"
                                        >
                                            ✖
                                        </button>

                                    </div>

                                @endforeach

                            </div>

                            {{-- BUTTON TAMBAH --}}
                            <button
                                type="button"
                                onclick="tambahKaryawan()"
                                class="mt-4 text-blue-600 hover:text-blue-700 font-semibold text-sm md:text-base transition"
                            >
                                ➕ Tambah Karyawan
                            </button>

                        </div>

                        {{-- BUTTON --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-4">

                            <a href="/admin/survey-event"
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

    {{-- SCRIPT --}}
    <script>

        function tambahKaryawan() {

            let wrapper = document.getElementById('karyawan-wrapper');

            let html = `
                <div class="flex flex-col sm:flex-row gap-2">

                    <select
                        name="users[]"
                        class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-sm md:text-base"
                    >

                        <option value="">
                            -- Pilih Karyawan --
                        </option>

                        @foreach($users as $u)

                            <option value="{{ $u->id }}">
                                {{ $u->name }}
                            </option>

                        @endforeach

                    </select>

                    <button
                        type="button"
                        onclick="hapusBaris(this)"
                        class="w-full sm:w-auto bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-xl transition duration-300"
                    >
                        ✖
                    </button>

                </div>
            `;

            wrapper.insertAdjacentHTML('beforeend', html);
        }

        function hapusBaris(btn) {
            btn.parentElement.remove();
        }

    </script>

</x-app-layout>