<x-app-layout>
<div class="flex">

<x-sidebar-admin />

<div class="flex-1 p-6 bg-gray-100 min-h-screen">

<div class="max-w-xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">Edit Absensi</h1>

    {{-- CARD --}}
    <div class="bg-white p-6 rounded-2xl shadow">

        {{-- INFO --}}
        <div class="mb-4 text-sm text-gray-500">
            Nama: <b>{{ $absen->user->name ?? '-' }}</b><br>
            Tanggal: <b>{{ $absen->tanggal }}</b>
        </div>

        <form method="POST" action="/admin/absensi/{{ $absen->id }}/update" class="space-y-4">
        @csrf

        {{-- JAM KERJA --}}
        <div>
            <label class="block text-sm font-medium mb-1">
                Jam Masuk
            </label>

            <input type="time" name="jam_masuk"
                value="{{ \Carbon\Carbon::parse($absen->jam_masuk)->format('H:i') }}"
                class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200">
        </div>

        {{-- STATUS HADIR --}}
        <div>
            <label class="block text-sm font-medium mb-1">
                Status Kehadiran
            </label>

            <select name="status_hadir"
                class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200">

                <option value="hadir" {{ $absen->status_hadir == 'hadir' ? 'selected' : '' }}>
                    🟢 Hadir
                </option>

                <option value="telat" {{ $absen->status_hadir == 'telat' ? 'selected' : '' }}>
                    🟡 Telat
                </option>

                <option value="alpha" {{ $absen->status_hadir == 'alpha' ? 'selected' : '' }}>
                    🔴 Alpha
                </option>

            </select>
        </div>

        {{-- BUTTON --}}
        <div class="flex gap-3 pt-4">

            <a href="/admin/monitoring"
               class="flex-1 text-center bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 rounded-xl transition">
                ⬅ Kembali
            </a>

            <button
                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition">
                💾 Update Data
            </button>

        </div>

        </form>

    </div>

</div>

</div>
</div>
</x-app-layout>