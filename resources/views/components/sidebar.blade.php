<div x-data="{ open: false }">

    {{-- MOBILE TOPBAR --}}
    <div class="md:hidden bg-gray-900 text-white flex items-center justify-between px-4 py-4 shadow-lg">

        <div>
            <h2 class="text-lg font-bold">
                👤 Karyawan
            </h2>

            <p class="text-xs text-gray-400">
                {{ auth()->user()->name }}
            </p>
        </div>

        <button
            @click="open = !open"
            class="p-2 rounded-lg hover:bg-gray-700 transition"
        >
            ☰
        </button>

    </div>

    {{-- OVERLAY --}}
    <div
        x-show="open"
        x-transition.opacity
        class="fixed inset-0 bg-black/50 z-40 md:hidden"
        @click="open = false"
    ></div>

    {{-- SIDEBAR --}}
    <aside
        class="
            fixed md:static top-0 left-0 z-50
            w-72 md:w-64
            h-screen
            bg-gray-900 text-white
            p-5
            flex flex-col
            transform transition-transform duration-300
            md:translate-x-0
        "
        :class="open ? 'translate-x-0' : '-translate-x-full'"
    >

        {{-- HEADER --}}
        <div class="flex items-start justify-between mb-8">

            <div>
                <h2 class="text-2xl font-bold">
                    👤 Karyawan
                </h2>

                <p class="text-sm text-gray-400 mt-1 break-words">
                    {{ auth()->user()->name }}
                </p>
            </div>

            {{-- CLOSE MOBILE --}}
            <button
                @click="open = false"
                class="md:hidden text-xl hover:text-red-400 transition"
            >
                ✕
            </button>

        </div>

        {{-- MENU --}}
        <nav class="space-y-2 flex-1">

            {{-- DASHBOARD --}}
            <a href="/karyawan"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
               {{ request()->is('karyawan') ? 'bg-blue-600 shadow-sm' : 'hover:bg-gray-700' }}">

                <span>🏠</span>
                <span>Dashboard</span>

            </a>

            {{-- ABSENSI --}}
            <a href="/karyawan/absensi"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
               {{ request()->is('karyawan/absensi') ? 'bg-blue-600 shadow-sm' : 'hover:bg-gray-700' }}">

                <span>📍</span>
                <span>Absensi</span>

            </a>

            {{-- LEMBUR --}}
            <a href="/karyawan/lembur"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
               {{ request()->is('karyawan/lembur') ? 'bg-blue-600 shadow-sm' : 'hover:bg-gray-700' }}">

                <span>⏱</span>
                <span>Lembur</span>

            </a>

            {{-- RIWAYAT --}}
            <a href="/karyawan/riwayat"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
               {{ request()->is('karyawan/riwayat') ? 'bg-blue-600 shadow-sm' : 'hover:bg-gray-700' }}">

                <span>📊</span>
                <span>Riwayat</span>

            </a>

        </nav>

        {{-- LOGOUT --}}
        <div class="mt-6">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl bg-red-600 hover:bg-red-700 transition duration-200 shadow-sm"
                >
                    <span>🚪</span>
                    <span>Logout</span>
                </button>

            </form>

        </div>

    </aside>

</div>