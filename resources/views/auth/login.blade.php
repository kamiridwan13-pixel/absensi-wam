<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex">

{{-- LEFT SIDE (BRANDING) --}}
<div class="hidden md:flex w-1/2 bg-gradient-to-br from-blue-600 to-indigo-700 text-white items-center justify-center p-10">

    <div class="text-center max-w-md">
        <h1 class="text-4xl font-bold mb-4">Sistem Absensi</h1>
        <p class="text-lg text-blue-100">
            Kelola absensi, lembur, dan payroll dengan mudah & efisien.
        </p>
    </div>

</div>

{{-- RIGHT SIDE (FORM) --}}
<div class="w-full md:w-1/2 flex items-center justify-center bg-gray-100 p-6">

    <div class="w-full max-w-md">

        <div class="bg-white p-8 rounded-2xl shadow-xl">

            {{-- HEADER --}}
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold">🔐 Login</h2>
                <p class="text-gray-500 text-sm">
                    Masuk ke akun kamu
                </p>
            </div>

            {{-- ERROR --}}
            @if(session('error'))
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm">
                    {{ session('error') }}
                </div>
            @endif

            {{-- FORM --}}
            <form method="POST" action="/login" class="space-y-4">
            @csrf

            {{-- EMAIL --}}
            <div>
                <label class="text-sm font-medium">Email</label>
                <input type="email" name="email"
                    class="w-full mt-1 border p-3 rounded-lg focus:ring-2 focus:ring-blue-400 outline-none transition"
                    placeholder="Masukkan email"
                    required>
            </div>

            {{-- PASSWORD --}}
            <div>
                <label class="text-sm font-medium">Password</label>

                <div class="relative">
                    <input type="password" name="password" id="password"
                        class="w-full mt-1 border p-3 rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
                        placeholder="Masukkan password"
                        required>

                    <button type="button"
                        onclick="togglePassword()"
                        class="absolute right-3 top-3 text-gray-500">
                        👁
                    </button>
                </div>
            </div>

            {{-- BUTTON --}}
            <button
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition">
                Masuk
            </button>

            </form>

        </div>

        {{-- FOOTER --}}
        <p class="text-center text-xs text-gray-400 mt-4">
            © {{ date('Y') }} Sistem Absensi
        </p>

    </div>

</div>

{{-- SCRIPT --}}
<script>
function togglePassword() {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>

</body>
</html>