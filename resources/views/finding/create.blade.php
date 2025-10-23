@extends('layouts.layout')

@section('content')
{{-- Alert Sukses --}}
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

<div id="input1Tab" class="fade-in">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            <span
                class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center text-white text-sm mr-3">1</span>
            Input Ketidaksesuaian
        </h2>

        <form action="{{ route('finding.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="tanggalTemuan" class="block text-sm font-medium text-gray-700 mb-2">Tanggal &amp; Waktu
                        Temuan</label>
                    <input type="text" name="tanggalTemuan" id="tanggalTemuan" readonly
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed">
                    <p class="text-xs text-gray-500 mt-1">🔒 Timestamp otomatis dan terkunci</p>
                </div>
                <div>
                    <label for="picTemuan" class="block text-sm font-medium text-gray-700 mb-2">PIC (Person In
                        Charge)</label>
                    <select id="picTemuan" name="picTemuan" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">-- Pilih PIC --</option>
                        @foreach($departments as $dept)
                        <option value="{{ $dept->uuid }}">{{ $dept->abbrivation ?? $dept->department }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label for="fotoBefore" class="block text-sm font-medium text-gray-700 mb-2">Foto Hasil Temuan
                    (Before)</label>
                <input type="file" id="fotoBefore" name="fotoBefore" accept="image/*" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <p class="text-sm text-gray-500 mt-1">Upload foto kondisi sebelum perbaikan</p>
            </div>

            <div>
                <label for="deskripsiTemuan" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi
                    Temuan</label>
                <textarea id="deskripsiTemuan" name="deskripsiTemuan" required rows="3"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Jelaskan temuan secara singkat..."></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="keteranganTemuan"
                        class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                    <input type="text" id="keteranganTemuan" name="keteranganTemuan" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Keterangan tambahan...">
                </div>
                <div>
                    <label for="lokasiTemuan" class="block text-sm font-medium text-gray-700 mb-2">Lokasi Temuan</label>
                    <input type="text" id="lokasiTemuan" name="lokasiTemuan" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Lokasi dimana temuan ditemukan...">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-lg transition-colors">
                    Submit Temuan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const now = new Date();
    const formatted = now.getFullYear() + '-' +
        String(now.getMonth() + 1).padStart(2, '0') + '-' +
        String(now.getDate()).padStart(2, '0') + ' ' +
        String(now.getHours()).padStart(2, '0') + ':' +
        String(now.getMinutes()).padStart(2, '0') + ':' +
        String(now.getSeconds()).padStart(2, '0');
    document.getElementById('tanggalTemuan').value = formatted;
});
</script>
@endsection