@extends('layouts.layout')

@section('content')
<style>
.analisa-table, .analisa-table th, .analisa-table td {
  border: 1px solid #d1d5db !important;
  border-collapse: collapse !important;
}
</style>

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
                <table class="w-full analisa-table">
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
                            <td class="text-center">{{$department->abbrivation}}</td>
                            <td class="text-center">{{$department->total_findings}}</td>
                            <td class="text-center">{{$department->closed_findings}}</td>
                            <td class="text-center px-4 py-3">
                                @php
                                $percent = $department->percentage_closed;
                                if ($percent < 40) { $color='bg-red-100 text-red-700' ; } elseif ($percent < 70) {
                                    $color='bg-yellow-100 text-yellow-700' ; } elseif ($percent < 90) {
                                    $color='bg-green-100 text-green-700' ; } else {
                                    $color='bg-emerald-100 text-emerald-700' ; } @endphp <span
                                    class="px-3 py-1 text-sm font-semibold rounded-full {{ $color }}">
                                    {{ $percent }}%
                                    </span>
                            </td>

                            <td class="text-center px-4 py-3">{{$department->totalCompletionDays}} hari</td>
                            <td class="text-center px-4 py-3">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold"
                                    style="background-color: #FAF5FF; color: #6B21A8;">
                                    {{ $department->totalPoints ?? '0' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if($departments->count() > 0 && $departments->sum('total_findings') > 0)
            <!-- Chart Area -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Ranking Departemen Terbaik -->
                @php
                    $ranked = $departments->sortByDesc('percentage_closed')->take(5);
                @endphp
                @if($ranked->count() > 0)
                <div class="bg-gray-50 rounded-lg p-6">
                    <h4 class="text-md font-semibold text-gray-800 mb-4">Ranking Departemen Terbaik</h4>
                    <div id="rankingChart" class="space-y-3">
                        @foreach($ranked as $dept)
                            @php
                                switch ($loop->iteration) {
                                    case 1:
                                        $icon = '🥇';
                                        $bg = 'bg-yellow-100';
                                        $color = 'text-yellow-600';
                                        break;
                                    case 2:
                                        $icon = '🥈';
                                        $bg = 'bg-gray-200';
                                        $color = 'text-gray-600';
                                        break;
                                    case 3:
                                        $icon = '🥉';
                                        $bg = 'bg-amber-200';
                                        $color = 'text-amber-700';
                                        break;
                                    default:
                                        $icon = '';
                                        $bg = 'bg-gray-100';
                                        $color = 'text-gray-400';
                                        break;
                                }
                            @endphp

                            <div class="flex items-center justify-between bg-white border border-gray-200 rounded-lg px-4 py-3 shadow-sm">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 flex items-center justify-center rounded-full {{ $bg }} {{ $color }}">
                                        {{ $icon }}
                                    </div>
                                    <div>
                                        <h5 class="font-semibold text-gray-800">{{ $dept->abbrivation }}</h5>
                                        <p class="text-sm text-gray-500">
                                            {{ $dept->percentage_closed }}% selesai • 
                                            Rata-rata {{ round(($dept->totalPoints ?? 0) / max($dept->total_findings,1),1) }} poin/temuan
                                        </p>
                                    </div>
                                </div>
                                <div class="text-sm text-gray-600 text-right">
                                    {{ $dept->closed_findings }}/{{ $dept->total_findings }}<br>
                                    <span class="text-xs text-gray-400">{{ $dept->totalPoints ?? 0 }} total poin</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif


                <!-- Tingkat Penyelesaian per Departemen -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h4 class="text-md font-semibold text-gray-800 mb-4">Tingkat Penyelesaian per Departemen</h4>
                    @if($departments->count() > 0)
                    <div id="completionChart" class="space-y-4">
                        @foreach($departments as $dept)
                            @if($dept->total_findings > 0)
                            <div>
                                <div class="flex justify-between mb-1 text-sm text-gray-700">
                                    <span class="font-medium">{{ $dept->abbrivation }}</span>
                                    <span>{{ $dept->percentage_closed }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-green-500 h-3 rounded-full transition-all duration-700" 
                                        style="width: {{ $dept->percentage_closed }}%">
                                    </div>
                                </div>
                                <div class="text-xs text-right text-gray-400 mt-1">
                                    {{ $dept->closed_findings }}/{{ $dept->total_findings }}
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    @else
                        <p class="text-sm text-gray-500">Tidak ada data departemen untuk ditampilkan.</p>
                    @endif
                </div>
            </div>
        @endif


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

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('#completionChart .bg-green-500').forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0';
            setTimeout(() => { bar.style.width = width; }, 200);
        });
    });
</script>
@endsection
