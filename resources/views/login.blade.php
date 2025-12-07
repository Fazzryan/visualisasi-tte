<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Specimen TTE</title>
    @vite('resources/css/app.css')
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Mesh Gradient Background */
        .mesh-gradient {
            background:
                radial-gradient(at 0% 0%, rgba(59, 130, 246, 0.3) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(96, 165, 250, 0.3) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(147, 197, 253, 0.3) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(191, 219, 254, 0.3) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(219, 234, 254, 0.2) 0px, transparent 50%),
                linear-gradient(180deg, #f0f9ff 0%, #e0f2fe 100%);
            animation: mesh-animation 15s ease infinite;
        }


        /* Glass morphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>

<body class="mesh-gradient min-h-screen flex items-center justify-center p-4">

    <!-- Decorative Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-green-400/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-cyan-400/20 rounded-full blur-3xl"></div>
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-sky-400/10 rounded-full blur-3xl">
        </div>
    </div>

    <div class="w-full max-w-md relative z-10">
        <!-- Logo & Title -->
        <div class="text-center mb-8 float">
            <div class="w-24 h-24  flex items-center justify-center mx-auto mb-6l">
                <img src="{{ asset('assets/img/logo/logokabtasik.png') }}" alt="Logo" class="w-16 h-16">
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Visualisasi TTE</h1>
            <p class="text-gray-600 font-medium">Kabupaten Tasikmalaya</p>
            <div class="w-20 h-1 bg-gradient-to-r from-green-500 to-cyan-500 mx-auto mt-4 rounded-full"></div>
        </div>

        <!-- Login Card -->
        <div class="glass rounded-3xl shadow-2xl p-8">
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Selamat Datang</h2>
                <p class="text-gray-600 text-sm">Silakan login untuk melanjutkan</p>
            </div>

            <!-- Session Status -->
            {{-- @if (session('status'))
                <div class="mb-6 bg-green-50 border border-green-200 rounded-2xl p-4">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-green-600 shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-green-700 text-sm">{{ session('status') }}</p>
                    </div>
                </div>
            @endif --}}
            @include('be.admin.layouts.session')
            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 border border-red-200 rounded-lg bg-red-50">
                    <ul class="pl-5 space-y-1 list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('auth.login') }}" class="space-y-5">
                @csrf
                <!-- nip -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">NIP</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input type="nip" name="nip" value="{{ old('nip') }}" required autofocus
                            class="w-full pl-12 pr-4 py-3.5 bg-white/50 border appearance-none border-slate-300 dark:border-slate-600 placeholder-slate-500 dark:placeholder-slate-400 text-slate-900 dark:text-slate-100 dark:bg-slate-700 rounded-xl focus:outline-none focus:ring-1 focus:ring-green-400 focus:border-green-500 focus:z-10 sm:text-base"
                            placeholder="1234567890">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <div class="relative">

                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>

                        <input type="password" name="password" id="passwordInput" required
                            class="w-full pl-12 pr-12 py-3.5 bg-white/50 border appearance-none border-slate-300 dark:border-slate-600 placeholder-slate-500 dark:placeholder-slate-400 text-slate-900 dark:text-slate-100 dark:bg-slate-700 rounded-xl focus:outline-none focus:ring-1 focus:ring-green-400 focus:border-green-500 focus:z-10 sm:text-base"
                            placeholder="Masukkan password">

                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
                            <svg id="eye-slash-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>

                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="size-5 hidden">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-3.5 bg-gradient-to-r from-green-600 to-cyan-600 text-white rounded-xl hover:from-green-700 hover:to-cyan-700 transition-all duration-200 font-medium shadow-lg shadow-green-500/30 hover:shadow-xl hover:shadow-green-500/40 hover:-translate-y-0.5">
                    Masuk
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <div class="rounded-2xl p-4 inline-block">
                <p class="text-gray-700 text-sm font-medium">Pemerintah Kabupaten Tasikmalaya
                </p>
                <p class="text-gray-600 text-xs mt-1">&copy; {{ date('Y') }} Dishubkominfo </p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua elemen yang dibutuhkan menggunakan ID
            const toggleButton = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('passwordInput');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeSlashIcon = document.getElementById('eye-slash-icon');

            // Tambahkan event listener ke tombol
            toggleButton.addEventListener('click', function() {
                // Cek tipe input saat ini
                const isPassword = passwordInput.getAttribute('type') === 'password';

                // Ubah tipe input
                if (isPassword) {
                    passwordInput.setAttribute('type', 'text');
                } else {
                    passwordInput.setAttribute('type', 'password');
                }

                // Tampilkan/Sembunyikan ikon yang sesuai
                // Menggunakan classList.toggle untuk menambah/menghapus kelas 'hidden'
                eyeIcon.classList.toggle('hidden');
                eyeSlashIcon.classList.toggle('hidden');
            });
        });
    </script>
</body>

</html>
