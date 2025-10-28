<header class="bg-white shadow-lg border-b-4 border-blue-600">
    <div class="container max-w-7xl mx-auto py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center"><span
                        class="text-white font-bold text-lg">G</span>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Ketidaksesuaian Area Produksi</h1>
                    <p class="text-sm text-gray-600">Sistem Monitoring &amp; Perbaikan</p>
                </div>
            </div>
            <div class="flex items-center space-x-4"><span id="currentUser"
                    class="text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded-full"></span>
                @can('can access users')
                <a href="{{ route('users.index') }}"
                    class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm transition-colors flex items-center">
                    <span class="mr-2">👥</span> Manajemen User
                </a>
                @endcan

                <a href="{{ route('logout') }}"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition-colors"
                    onclick="return confirm('Yakin ingin logout?')">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-200"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>
</header>

<div class="container max-w-7xl mx-auto bg-white rounded-2xl mt-7">
    <div class="flex border-b border-gray-200">
        @can('can access temuan')
        <a href="{{ route('finding.create') }}" id="tabInput1"
            class="px-6 py-4 text-sm font-medium {{ request()->routeIs('finding.create') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
            Input Temuan
        </a>
        @endcan

        @can('can access perbaikan')
        <a href="{{ route('repair.create') }}" id="tabInput2"
            class="px-6 py-4 text-sm font-medium {{ request()->routeIs('repair.create') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
            Input Perbaikan
        </a>
        @endcan

        <a href="{{ route('recap.index') }}" id="tabRekap"
            class="px-6 py-4 text-sm font-medium {{ request()->routeIs('recap.index') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
            Rekap Data
        </a>

        <a href="{{ route('analysis.index') }}" id="tabAnalisa"
            class="px-6 py-4 text-sm font-medium {{ request()->routeIs('analysis.index') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
            Analisa Bulanan
        </a>

    </div>
</div>