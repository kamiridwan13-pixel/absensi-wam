<div x-data="{ open: false }">

    {{-- MOBILE TOPBAR --}}
    <div class="md:hidden bg-gray-900 text-white flex items-center justify-between px-4 py-4 shadow-lg">

        <h2 class="text-lg font-bold">
            Admin Panel
        </h2>

        <button
            @click="open = !open"
            class="p-2 rounded-lg hover:bg-gray-700 transition"
        >
            ☰
        </button>

    </div>

    {{-- MOBILE OVERLAY --}}
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
            transform transition-transform duration-300
            md:translate-x-0
        "
        :class="open ? 'translate-x-0' : '-translate-x-full'"
    >

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-6">

            <h2 class="text-2xl font-bold tracking-wide">
                Admin Panel
            </h2>

            {{-- CLOSE MOBILE --}}
            <button
                @click="open = false"
                class="md:hidden text-xl hover:text-red-400 transition"
            >
                ✕
            </button>

        </div>

        {{-- NAVIGATION --}}
        <nav class="space-y-2 text-sm">

            {{-- DASHBOARD --}}
            <a href="/admin"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
               {{ request()->is('admin') ? 'bg-gray-700 shadow-sm' : 'hover:bg-gray-700' }}">
                <span>📊</span>
                <span>Dashboard</span>
            </a>

            {{-- MONITORING --}}
            <a href="/admin/monitoring"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
               {{ request()->is('admin/monitoring*') ? 'bg-gray-700 shadow-sm' : 'hover:bg-gray-700' }}">
                <span>📡</span>
                <span>Monitoring Harian</span>
            </a>

            {{-- KARYAWAN --}}
            <a href="/admin/users"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
               {{ request()->is('admin/users*') ? 'bg-gray-700 shadow-sm' : 'hover:bg-gray-700' }}">
                <span>👥</span>
                <span>Karyawan</span>
            </a>

            {{-- JABATAN --}}
            <a href="/admin/jabatan"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
               {{ request()->is('admin/jabatan*') ? 'bg-gray-700 shadow-sm' : 'hover:bg-gray-700' }}">
                <span>🏷️</span>
                <span>Jabatan</span>
            </a>

            {{-- ABSENSI --}}
            <a href="/admin/absensi"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
               {{ request()->is('admin/absensi*') ? 'bg-gray-700 shadow-sm' : 'hover:bg-gray-700' }}">
                <span>📋</span>
                <span>Approval Absensi</span>
            </a>

            {{-- LEMBUR --}}
            <a href="/admin/lembur"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
               {{ request()->is('admin/lembur*') ? 'bg-gray-700 shadow-sm' : 'hover:bg-gray-700' }}">
                <span>⏱️</span>
                <span>Approval Lembur</span>
            </a>

            {{-- SURVEY --}}
            <a href="/admin/survey-event"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
               {{ request()->is('admin/survey-event*') ? 'bg-gray-700 shadow-sm' : 'hover:bg-gray-700' }}">
                <span>📍</span>
                <span>Survey Event</span>
            </a>

            {{-- PAYROLL --}}
            <a href="/admin/payroll"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
               {{ request()->is('admin/payroll*') ? 'bg-gray-700 shadow-sm' : 'hover:bg-gray-700' }}">
                <span>💰</span>
                <span>Payroll</span>
            </a>

            {{-- SETTING --}}
            <a href="/admin/setting"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
               {{ request()->is('admin/setting*') ? 'bg-gray-700 shadow-sm' : 'hover:bg-gray-700' }}">
                <span>⚙️</span>
                <span>Setting</span>
            </a>

            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}" class="pt-4">
                @csrf

                <button
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-600 transition duration-200 text-left"
                >
                    <span>🚪</span>
                    <span>Logout</span>
                </button>

            </form>

        </nav>

    </aside>

</div>