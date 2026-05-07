<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    @vite('resources/css/app.css')

</head>

<body class="min-h-screen flex flex-col md:flex-row bg-gray-100 overflow-x-hidden">

    {{-- LEFT SIDE (BRANDING) --}}
    <div class="hidden md:flex w-1/2 bg-gradient-to-br from-blue-600 to-indigo-700 text-white items-center justify-center p-10">

        <div class="text-center max-w-md">

            <h1 class="text-4xl font-bold mb-4 leading-tight">
                Sistem Absensi
            </h1>

            <p class="text-lg text-blue-100 leading-relaxed">
                Kelola absensi, lembur, dan payroll dengan mudah & efisien.
            </p>

        </div>

    </div>

    {{-- MOBILE BRANDING --}}
    <div class="md:hidden bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-6 py-8 text-center shadow-lg">

        <h1 class="text-3xl font-bold mb-2">
            Sistem Absensi
        </h1>

        <p class="text-sm text-blue-100 leading-relaxed">
            Kelola absensi, lembur, dan payroll dengan mudah.
        </p>

    </div>

    {{-- RIGHT SIDE (FORM) --}}
    <div class="w-full md:w-1/2 flex items-center justify-center p-4 md:p-6 flex-1">

        <div class="w-full max-w-md">

            {{-- CARD --}}
            <div class="bg-white p-5 md:p-8 rounded-3xl shadow-xl border border-gray-100">

                {{-- HEADER --}}
                <div class="text-center mb-6">

                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                        🔐 Login
                    </h2>

                    <p class="text-gray-500 text-sm md:text-base mt-2">
                        Masuk ke akun kamu
                    </p>

                </div>

                {{-- ERROR --}}
                @if(session('error'))

                    <div class="mb-4 p-4 bg-red-100 border border-red-200 text-red-700 rounded-2xl text-sm break-words">
                        ❌ {{ session('error') }}
                    </div>

                @endif

                {{-- FORM --}}
                <form method="POST"
                      action="/login"
                      class="space-y-5">

                    @csrf

                    {{-- EMAIL --}}
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none transition text-sm md:text-base"
                            placeholder="Masukkan email"
                            required
                        >

                    </div>

                    {{-- PASSWORD --}}
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Password
                        </label>

                        <div class="relative">

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none transition text-sm md:text-base pr-12"
                                placeholder="Masukkan password"
                                required
                            >

                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 transition"
                            >
                                👁
                            </button>

                        </div>

                    </div>

                    {{-- BUTTON --}}
                    <button
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition duration-300 shadow-sm text-sm md:text-base"
                    >
                        Masuk
                    </button>

                </form>

            </div>

            {{-- FOOTER --}}
            <p class="text-center text-xs text-gray-400 mt-5">
                © {{ date('Y') }} Sistem Absensi
            </p>

        </div>

    </div>

    {{-- SCRIPT --}}
    <script>

        function togglePassword() {

            const input = document.getElementById('password');

            input.type = input.type === 'password'
                ? 'text'
                : 'password';
        }

    </script>

</body>

</html>