<div class="w-64 bg-gray-900 text-white min-h-screen p-5 flex flex-col">

    {{-- HEADER --}}
    <div class="mb-8">
        <h2 class="text-2xl font-bold">👤 Karyawan</h2>
        <p class="text-sm text-gray-400">
            {{ auth()->user()->name }}
        </p>
    </div>

    {{-- MENU --}}
    <nav class="space-y-2 flex-1">

        {{-- DASHBOARD --}}
        <a href="/karyawan"
           class="flex items-center gap-3 px-4 py-2 rounded-lg transition
           {{ request()->is('karyawan') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
            🏠 Dashboard
        </a>

        {{-- ABSENSI --}}
        <a href="/karyawan/absensi"
           class="flex items-center gap-3 px-4 py-2 rounded-lg transition
           {{ request()->is('karyawan/absensi') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
            📍 Absensi
        </a>

        {{-- LEMBUR --}}
        <a href="/karyawan/lembur"
           class="flex items-center gap-3 px-4 py-2 rounded-lg transition
           {{ request()->is('karyawan/lembur') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
            ⏱ Lembur
        </a>

        {{-- RIWAYAT --}}
        <a href="/karyawan/riwayat"
           class="flex items-center gap-3 px-4 py-2 rounded-lg transition
           {{ request()->is('karyawan/riwayat') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
            📊 Riwayat
        </a>

    </nav>

    {{-- LOGOUT --}}
    <div class="mt-6">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full flex items-center gap-3 px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 transition">
                🚪 Logout
            </button>
        </form>
    </div>

</div>