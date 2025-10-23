<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Ketidaksesuaian Area Produksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    body {
        box-sizing: border-box;
    }

    .fade-in {
        animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>
</head>

<body class="h-full bg-gradient-to-br from-blue-50 to-indigo-100 font-sans">
    <div id="loginScreen"
        class="fixed inset-0 bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 flex items-center justify-center z-50">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=" 60 height="60" viewbox="0 0 60 60"
            xmlns="http://www.w3.org/2000/svg" %3e%3cg fill="none" fill-rule="evenodd" fill-opacity="0.05" %3e%3ccircle
            cx="30" cy="30" r="2" %3e%3c g%3e%3c svg%3e)] opacity-30></div>
        <div
            class="relative bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 p-8 w-full max-w-lg mx-4">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <div class="relative mb-6">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto shadow-lg">
                        <span class="text-white font-bold text-lg">CPI</span>
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-6 h-6 bg-green-500 rounded-full border-2 border-white">
                    </div>
                </div>
                <h1
                    class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-2">
                    Sistem Login</h1>
                <p class="text-gray-500 text-sm font-medium">Ketidaksesuaian Area Produksi</p>
                <p class="text-gray-400 text-xs font-medium mt-1">PT. Charoen Pokphand Indonesia - Salatiga</p>
            </div><!-- Login Form -->


            <form action="{{route('login')}}" method="post" class="space-y-5">
                @csrf
                <div class="space-y-4 mb-7">
                    <div>
                        <label for="username" class="block text-sm font-semibold text-gray-700 mb-3">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input id="login" name="login" type="text" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white/80 backdrop-blur-sm"
                                placeholder="Masukkan username">
                        </div>
                    </div>
                    <div style="margin-bottom: 30px !important;">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-3">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white/80 backdrop-blur-sm"
                                placeholder="Masukkan password">
                            <button type="button" onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                <svg id="eyeIcon" class="h-5 w-5 text-gray-400 hover:text-gray-600 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div id="loginError"
                        class="{{ session('loginError') ? '' : 'hidden' }} bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm font-medium">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ session('loginError') }}</span>
                        </div>
                    </div>
                </div>
                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 transform hover:scale-[1.02] shadow-lg hover:shadow-xl mt-10">
                    <span class="flex items-center justify-center space-x-2"> <span>Masuk Sistem</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                            </path>
                        </svg></span> </button>


            </form>

            <!-- Password Reference - Collapsible -->
            <!-- <div class="mt-6"><button onclick="togglePasswordRef()"
                    class="w-full text-left p-3 bg-blue-50/50 hover:bg-blue-50 border border-blue-100 rounded-xl transition-all duration-200">
                    <div class="flex items-center justify-between"><span class="text-sm font-medium text-blue-700">📋
                            Lihat Password Default</span>
                        <svg id="passwordRefIcon"
                            class="w-4 h-4 text-blue-600 transform transition-transform duration-200" fill="none"
                            stroke="currentColor" viewbox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </div>
                </button>
                <div id="passwordRefContent"
                    class="hidden mt-2 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-xl">
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div class="space-y-1">
                            <p class="font-semibold text-blue-800 mb-2">Input &amp; Admin:</p>
                            <p class="text-blue-700">• User A: <code class="bg-white px-1 rounded">usera123</code></p>
                            <p class="text-blue-700">• Manager: <code class="bg-white px-1 rounded">manager123</code>
                            </p>
                            <p class="text-blue-700">• Super Admin: <code class="bg-white px-1 rounded">admin123</code>
                            </p>
                        </div>
                        <div class="space-y-1">
                            <p class="font-semibold text-blue-800 mb-2">Departemen:</p>
                            <p class="text-blue-700">• BC: <code class="bg-white px-1 rounded">bc123</code> • SH: <code
                                    class="bg-white px-1 rounded">sh123</code></p>
                            <p class="text-blue-700">• FP: <code class="bg-white px-1 rounded">fp123</code> • SP: <code
                                    class="bg-white px-1 rounded">sp123</code></p>
                            <p class="text-blue-700">• WH: <code class="bg-white px-1 rounded">wh123</code> • ENG: <code
                                    class="bg-white px-1 rounded">eng123</code></p>
                            <p class="text-blue-700">• QC: <code class="bg-white px-1 rounded">qc123</code> • PGA: <code
                                    class="bg-white px-1 rounded">pga123</code></p>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

        <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.974 9.974 0 013.08-4.419M15 12a3 3 0 11-6 0 3 3 0 016 0zM19.13 19.13L4.87 4.87" />
                `;
            } else {
                passwordField.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
            }
        }
        </script>
</body>