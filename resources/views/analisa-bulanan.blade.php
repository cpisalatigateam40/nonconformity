<div id="analisaTab" class="hidden fade-in">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center"><span class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center text-white text-sm mr-3">📈</span> Analisa Hasil Temuan Bulanan</h2>
        </div><!-- Filter Periode -->
        <div class="mb-6 flex flex-wrap gap-4 items-center">
            <div class="flex gap-2 items-center"><label for="filterPeriode" class="text-sm font-medium text-gray-700">Periode:</label> <select id="filterPeriode" onchange="togglePeriodeFilter()" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="bulanan">Bulanan</option>
                    <option value="tahunan">Tahunan</option>
                </select>
            </div>
            <div id="filterBulananContainer" class="flex gap-2 items-center"><label for="filterBulan" class="text-sm font-medium text-gray-700">Bulan:</label> <select id="filterBulan" onchange="updateAnalisaBulanan()" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            <div class="flex gap-2 items-center"><label for="filterTahun" class="text-sm font-medium text-gray-700">Tahun:</label> <select id="filterTahun" onchange="updateAnalisaBulanan()" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"> <!-- Years will be populated by JavaScript --> </select>
            </div>
        </div><!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-blue-50 rounded-lg p-4">
                <div class="text-2xl font-bold text-blue-600" id="totalTemuanBulan">
                    0
                </div>
                <div class="text-sm text-gray-600">
                    Total Temuan
                </div>
            </div>
            <div class="bg-green-50 rounded-lg p-4">
                <div class="text-2xl font-bold text-green-600" id="totalClosedBulan">
                    0
                </div>
                <div class="text-sm text-gray-600">
                    Selesai
                </div>
            </div>
            <div class="bg-red-50 rounded-lg p-4">
                <div class="text-2xl font-bold text-red-600" id="totalOpenBulan">
                    0
                </div>
                <div class="text-sm text-gray-600">
                    Belum Selesai
                </div>
            </div>
            <div class="bg-purple-50 rounded-lg p-4">
                <div class="text-2xl font-bold text-purple-600" id="totalPoinBulan">
                    0
                </div>
                <div class="text-sm text-gray-600">
                    Total Poin Ketidaksesuaian
                </div>
            </div>
        </div><!-- Analisa Per Area -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Analisa Per Departemen</h3>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Departemen</th>
                            <th class="border border-gray-300 px-4 py-3 text-center text-sm font-medium text-gray-700">Total Temuan</th>
                            <th class="border border-gray-300 px-4 py-3 text-center text-sm font-medium text-gray-700">Temuan Terselesaikan</th>
                            <th class="border border-gray-300 px-4 py-3 text-center text-sm font-medium text-gray-700">% Selesai</th>
                            <th class="border border-gray-300 px-4 py-3 text-center text-sm font-medium text-gray-700">Total Waktu Penyelesaian (Hari)</th>
                            <th class="border border-gray-300 px-4 py-3 text-center text-sm font-medium text-gray-700">Total Poin Ketidaksesuaian</th>
                        </tr>
                    </thead>
                    <tbody id="analisaTableBody"><!-- Data will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div><!-- Chart Area (Visual representation) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6"><!-- Ranking Chart -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-md font-semibold text-gray-800 mb-4">Ranking Departemen Terbaik</h4>
                <div id="rankingChart" class="space-y-3"><!-- Chart will be populated by JavaScript -->
                </div>
            </div><!-- Completion Rate Chart -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-md font-semibold text-gray-800 mb-4">Tingkat Penyelesaian per Departemen</h4>
                <div id="completionChart" class="space-y-3"><!-- Chart will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>