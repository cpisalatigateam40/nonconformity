<div id="loginScreen" class="fixed inset-0 bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 flex items-center justify-center z-50"><!-- Background Pattern -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=" 60 height="60" viewbox="0 0 60 60" xmlns="http://www.w3.org/2000/svg" %3e%3cg fill="none" fill-rule="evenodd" fill-opacity="0.05" %3e%3ccircle cx="30" cy="30" r="2" %3e%3c g%3e%3c svg%3e)] opacity-30></div>
    <div class="relative bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 p-8 w-full max-w-lg mx-4"><!-- Header Section -->
        <div class="text-center mb-8">
            <div class="relative mb-6">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto shadow-lg"><span class="text-white font-bold text-lg">CPI</span>
                </div>
                <div class="absolute -bottom-2 -right-2 w-6 h-6 bg-green-500 rounded-full border-2 border-white"></div>
            </div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-2">Sistem Login</h1>
            <p class="text-gray-500 text-sm font-medium">Ketidaksesuaian Area Produksi</p>
            <p class="text-gray-400 text-xs font-medium mt-1">PT. Charoen Pokphand Indonesia - Salatiga</p>
        </div><!-- Login Form -->
        <form onsubmit="handleLogin(event)" class="space-y-5">
            <div class="space-y-4">
                <div><label for="loginUser" class="block text-sm font-semibold text-gray-700 mb-2">Pilih User</label>
                    <div class="relative"><select id="loginUser" required class="w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50/50 transition-all duration-200 appearance-none">
                            <option value="">-- Pilih User --</option>
                            <option value="USER_A">👤 User A (Input Temuan)</option>
                            <option value="BC">🔧 BC (Perbaikan)</option>
                            <option value="SH">🔧 SH (Perbaikan)</option>
                            <option value="FP">🔧 FP (Perbaikan)</option>
                            <option value="SP">🔧 SP (Perbaikan)</option>
                            <option value="WH">🔧 WH (Perbaikan)</option>
                            <option value="ENG">🔧 ENG (Perbaikan)</option>
                            <option value="QC">🔧 QC (Perbaikan)</option>
                            <option value="PGA">🔧 PGA (Perbaikan)</option>
                            <option value="MANAGER">👔 Manager (View Only)</option>
                            <option value="SUPER_ADMIN">⚡ Super Admin</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div><label for="loginPassword" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <div class="relative"><input type="password" id="loginPassword" required class="w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50/50 transition-all duration-200" placeholder="Masukkan password...">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div><button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 transform hover:scale-[1.02] shadow-lg hover:shadow-xl"> <span class="flex items-center justify-center space-x-2"> <span>Masuk Sistem</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg></span> </button>
        </form><!-- Password Reference - Collapsible -->
        <div class="mt-6"><button onclick="togglePasswordRef()" class="w-full text-left p-3 bg-blue-50/50 hover:bg-blue-50 border border-blue-100 rounded-xl transition-all duration-200">
                <div class="flex items-center justify-between"><span class="text-sm font-medium text-blue-700">📋 Lihat Password Default</span>
                    <svg id="passwordRefIcon" class="w-4 h-4 text-blue-600 transform transition-transform duration-200" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </button>
            <div id="passwordRefContent" class="hidden mt-2 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-xl">
                <div class="grid grid-cols-2 gap-2 text-xs">
                    <div class="space-y-1">
                        <p class="font-semibold text-blue-800 mb-2">Input &amp; Admin:</p>
                        <p class="text-blue-700">• User A: <code class="bg-white px-1 rounded">usera123</code></p>
                        <p class="text-blue-700">• Manager: <code class="bg-white px-1 rounded">manager123</code></p>
                        <p class="text-blue-700">• Super Admin: <code class="bg-white px-1 rounded">admin123</code></p>
                    </div>
                    <div class="space-y-1">
                        <p class="font-semibold text-blue-800 mb-2">Departemen:</p>
                        <p class="text-blue-700">• BC: <code class="bg-white px-1 rounded">bc123</code> • SH: <code class="bg-white px-1 rounded">sh123</code></p>
                        <p class="text-blue-700">• FP: <code class="bg-white px-1 rounded">fp123</code> • SP: <code class="bg-white px-1 rounded">sp123</code></p>
                        <p class="text-blue-700">• WH: <code class="bg-white px-1 rounded">wh123</code> • ENG: <code class="bg-white px-1 rounded">eng123</code></p>
                        <p class="text-blue-700">• QC: <code class="bg-white px-1 rounded">qc123</code> • PGA: <code class="bg-white px-1 rounded">pga123</code></p>
                    </div>
                </div>
            </div>
        </div>
    </div>