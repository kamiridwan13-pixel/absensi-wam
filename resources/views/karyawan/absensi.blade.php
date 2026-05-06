<x-app-layout>
    <div class="flex">

        <x-sidebar />

        <div class="flex-1 p-6 bg-gray-100 min-h-screen">

            <h1 class="text-2xl font-bold mb-6">Absensi Karyawan</h1>

            <div class="bg-white p-6 rounded-2xl shadow">

                {{-- STATUS --}}
                <div class="mb-6">

                    @if($sedangSurvey)
                        <div class="p-4 bg-blue-100 text-blue-800 rounded-lg">
                            📍 Anda sedang dalam jadwal <b>Survey</b> hari ini
                        </div>

                    @elseif(!$absen)
                        <div class="p-4 bg-gray-100 text-gray-700 rounded-lg">
                            🔴 Belum Absen Hari Ini
                        </div>

                    @elseif($absen->status === 'pending')
                        <div class="p-4 bg-yellow-100 text-yellow-800 rounded-lg">
                            🟡 Menunggu Approval (Absen Luar)
                        </div>

                    @elseif($absen->status === 'approved')
                        <div class="p-4 bg-green-100 text-green-800 rounded-lg">
                            🟢 Sudah Absen ({{ ucfirst($absen->tipe) }})
                            <br>
                            Jam Masuk: {{ $absen->jam_masuk }}
                        </div>

                    @elseif($absen->status_hadir === 'alpha')
                        <div class="p-4 bg-red-100 text-red-800 rounded-lg">
                            ⚫ Alpha (Tidak Masuk)
                        </div>
                    @endif

                </div>

                {{-- PILIHAN --}}
                <div class="flex gap-4 mb-6">

                    {{-- KANTOR --}}
                    <button onclick="pilih('kantor')"
                        class="flex-1 px-4 py-3 rounded-xl font-semibold transition
                        {{ ($absen || $sedangSurvey) 
                            ? 'bg-gray-300 text-gray-500 cursor-not-allowed' 
                            : 'bg-blue-600 text-white hover:bg-blue-700' }}"
                        {{ ($absen || $sedangSurvey) ? 'disabled' : '' }}>
                        🏢 Absen di Kantor
                    </button>

                    {{-- LUAR --}}
                    <button onclick="pilih('luar')"
                        class="flex-1 px-4 py-3 rounded-xl font-semibold transition
                        {{ ($absen || $sedangSurvey) 
                            ? 'bg-gray-300 text-gray-500 cursor-not-allowed' 
                            : 'bg-yellow-500 text-white hover:bg-yellow-600' }}"
                        {{ ($absen || $sedangSurvey) ? 'disabled' : '' }}>
                        🌍 Absen di Luar Kantor
                    </button>

                </div>

                {{-- FORM KANTOR --}}
                <div id="form-kantor" class="hidden">

                    <div class="bg-gray-50 p-4 rounded-xl">
                        <p class="mb-3 text-sm text-gray-600">
                            Klik tombol di bawah untuk konfirmasi absensi kantor
                        </p>

                        <form method="POST" action="{{ route('absen.kantor') }}">
                            @csrf

                            <button
                                class="w-full px-4 py-3 rounded-xl font-semibold transition
                                {{ ($absen || $sedangSurvey)
                                    ? 'bg-gray-300 text-gray-500 cursor-not-allowed'
                                    : 'bg-blue-700 text-white hover:bg-blue-800' }}"
                                {{ ($absen || $sedangSurvey) ? 'disabled' : '' }}>
                                ✔ Konfirmasi Absen Kantor
                            </button>

                        </form>
                    </div>

                </div>

                {{-- FORM LUAR --}}
                <div id="form-luar" class="hidden">

                    <div class="bg-gray-50 p-4 rounded-xl">

                        <form method="POST" action="{{ route('absen.luar') }}">
                            @csrf

                            <label class="block mb-2 text-sm font-medium">
                                Alasan Absen
                            </label>

                            <textarea name="alasan"
                                class="border w-full p-3 rounded-lg mb-4 focus:ring focus:ring-blue-200
                                {{ ($absen || $sedangSurvey) ? 'bg-gray-200' : '' }}"
                                {{ ($absen || $sedangSurvey) ? 'disabled' : '' }}
                                placeholder="Contoh: Meeting di luar kantor..."
                                required></textarea>

                            <button
                                class="w-full px-4 py-3 rounded-xl font-semibold transition
                                {{ ($absen || $sedangSurvey)
                                    ? 'bg-gray-300 text-gray-500 cursor-not-allowed'
                                    : 'bg-green-600 text-white hover:bg-green-700' }}"
                                {{ ($absen || $sedangSurvey) ? 'disabled' : '' }}>
                                🚀 Kirim Pengajuan
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- SCRIPT --}}
    <script>
        function pilih(tipe) {
            document.getElementById('form-kantor').classList.add('hidden');
            document.getElementById('form-luar').classList.add('hidden');

            if (tipe === 'kantor') {
                document.getElementById('form-kantor').classList.remove('hidden');
            } else {
                document.getElementById('form-luar').classList.remove('hidden');
            }
        }
    </script>

</x-app-layout>