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
                <div class="text-2xl font-bold text-blue-600" id="totalTemuan">0</div>
                <div class="text-sm text-gray-600">Total Temuan</div>
            </div>
            <div class="bg-red-50 rounded-lg p-4 flex-1 min-w-48">
                <div class="text-2xl font-bold text-red-600" id="openTemuan">0</div>
                <div class="text-sm text-gray-600">Status Open</div>
            </div>
            <div class="bg-green-50 rounded-lg p-4 flex-1 min-w-48">
                <div class="text-2xl font-bold text-green-600" id="closedTemuan">0</div>
                <div class="text-sm text-gray-600">Status Closed</div>
            </div>
        </div>

        <!-- Statistik Per Departemen -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Statistik Per Departemen</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" id="departmentStats">
                <!-- Akan diisi lewat JS -->
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
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
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
                    <tr>
                        <td colspan="9" class="border border-gray-300 px-4 py-8 text-center text-gray-500">
                            Belum ada data temuan
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection