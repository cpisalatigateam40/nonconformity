@extends('layouts.layout')

@section('content')
<div id="rekapTab" class="fade-in">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <span
                    class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center text-white text-sm mr-3">📊</span>
                Rekap Data Ketidaksesuaian
            </h2>
        </div>

        <!-- Statistik Ringkas -->
        <div class="mb-6 flex flex-wrap gap-4">
            <div class="bg-blue-50 rounded-lg p-4 flex-1 min-w-48">
                <div class="text-2xl font-bold text-blue-600" id="totalTemuan">{{$count['all']}}</div>
                <div class="text-sm text-gray-600">Total Temuan</div>
            </div>
            <div class="bg-red-50 rounded-lg p-4 flex-1 min-w-48">
                <div class="text-2xl font-bold text-red-600" id="openTemuan">{{$count['open']}}</div>
                <div class="text-sm text-gray-600">Status Open</div>
            </div>
            <div class="bg-green-50 rounded-lg p-4 flex-1 min-w-48">
                <div class="text-2xl font-bold text-green-600" id="closedTemuan">{{$count['close']}}</div>
                <div class="text-sm text-gray-600">Status Closed</div>
            </div>
        </div>

        <!-- Statistik Per Departemen -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                <span class="w-6 h-6 bg-purple-500 text-white rounded-full flex items-center justify-center text-xs mr-2">🏢</span>
                Statistik Per Departemen
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" id="departmentStats">
                <!-- Loading spinner -->
                <div id="loadingStats" class="col-span-full flex justify-center items-center py-10">
                    <div class="flex items-center space-x-2 text-gray-500">
                        <svg class="animate-spin h-5 w-5 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                        <span>Memuat statistik departemen...</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter dan Download -->
        <div class="mb-6 flex flex-wrap gap-4 items-center justify-between">
            <div class="flex gap-4 items-center">
                <label for="filterDepartment" class="text-sm font-medium text-gray-700">Filter Departemen:</label>
                <select id="filterDepartment" onchange="updateRekapData()"
                    class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Semua Departemen</option>
                    <option value="BC">BC</option>
                    <option value="SH">SH</option>
                    <option value="FP">FP</option>
                    <option value="SP">SP</option>
                    <option value="WH">WH</option>
                    <option value="ENG">ENG</option>
                    <option value="QC">QC</option>
                    <option value="PGA">PGA</option>
                </select>
            </div>

            <div class="flex gap-2" id="downloadButtons">
                <!-- Tombol download (PDF/Excel) bisa ditambahkan di sini -->
            </div>
        </div>

        <!-- Tabel Rekap -->
        <div class="table-responsive">
            <table class="border-collapse bordered">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">No.
                            Dokumen</th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Tanggal
                            Temuan</th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">
                            Deskripsi</th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Lokasi
                        </th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">PIC
                        </th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Status
                        </th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Waktu
                            Penyelesaian</th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Poin
                            Tambahan</th>
                        <th id="actionHeader"
                            class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700 hidden">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody id="rekapTableBody">
                    @forelse($nonconformities as $index => $item)
                    <tr>
                        <td>{{$item->document_number}}</td>
                        <td>{{$item->found_date}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->location}}</td>
                        <td>{{$item->department->department}}</td>
                        <td>
                            @if ($item->status == '0')
                            <span class="px-2 py-1 rounded-full text-sm bg-red-100 text-red-700">
                                Open
                            </span>
                            @elseif ($item->status == '1')
                            <span class="px-2 py-1 rounded-full text-sm bg-green-100 text-green-700">
                                Close
                            </span>
                            @endif
                        </td>
                        <td>
                            @if($item->completion_time)
                            {{ $item->completion_time }} jam
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            {{$item->point ?? '-'}}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="border border-gray-300 px-4 py-8 text-center text-gray-500">
                            Belum ada data temuan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", async function() {
        const container = document.getElementById('departmentStats');
        const loader = document.getElementById('loadingStats');

        try {
            const res = await fetch('/department-stats');
            const stats = await res.json();

            loader.remove(); // Remove spinner once data is ready
            container.innerHTML = ''; // Clear container

            if (stats.length === 0) {
                container.innerHTML = `
                <div class="col-span-full text-center text-gray-500 py-8">
                    Tidak ada data ketidaksesuaian.
                </div>
            `;
                return;
            }

            stats.forEach(stat => {
                const card = document.createElement('div');
                card.className = 'bg-white border border-gray-200 rounded-lg p-4 shadow-sm transition hover:shadow-md';

                card.innerHTML = `
                <div class="text-center">
                    <h4 class="font-bold text-gray-800 text-lg mb-2">${stat.department}</h4>
                    
                    <!-- Completion Percentage -->
                    <div class="mb-3">
                        <div class="text-lg font-bold ${stat.percentage >= 80 ? 'text-green-600' : stat.percentage >= 60 ? 'text-yellow-600' : 'text-red-600'} mb-1">
                            ${stat.percentage}%
                        </div>
                        <div class="text-xs text-gray-500 mb-2">${stat.closed}/${stat.total} selesai</div>
                        <div class="w-full bg-gray-200 rounded-full h-1.5 mb-3">
                            <div class="h-1.5 rounded-full ${stat.percentage >= 80 ? 'bg-green-500' : stat.percentage >= 60 ? 'bg-yellow-500' : 'bg-red-500'}"
                                style="width: ${stat.percentage}%"></div>
                        </div>
                    </div>

                    <!-- Total Repair Time -->
                    <div class="mb-2">
                        <div class="text-xs text-gray-600 font-medium">Total Waktu Perbaikan</div>
                        <div class="text-sm font-semibold text-blue-600">${Math.round(stat.total_hours / 24)} hari</div>
                    </div>

                    <!-- Total Points -->
                    <div>
                        <div class="text-xs text-gray-600 font-medium">Total Poin Ketidaksesuaian</div>
                        <div class="text-sm font-semibold text-purple-600">${stat.total_poin}</div>
                    </div>
                </div>
            `;
                container.appendChild(card);
            });

        } catch (error) {
            console.error('Error loading stats:', error);
            loader.innerHTML = `
            <div class="col-span-full text-center text-red-500 py-8">
                Gagal memuat data statistik.
            </div>
        `;
        }
    });
</script>
@endpush