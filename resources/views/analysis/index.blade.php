@extends('layouts.layout')

@section('content')
<div id="analisaTab">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <span class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center text-white text-sm mr-3">📈</span>
                Analisa Hasil Temuan Bulanan
            </h2>
        </div>

        <!-- Filter Periode -->
        <div class="mb-6 flex flex-wrap gap-4 items-center">
            <div class="flex gap-2 items-center">
                <label for="filterPeriode" class="text-sm font-medium text-gray-700">Periode:</label>
                <select id="filterPeriode"
                    onchange="togglePeriodeFilter()"
                    class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="bulanan" {{ request('periode', 'bulanan') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                    <option value="tahunan" {{ request('periode') == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                </select>
            </div>

            <div id="filterBulananContainer" class="flex gap-2 items-center {{ request('periode') == 'tahunan' ? 'hidden' : 'flex' }}">
                <label for="filterBulan" class="text-sm font-medium text-gray-700">Bulan:</label>
                <select id="filterBulan"
                    onchange="updateAnalisaFilter()"
                    class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @foreach(range(1, 12) as $month)
                        <option value="{{ $month }}" {{ request('bulan', now()->month) == $month ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2 items-center">
                <label for="filterTahun" class="text-sm font-medium text-gray-700">Tahun:</label>
                <select id="filterTahun"
                    onchange="updateAnalisaFilter()"
                    class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <!-- Populate dynamically -->
                </select>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-blue-50 rounded-lg p-4">
                <div class="text-2xl font-bold text-blue-600" id="totalTemuanBulan">
                    {{$count['all']}}
                </div>
                <div class="text-sm text-gray-600">Total Temuan</div>
            </div>
            <div class="bg-green-50 rounded-lg p-4">
                <div class="text-2xl font-bold text-green-600" id="totalClosedBulan">
                    {{$count['close']}}
                </div>
                <div class="text-sm text-gray-600">Selesai</div>
            </div>
            <div class="bg-red-50 rounded-lg p-4">
                <div class="text-2xl font-bold text-red-600" id="totalOpenBulan">
                    {{$count['open']}}
                </div>
                <div class="text-sm text-gray-600">Belum Selesai</div>
            </div>
            <div class="bg-purple-50 rounded-lg p-4">
                <div class="text-2xl font-bold text-purple-600" id="totalPoinBulan">
                    {{$count['point']}}
                </div>
                <div class="text-sm text-gray-600">Total Poin Ketidaksesuaian</div>
            </div>
        </div>

        <!-- Analisa Per Area -->
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
                    <tbody id="analisaTableBody">
                        @foreach($departments as $department)
                        <tr>
                            <td>{{$department->abbrivation}}</td>
                            <td class="text-center">{{$department->total_findings}}</td>
                            <td class="text-center">{{$department->closed_findings}}</td>
                            <td class="text-center">{{$department->percentage_closed}}%</td>
                            <td class="text-center">{{$department->totalCompletionDays}} hari</td>
                            <td class="text-center">{{$department->totalPoints ?? '0'}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Chart Area (optional visualization) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-md font-semibold text-gray-800 mb-4">Ranking Departemen Terbaik</h4>
                <div id="rankingChart" class="space-y-3"></div>
            </div>
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-md font-semibold text-gray-800 mb-4">Tingkat Penyelesaian per Departemen</h4>
                <div id="completionChart" class="space-y-3"></div>
            </div>
        </div>
    </div>
</div>

<script>
    // populate year dropdown dynamically
    document.addEventListener("DOMContentLoaded", function () {
        const selectYear = document.getElementById("filterTahun");
        const currentYear = new Date().getFullYear();
        const selectedYear = {{ request('tahun', now()->year) }};

        for (let y = currentYear; y >= currentYear - 5; y--) {
            const option = document.createElement("option");
            option.value = y;
            option.text = y;
            if (y === selectedYear) option.selected = true;
            selectYear.appendChild(option);
        }
    });

    // toggle bulan filter visibility
    function togglePeriodeFilter() {
        const periode = document.getElementById("filterPeriode").value;
        const bulananContainer = document.getElementById("filterBulananContainer");

        if (periode === "tahunan") {
            bulananContainer.style.display = "none";
        } else {
            bulananContainer.style.display = "flex";
        }
        updateAnalisaFilter();
    }

    // reload the page with selected filters
    function updateAnalisaFilter() {
        const periode = document.getElementById("filterPeriode").value;
        const bulan = document.getElementById("filterBulan").value;
        const tahun = document.getElementById("filterTahun").value;

        let query = `?periode=${periode}&tahun=${tahun}`;
        if (periode === "bulanan") query += `&bulan=${bulan}`;

        window.location.href = "{{ route('analysis.index') }}" + query;
    }
</script>
@endsection
