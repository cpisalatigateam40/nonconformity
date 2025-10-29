@extends('layouts.layout')

@section('content')
@if (session('success'))
<div class="mb-6 p-4 text-green-700 bg-green-100 border border-green-300 rounded-lg">
    <strong>✅ Berhasil!</strong> {{ session('success') }}
</div>
@endif

{{-- Alert Error --}}
@if (session('error'))
<div class="mb-6 p-4 text-red-700 bg-red-100 border border-red-300 rounded-lg">
    <strong>❌ Gagal!</strong> {{ session('error') }}
</div>
@endif

{{-- Validasi Error dari Laravel --}}
@if ($errors->any())
<div class="mb-6 p-4 text-red-700 bg-red-100 border border-red-300 rounded-lg">
    <strong>⚠️ Terjadi kesalahan:</strong>
    <ul class="list-disc ml-5 mt-2 space-y-1">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div id="input2Tab" class="fade-in">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            <span class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-sm mr-3">2</span>
            Update Perbaikan
        </h2>

        {{-- Form --}}
        <form id="updatePerbaikanForm" action="{{ route('perbaikan.storeUpdate') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Dropdown Nomor Dokumen --}}
            <div class="mb-6">
                <label for="nomorDokumen" class="block text-sm font-medium text-gray-700 mb-2">
                    Nomor Dokumen
                </label>

                <select name="asset_uuid" id="nomorDokumen" onchange="loadTemuanData(this.value)"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    <option value="" hidden>-- Pilih Nomor Dokumen --</option>

                    @foreach($nonconformities as $nonconformity)
                    <option value="{{ $nonconformity->uuid }}"
                        {{ (isset($selectedUuid) && $selectedUuid === $nonconformity->uuid) ? 'selected' : '' }}>
                        {{ $nonconformity->document_number }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Informasi Temuan --}}
            <div id="temuanInfo" class="hidden bg-gray-50 rounded-lg p-6 mb-6 border border-gray-200">
                <h3 class="font-semibold text-gray-800 mb-4">Informasi Temuan</h3>
                <div id="temuanDetails" class="text-sm text-gray-700"></div>
            </div>

            {{-- Foto After --}}
            <div>
                <label for="fotoAfter" class="block text-sm font-medium text-gray-700 mb-2">Foto Hasil Perbaikan (After)</label>
                <input type="file" name="foto_after" id="fotoAfter" accept="image/*"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <p class="text-sm text-gray-500 mt-1">Upload foto kondisi setelah perbaikan</p>
            </div>

            {{-- Tanggal Perbaikan --}}
            <div>
                <label for="tanggalPerbaikan" class="block text-sm font-medium text-gray-700 mb-2">Tanggal &amp; Waktu Perbaikan</label>
                <input type="text" name="tanggal_perbaikan" id="tanggalPerbaikan" readonly
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed">
                <p class="text-xs text-gray-500 mt-1">🔒 Timestamp otomatis saat submit</p>
            </div>

            {{-- Waktu & Poin --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Perhitungan Waktu &amp; Poin</label>
                <div id="perhitunganHari"
                    class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-700">
                    Akan dihitung otomatis saat submit perbaikan
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-8 rounded-lg transition-colors">
                    Update Perbaikan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Optional JS --}}
<script>
    function loadTemuanData(uuid) {
        if (!uuid) return;

        const url = `/nonconformity/${uuid}/data`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const infoDiv = document.getElementById('temuanInfo');
                const detailsDiv = document.getElementById('temuanDetails');

                if (data && !data.error) {
                    infoDiv.classList.remove('hidden');

                    const textInfo = `
                    <div class="space-y-2">
                        <p><strong>Tanggal Temuan:</strong> ${data.created_at ?? '-'}</p>
                        <p><strong>Deskripsi:</strong> ${data.description ?? '-'}</p>
                        <p><strong>Lokasi:</strong> ${data.title ?? '-'}</p>
                    </div>
                `;

                    let imageInfo = `
                    <div class="flex items-center justify-center text-gray-500 italic">
                        Belum ada foto temuan
                    </div>
                `;

                    if (data.image) {
                        imageInfo = `
                        <div class="flex justify-center items-center">
                            <a href="${data.image}" target="_blank">
                                <img src="${data.image}" alt="Foto Temuan"
                                     class="rounded-lg border border-gray-300 max-h-64 object-contain hover:opacity-90 transition">
                            </a>
                        </div>
                    `;
                    }

                    detailsDiv.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                        <div>${textInfo}</div>
                        <div>${imageInfo}</div>
                    </div>
                `;
                } else {
                    infoDiv.classList.add('hidden');
                    detailsDiv.innerHTML = '<p class="text-red-500">Data tidak ditemukan</p>';
                }
            })
            .catch(err => console.error(err));
    }

    // Automatically set timestamp when submitting
    document.getElementById('updatePerbaikanForm').addEventListener('submit', function(e) {
        const now = new Date();
        document.getElementById('tanggalPerbaikan').value = now.toLocaleString('id-ID');
    });

    // Initialize autoload (runs on load or Rekap click)
    function initTemuanAutoload() {
        const dropdown = document.getElementById('nomorDokumen');
        if (dropdown && dropdown.value) {
            loadTemuanData(dropdown.value);
        }
    }

    document.addEventListener('DOMContentLoaded', initTemuanAutoload);

    // Optional: re-run when clicking Rekap tab (adjust selector if needed)
    document.getElementById('rekapTabButton')?.addEventListener('click', initTemuanAutoload);
</script>
@endsection