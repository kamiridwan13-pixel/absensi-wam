<div class="w-64 bg-gray-900 text-white min-h-screen p-5">

    <h2 class="text-2xl font-bold mb-6">Admin Panel</h2>

    <nav class="space-y-2 text-sm">

        {{-- DASHBOARD --}}
        <a href="/admin"
           class="block px-4 py-2 rounded {{ request()->is('admin') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
            📊 Dashboard
        </a>
         {{-- 🔥 MONITORING HARIAN --}}
        <a href="/admin/monitoring"
           class="block px-4 py-2 rounded {{ request()->is('admin/monitoring*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
            📡 Monitoring Harian
        </a>

        {{-- KARYAWAN --}}
        <a href="/admin/users"
           class="block px-4 py-2 rounded {{ request()->is('admin/users*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
            👥 Karyawan
        </a>

        {{-- JABATAN --}}
        <a href="/admin/jabatan"
           class="block px-4 py-2 rounded {{ request()->is('admin/jabatan*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
            🏷️ Jabatan
        </a>

        {{-- ABSENSI --}}
        <a href="/admin/absensi"
           class="block px-4 py-2 rounded {{ request()->is('admin/absensi*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
            📋 Approval Absensi
        </a>

        {{-- LEMBUR --}}
        <a href="/admin/lembur"
           class="block px-4 py-2 rounded {{ request()->is('admin/lembur*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
            ⏱️ Approval Lembur
        </a>

        {{-- SURVEY EVENT --}}
        <a href="/admin/survey-event"
           class="block px-4 py-2 rounded {{ request()->is('admin/survey-event*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
            📍 Survey Event
        </a>

        {{-- PAYROLL --}}
        <a href="/admin/payroll"
           class="block px-4 py-2 rounded {{ request()->is('admin/payroll*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
            💰 Payroll
        </a>
        

        {{-- SETTING --}}
        <a href="/admin/setting"
           class="block px-4 py-2 rounded {{ request()->is('admin/setting*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
            ⚙️ Setting
        </a>

        {{-- LOGOUT --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full text-left px-4 py-2 rounded hover:bg-red-600 mt-4">
                🚪 Logout
            </button>
        </form>

    </nav>
</div>