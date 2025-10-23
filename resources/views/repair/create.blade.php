@extends('layouts.layout')

@section('content')
<div id="input2Tab" class="fade-in">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            <span
                class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-sm mr-3">2</span>
            Input Perbaikan
        </h2>

        <div class="mb-6">
            <label for="nomorDokumen" class="block text-sm font-medium text-gray-700 mb-2">Nomor Dokumen</label>
            <select id="nomorDokumen" onchange="loadTemuanData()"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">-- Pilih Nomor Dokumen --</option>
                {{-- nanti bisa diisi dari database --}}
            </select>
        </div>

        <div id="temuanInfo" class="hidden bg-gray-50 rounded-lg p-4 mb-6">
            <h3 class="font-medium text-gray-800 mb-2">Informasi Temuan:</h3>
            <div id="temuanDetails" class="text-sm text-gray-600"></div>
        </div>

        <form onsubmit="submitPerbaikan(event)" class="space-y-6">
            <div>
                <label for="fotoAfter" class="block text-sm font-medium text-gray-700 mb-2">Foto Hasil Perbaikan
                    (After)</label>
                <input type="file" id="fotoAfter" accept="image/*" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <p class="text-sm text-gray-500 mt-1">Upload foto kondisi setelah perbaikan</p>
            </div>

            <div>
                <label for="tanggalPerbaikan" class="block text-sm font-medium text-gray-700 mb-2">Tanggal &amp; Waktu
                    Perbaikan</label>
                <input type="text" id="tanggalPerbaikan" readonly
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed">
                <p class="text-xs text-gray-500 mt-1">🔒 Timestamp otomatis saat submit</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Perhitungan Waktu &amp; Poin</label>
                <div id="perhitunganHari"
                    class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-700">
                    Akan dihitung otomatis saat submit perbaikan
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-8 rounded-lg transition-colors">
                    Submit Perbaikan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection