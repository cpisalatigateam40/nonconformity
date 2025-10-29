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
                <span
                    class="w-6 h-6 bg-purple-500 text-white rounded-full flex items-center justify-center text-xs mr-2">🏢</span>
                Statistik Per Departemen
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" id="departmentStats">
                <!-- Loading spinner -->
                <div id="loadingStats" class="col-span-full flex justify-center items-center py-10">
                    <div class="flex items-center space-x-2 text-gray-500">
                        <svg class="animate-spin h-5 w-5 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                        <span>Memuat statistik departemen...</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter dan Download -->
        @can('can choose departments')
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
        @endcan

        <!-- Tabel Rekap -->
        <div class="table-responsive">
            <table class="min-w-full border border-gray-300 border-collapse">
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
                            class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody id="rekapTableBody">
                    @forelse($nonconformities as $index => $item)
                    <tr>
                        @can('can access perbaikan')
                        @if($item->status == '0')
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('repair.create', ['uuid' => $item->uuid]) }}"
                                class="text-blue-600 hover:underline">
                                {{ $item->document_number }}
                            </a>
                        </td>
                        @else
                        <td class="border border-gray-300 px-4 py-2 text-gray-500">
                            {{ $item->document_number }}
                        </td>
                        @endif
                        @else
                        <td class="border border-gray-300 px-4 py-2 text-gray-500">
                            {{ $item->document_number }}
                        </td>
                        @endcan
                        <td class="border border-gray-300 px-4 py-2">{{ $item->found_date }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->description }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->location }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->department->department }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if ($item->status == '0')
                            <span class="px-2 py-1 rounded-full text-sm bg-red-100 text-red-700">Open</span>
                            @elseif ($item->status == '1')
                            <span class="px-2 py-1 rounded-full text-sm bg-green-100 text-green-700">Close</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if($item->completion_time)
                            {{ $item->completion_time }} jam
                            @else
                            -
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->point ?? '-' }}</td>
                        <td class="border px-4 py-2 flex gap-2">
                            <button
                                class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1 rounded detail-btn"
                                data-uuid="{{ $item->uuid }}">
                                Detail
                            </button>
                            @can('can delete data')
                            <button
                                onclick="deleteData('{{ $item->uuid }}')"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                Hapus
                            </button>
                            @endcan
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
        <!-- Detail Modal -->
        <div id="detailModal"
            class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
            <div class="bg-white w-full max-w-3xl rounded-xl shadow-lg p-6 relative">
                <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    ✕
                </button>
                <h2 class="text-xl font-semibold mb-4">Detail Temuan</h2>

                <div id="detailContent" class="space-y-4 text-sm text-gray-800">
                    <div class="grid grid-cols-2 gap-4">
                        <div><strong>No. Dokumen:</strong> <span id="detailDocumentNumber"></span></div>
                        <div><strong>Tanggal Temuan:</strong> <span id="detailFoundDate"></span></div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div><strong>PIC:</strong> <span id="detailDepartment"></span></div>
                        <div><strong>Lokasi:</strong> <span id="detailLocation"></span></div>
                    </div>

                    <div>
                        <strong>Deskripsi:</strong>
                        <p id="detailDescription" class="mt-1"></p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <strong>Bukti Temuan:</strong>
                            <div class="mt-2">
                                <img id="detailFindingImg" src="" alt="Bukti Temuan"
                                    class="rounded-md border w-full object-cover">
                            </div>
                        </div>
                        <div>
                            <strong>Bukti Perbaikan:</strong>
                            <div class="mt-2">
                                <img id="detailCorrectiveImg" src="" alt="Bukti Perbaikan"
                                    class="rounded-md border w-full object-cover">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", async function() {
        const container = document.getElementById('departmentStats');
        const loader = document.getElementById('loadingStats');

        // ========== LOAD DEPARTMENT STATS ==========
        try {
            const res = await fetch('/department-stats');
            const stats = await res.json();

            loader.remove();
            container.innerHTML = '';

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
                    <div class="mb-3">
                        <div class="text-lg font-bold ${stat.percentage >= 80 ? 'text-green-600' : stat.percentage >= 60 ? 'text-yellow-600' : 'text-red-600'} mb-1">
                            ${stat.percentage}%
                        </div>
                        <div class="text-xs text-gray-500 mb-2">${stat.closed}/${stat.total} selesai</div>
                        <div class="w-full bg-gray-200 rounded-full h-1.5 mb-3">
                            <div class="h-1.5 rounded-full ${stat.percentage >= 80 ? 'bg-green-500' : stat.percentage >= 60 ? 'bg-yellow-500' : 'bg-red-500'}" style="width: ${stat.percentage}%"></div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="text-xs text-gray-600 font-medium">Total Waktu Perbaikan</div>
                        <div class="text-sm font-semibold text-blue-600">${Math.round(stat.total_hours / 24)} hari</div>
                    </div>
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

        // ========== FILTER TABLE BY DEPARTMENT ==========
        window.updateRekapData = async function() {
            const dept = document.getElementById('filterDepartment').value;
            const tbody = document.getElementById('rekapTableBody');

            tbody.innerHTML = `
            <tr>
                <td colspan="9" class="text-center py-6 text-gray-500">Memuat data...</td>
            </tr>
        `;

            try {
                const res = await fetch(`/recap/filter?department=${dept}`);
                const data = await res.json();

                if (data.length === 0) {
                    tbody.innerHTML = `
                    <tr>
                        <td colspan="9" class="text-center py-6 text-gray-500">Tidak ada data untuk departemen ini.</td>
                    </tr>
                `;
                    return;
                }

                tbody.innerHTML = '';
                data.forEach(item => {
                    tbody.innerHTML += `
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">${item.document_number}</td>
                        <td class="border border-gray-300 px-4 py-2">${item.found_date}</td>
                        <td class="border border-gray-300 px-4 py-2">${item.description}</td>
                        <td class="border border-gray-300 px-4 py-2">${item.location}</td>
                        <td class="border border-gray-300 px-4 py-2">${item.department.department}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            ${item.status == 0
                                ? `<span class="px-2 py-1 rounded-full text-sm bg-red-100 text-red-700">Open</span>`
                                : `<span class="px-2 py-1 rounded-full text-sm bg-green-100 text-green-700">Close</span>`
                            }
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            ${item.completion_time ? item.completion_time + ' jam' : '-'}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">${item.point ?? '-'}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1 rounded-md detail-btn"
                                data-uuid="${item.uuid}">Detail</button>
                        </td>
                    </tr>
                `;
                });

                bindDetailButtons();

            } catch (err) {
                console.error(err);
                tbody.innerHTML = `
                <tr>
                    <td colspan="9" class="text-center py-6 text-red-500">Gagal memuat data.</td>
                </tr>
            `;
            }
        };

        // ========== DELETE DATA ==========
        window.deleteData = async function(uuid) {
            if (!confirm('Yakin ingin menghapus data ini?')) return;

            try {
                const res = await fetch(`/recap/${uuid}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });

                const data = await res.json();
                alert(data.message);
                if (data.status === 'success') location.reload();
            } catch (error) {
                alert('Terjadi kesalahan saat menghapus data.');
                console.error(error);
            }
        };

        // ========== DETAIL MODAL LOGIC ==========
        const modal = document.getElementById('detailModal');
        const closeModal = document.getElementById('closeModal');
        const detailContent = document.getElementById('detailContent');

        function bindDetailButtons() {
            document.querySelectorAll('.detail-btn').forEach(button => {
                button.addEventListener('click', async function() {
                    const uuid = this.getAttribute('data-uuid');

                    // Show loading spinner
                    detailContent.innerHTML = `
                <div class="flex justify-center items-center py-8 text-gray-500">
                    <svg class="animate-spin h-5 w-5 mr-2 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                    Memuat detail...
                </div>
            `;

                    modal.classList.remove('hidden');
                    modal.classList.add('flex');

                    try {
                        const res = await fetch(`/nonconformity/${uuid}/data-modal`);
                        if (!res.ok) throw new Error('Gagal memuat data dari server');

                        const data = await res.json();

                        // Handle your typo key safely (keep as is)
                        const buktiTemuan = data.nonconformity_documentiation ?
                            `/storage/${data.nonconformity_documentiation}` :
                            '/images/no-image.png';

                        // Check if corrective image exists
                        let buktiPerbaikanHTML = '';
                        if (data.corrective_documentation) {
                            buktiPerbaikanHTML = `
                        <img src="/storage/${data.corrective_documentation}" 
                             alt="Bukti Perbaikan" 
                             class="rounded-md border w-full object-cover">
                    `;
                        } else {
                            buktiPerbaikanHTML = `
                        <p class="text-gray-500 italic mt-2">Belum ada perbaikan</p>
                    `;
                        }

                        detailContent.innerHTML = `
                    <div class="grid grid-cols-2 gap-4 mb-2">
                        <div><strong>No. Dokumen:</strong> ${data.document_number ?? '-'}</div>
                        <div><strong>Tanggal Temuan:</strong> ${data.found_date ?? '-'}</div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-2">
                        <div><strong>PIC:</strong> ${data.department?.department ?? '-'}</div>
                        <div><strong>Lokasi:</strong> ${data.location ?? '-'}</div>
                    </div>

                    <div class="mb-2">
                        <strong>Deskripsi:</strong>
                        <p class="mt-1">${data.description ?? '-'}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <strong>Bukti Temuan:</strong>
                            <div class="mt-2">
                                <img src="${buktiTemuan}" 
                                     alt="Bukti Temuan" 
                                     class="rounded-md border w-full object-cover">
                            </div>
                        </div>
                        <div>
                            <strong>Bukti Perbaikan:</strong>
                            <div class="mt-2">
                                ${buktiPerbaikanHTML}
                            </div>
                        </div>
                    </div>
                `;
                    } catch (error) {
                        console.error(error);
                        detailContent.innerHTML = `
                    <div class="text-red-500 text-center py-6">
                        Gagal memuat detail. Silakan coba lagi.
                    </div>
                `;
                    }
                });
            });
        }

        // Optional: close modal logic
        if (closeModal) {
            closeModal.addEventListener('click', () => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });
        }

        bindDetailButtons(); // initial bind for existing rows
    });
</script>
@endsection