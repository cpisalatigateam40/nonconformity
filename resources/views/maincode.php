<!doctype html>
<html lang="id">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ketidaksesuaian Area Produksi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
        body {
            box-sizing: border-box;
        }
        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .modal-backdrop {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }
    </style>
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
 </head>
 <body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen"><!-- Header -->
  <header class="bg-white shadow-lg border-b-4 border-blue-600">
   <div class="container mx-auto px-6 py-4">
    <div class="flex justify-between items-center">
     <div class="flex items-center space-x-3">
      <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center"><span class="text-white font-bold text-lg">G</span>
      </div>
      <div>
       <h1 class="text-2xl font-bold text-gray-800">Ketidaksesuaian Area Produksi</h1>
       <p class="text-sm text-gray-600">Sistem Monitoring &amp; Perbaikan</p>
      </div>
     </div>
     <div class="flex items-center space-x-4"><span id="currentUser" class="text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded-full"></span> <button id="userManagementBtn" onclick="showTab('userManagement')" class="hidden bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm transition-colors flex items-center"> <span class="mr-2">👥</span> Manajemen User </button> <button onclick="logout()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition-colors"> Logout </button>
     </div>
    </div>
   </div>
  </header><!-- Login Screen -->
  <div id="loginScreen" class="fixed inset-0 bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 flex items-center justify-center z-50"><!-- Background Pattern -->
   <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=" 60 height="60" viewbox="0 0 60 60" xmlns="http://www.w3.org/2000/svg" %3e%3cg fill="none" fill-rule="evenodd" fill-opacity="0.05" %3e%3ccircle cx="30" cy="30" r="2" %3e%3c g%3e%3c svg%3e)] opacity-30></div>
   <div class="relative bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 p-8 w-full max-w-lg mx-4"><!-- Header Section -->
    <div class="text-center mb-8">
     <div class="relative mb-6">
      <div class="w-20 h-20 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto shadow-lg"><span class="text-white font-bold text-lg">CPI</span>
      </div>
      <div class="absolute -bottom-2 -right-2 w-6 h-6 bg-green-500 rounded-full border-2 border-white"></div>
     </div>
     <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-2">Sistem Login</h1>
     <p class="text-gray-500 text-sm font-medium">Ketidaksesuaian Area Produksi</p>
     <p class="text-gray-400 text-xs font-medium mt-1">PT. Charoen Pokphand Indonesia - Salatiga</p>
    </div><!-- Login Form -->
    <form onsubmit="handleLogin(event)" class="space-y-5">
     <div class="space-y-4">
      <div><label for="loginUser" class="block text-sm font-semibold text-gray-700 mb-2">Pilih User</label>
       <div class="relative"><select id="loginUser" required class="w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50/50 transition-all duration-200 appearance-none"> <option value="">-- Pilih User --</option> <option value="USER_A">👤 User A (Input Temuan)</option> <option value="BC">🔧 BC (Perbaikan)</option> <option value="SH">🔧 SH (Perbaikan)</option> <option value="FP">🔧 FP (Perbaikan)</option> <option value="SP">🔧 SP (Perbaikan)</option> <option value="WH">🔧 WH (Perbaikan)</option> <option value="ENG">🔧 ENG (Perbaikan)</option> <option value="QC">🔧 QC (Perbaikan)</option> <option value="PGA">🔧 PGA (Perbaikan)</option> <option value="MANAGER">👔 Manager (View Only)</option> <option value="SUPER_ADMIN">⚡ Super Admin</option> </select>
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
         <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
         </svg>
        </div>
       </div>
      </div>
      <div><label for="loginPassword" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
       <div class="relative"><input type="password" id="loginPassword" required class="w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50/50 transition-all duration-200" placeholder="Masukkan password...">
        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
         <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
         </svg>
        </div>
       </div>
      </div>
     </div><button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 transform hover:scale-[1.02] shadow-lg hover:shadow-xl"> <span class="flex items-center justify-center space-x-2"> <span>Masuk Sistem</span>
       <svg class="w-4 h-4" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
       </svg></span> </button>
    </form><!-- Password Reference - Collapsible -->
    <div class="mt-6"><button onclick="togglePasswordRef()" class="w-full text-left p-3 bg-blue-50/50 hover:bg-blue-50 border border-blue-100 rounded-xl transition-all duration-200">
      <div class="flex items-center justify-between"><span class="text-sm font-medium text-blue-700">📋 Lihat Password Default</span>
       <svg id="passwordRefIcon" class="w-4 h-4 text-blue-600 transform transition-transform duration-200" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
       </svg>
      </div></button>
     <div id="passwordRefContent" class="hidden mt-2 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-xl">
      <div class="grid grid-cols-2 gap-2 text-xs">
       <div class="space-y-1">
        <p class="font-semibold text-blue-800 mb-2">Input &amp; Admin:</p>
        <p class="text-blue-700">• User A: <code class="bg-white px-1 rounded">usera123</code></p>
        <p class="text-blue-700">• Manager: <code class="bg-white px-1 rounded">manager123</code></p>
        <p class="text-blue-700">• Super Admin: <code class="bg-white px-1 rounded">admin123</code></p>
       </div>
       <div class="space-y-1">
        <p class="font-semibold text-blue-800 mb-2">Departemen:</p>
        <p class="text-blue-700">• BC: <code class="bg-white px-1 rounded">bc123</code> • SH: <code class="bg-white px-1 rounded">sh123</code></p>
        <p class="text-blue-700">• FP: <code class="bg-white px-1 rounded">fp123</code> • SP: <code class="bg-white px-1 rounded">sp123</code></p>
        <p class="text-blue-700">• WH: <code class="bg-white px-1 rounded">wh123</code> • ENG: <code class="bg-white px-1 rounded">eng123</code></p>
        <p class="text-blue-700">• QC: <code class="bg-white px-1 rounded">qc123</code> • PGA: <code class="bg-white px-1 rounded">pga123</code></p>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div><!-- Main Content -->
  <main id="mainContent" class="hidden container mx-auto px-6 py-8"><!-- Navigation Tabs -->
   <div class="bg-white rounded-xl shadow-lg mb-8">
    <div class="flex border-b border-gray-200"><button id="tabInput1" onclick="showTab('input1')" class="px-6 py-4 text-sm font-medium text-blue-600 border-b-2 border-blue-600"> Input Temuan </button> <button id="tabInput2" onclick="showTab('input2')" class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700"> Input Perbaikan </button> <button id="tabRekap" onclick="showTab('rekap')" class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700"> Rekap Data </button> <button id="tabAnalisa" onclick="showTab('analisa')" class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700"> Analisa Bulanan </button>
    </div>
   </div><!-- Input 1: Temuan -->
   <div id="input1Tab" class="fade-in">
    <div class="bg-white rounded-xl shadow-lg p-8">
     <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center"><span class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center text-white text-sm mr-3">1</span> Input Ketidaksesuaian</h2>
     <form onsubmit="submitTemuan(event)" class="space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
       <div><label for="tanggalTemuan" class="block text-sm font-medium text-gray-700 mb-2">Tanggal &amp; Waktu Temuan</label> <input type="text" id="tanggalTemuan" readonly class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed">
        <p class="text-xs text-gray-500 mt-1">🔒 Timestamp otomatis dan terkunci</p>
       </div>
       <div><label for="picTemuan" class="block text-sm font-medium text-gray-700 mb-2">PIC (Person In Charge)</label> <select id="picTemuan" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"> <option value="">-- Pilih PIC --</option> <option value="BC">BC</option> <option value="SH">SH</option> <option value="FP">FP</option> <option value="SP">SP</option> <option value="WH">WH</option> <option value="ENG">ENG</option> <option value="QC">QC</option> <option value="PGA">PGA</option> </select>
       </div>
      </div>
      <div><label for="fotoBefore" class="block text-sm font-medium text-gray-700 mb-2">Foto Hasil Temuan (Before)</label> <input type="file" id="fotoBefore" accept="image/*" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
       <p class="text-sm text-gray-500 mt-1">Upload foto kondisi sebelum perbaikan</p>
      </div>
      <div><label for="deskripsiTemuan" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Temuan</label> <textarea id="deskripsiTemuan" required rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Jelaskan temuan secara singkat..."></textarea>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
       <div><label for="keteranganTemuan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label> <input type="text" id="keteranganTemuan" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Keterangan tambahan...">
       </div>
       <div><label for="lokasiTemuan" class="block text-sm font-medium text-gray-700 mb-2">Lokasi Temuan</label> <input type="text" id="lokasiTemuan" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Lokasi dimana temuan ditemukan...">
       </div>
      </div>
      <div class="flex justify-end"><button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-lg transition-colors"> Submit Temuan </button>
      </div>
     </form>
    </div>
   </div><!-- Input 2: Perbaikan -->
   <div id="input2Tab" class="hidden fade-in">
    <div class="bg-white rounded-xl shadow-lg p-8">
     <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center"><span class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-sm mr-3">2</span> Input Perbaikan</h2>
     <div class="mb-6"><label for="nomorDokumen" class="block text-sm font-medium text-gray-700 mb-2">Nomor Dokumen</label> <select id="nomorDokumen" onchange="loadTemuanData()" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"> <option value="">-- Pilih Nomor Dokumen --</option> </select>
     </div>
     <div id="temuanInfo" class="hidden bg-gray-50 rounded-lg p-4 mb-6">
      <h3 class="font-medium text-gray-800 mb-2">Informasi Temuan:</h3>
      <div id="temuanDetails" class="text-sm text-gray-600"></div>
     </div>
     <form onsubmit="submitPerbaikan(event)" class="space-y-6">
      <div><label for="fotoAfter" class="block text-sm font-medium text-gray-700 mb-2">Foto Hasil Perbaikan (After)</label> <input type="file" id="fotoAfter" accept="image/*" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
       <p class="text-sm text-gray-500 mt-1">Upload foto kondisi setelah perbaikan</p>
      </div>
      <div><label for="tanggalPerbaikan" class="block text-sm font-medium text-gray-700 mb-2">Tanggal &amp; Waktu Perbaikan</label> <input type="text" id="tanggalPerbaikan" readonly class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed">
       <p class="text-xs text-gray-500 mt-1">🔒 Timestamp otomatis saat submit</p>
      </div>
      <div><label class="block text-sm font-medium text-gray-700 mb-2">Perhitungan Waktu &amp; Poin</label>
       <div id="perhitunganHari" class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-700">
        Akan dihitung otomatis saat submit perbaikan
       </div>
      </div>
      <div class="flex justify-end"><button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-8 rounded-lg transition-colors"> Submit Perbaikan </button>
      </div>
     </form>
    </div>
   </div><!-- Analisa Bulanan -->
   <div id="analisaTab" class="hidden fade-in">
    <div class="bg-white rounded-xl shadow-lg p-8">
     <div class="mb-6">
      <h2 class="text-2xl font-bold text-gray-800 flex items-center"><span class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center text-white text-sm mr-3">📈</span> Analisa Hasil Temuan Bulanan</h2>
     </div><!-- Filter Periode -->
     <div class="mb-6 flex flex-wrap gap-4 items-center">
      <div class="flex gap-2 items-center"><label for="filterPeriode" class="text-sm font-medium text-gray-700">Periode:</label> <select id="filterPeriode" onchange="togglePeriodeFilter()" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"> <option value="bulanan">Bulanan</option> <option value="tahunan">Tahunan</option> </select>
      </div>
      <div id="filterBulananContainer" class="flex gap-2 items-center"><label for="filterBulan" class="text-sm font-medium text-gray-700">Bulan:</label> <select id="filterBulan" onchange="updateAnalisaBulanan()" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"> <option value="1">Januari</option> <option value="2">Februari</option> <option value="3">Maret</option> <option value="4">April</option> <option value="5">Mei</option> <option value="6">Juni</option> <option value="7">Juli</option> <option value="8">Agustus</option> <option value="9">September</option> <option value="10">Oktober</option> <option value="11">November</option> <option value="12">Desember</option> </select>
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
   </div><!-- Rekap Data -->
   <div id="rekapTab" class="hidden fade-in">
    <div class="bg-white rounded-xl shadow-lg p-8">
     <div class="mb-6">
      <h2 class="text-2xl font-bold text-gray-800 flex items-center"><span class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center text-white text-sm mr-3">📊</span> Rekap Data Ketidaksesuaian</h2>
     </div>
     <div class="mb-6 flex flex-wrap gap-4">
      <div class="bg-blue-50 rounded-lg p-4 flex-1 min-w-48">
       <div class="text-2xl font-bold text-blue-600" id="totalTemuan">
        0
       </div>
       <div class="text-sm text-gray-600">
        Total Temuan
       </div>
      </div>
      <div class="bg-red-50 rounded-lg p-4 flex-1 min-w-48">
       <div class="text-2xl font-bold text-red-600" id="openTemuan">
        0
       </div>
       <div class="text-sm text-gray-600">
        Status Open
       </div>
      </div>
      <div class="bg-green-50 rounded-lg p-4 flex-1 min-w-48">
       <div class="text-2xl font-bold text-green-600" id="closedTemuan">
        0
       </div>
       <div class="text-sm text-gray-600">
        Status Closed
       </div>
      </div>
     </div><!-- Statistik Per Departemen -->
     <div class="mb-6">
      <h3 class="text-lg font-semibold text-gray-800 mb-3">Statistik Per Departemen</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" id="departmentStats"><!-- Stats will be populated by JavaScript -->
      </div>
     </div><!-- Filter dan Download -->
     <div class="mb-6 flex flex-wrap gap-4 items-center justify-between">
      <div class="flex gap-4 items-center"><label for="filterDepartment" class="text-sm font-medium text-gray-700">Filter Departemen:</label> <select id="filterDepartment" onchange="updateRekapData()" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"> <option value="">Semua Departemen</option> <option value="BC">BC</option> <option value="SH">SH</option> <option value="FP">FP</option> <option value="SP">SP</option> <option value="WH">WH</option> <option value="ENG">ENG</option> <option value="QC">QC</option> <option value="PGA">PGA</option> </select>
      </div>
      <div class="flex gap-2" id="downloadButtons"><!-- Download buttons will be populated by JavaScript based on user role -->
      </div>
     </div>
     <div class="overflow-x-auto">
      <table class="w-full border-collapse border border-gray-300">
       <thead>
        <tr class="bg-gray-50">
         <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">No. Dokumen</th>
         <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Tanggal Temuan</th>
         <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Deskripsi</th>
         <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Lokasi</th>
         <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">PIC</th>
         <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Status</th>
         <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Waktu Penyelesaian</th>
         <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Poin Tambahan</th>
         <th id="actionHeader" class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700" style="display: none;">Aksi</th>
        </tr>
       </thead>
       <tbody id="rekapTableBody">
        <tr>
         <td colspan="9" class="border border-gray-300 px-4 py-8 text-center text-gray-500">Belum ada data temuan</td>
        </tr>
       </tbody>
      </table>
     </div>
    </div>
   </div><!-- User Management Tab -->
   <div id="userManagementTab" class="hidden fade-in">
    <div class="bg-white rounded-xl shadow-lg p-8">
     <div class="mb-6">
      <h2 class="text-2xl font-bold text-gray-800 flex items-center"><span class="w-8 h-8 bg-indigo-500 rounded-full flex items-center justify-center text-white text-sm mr-3">👥</span> Manajemen User</h2>
      <p class="text-gray-600 mt-2">Kelola akun pengguna dan otorisasi akses sistem</p>
     </div><!-- Add New User Form -->
     <div class="bg-gray-50 rounded-lg p-6 mb-8">
      <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah User Baru</h3>
      <form onsubmit="addNewUser(event)" class="space-y-4">
       <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div><label for="newUsername" class="block text-sm font-medium text-gray-700 mb-2">Username</label> <input type="text" id="newUsername" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan username...">
        </div>
        <div><label for="newPassword" class="block text-sm font-medium text-gray-700 mb-2">Password</label> <input type="password" id="newPassword" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan password...">
        </div>
        <div><label for="newUserRole" class="block text-sm font-medium text-gray-700 mb-2">Role/Departemen</label> <select id="newUserRole" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"> <option value="">-- Pilih Role --</option> <option value="BC">BC</option> <option value="SH">SH</option> <option value="FP">FP</option> <option value="SP">SP</option> <option value="WH">WH</option> <option value="ENG">ENG</option> <option value="QC">QC</option> <option value="PGA">PGA</option> <option value="USER_INPUT">User Input</option> <option value="MANAGER">Manager</option> <option value="ADMIN">Admin</option> </select>
        </div>
       </div>
       <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><label for="newUserStatus" class="block text-sm font-medium text-gray-700 mb-2">Status</label> <select id="newUserStatus" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"> <option value="active">Aktif</option> <option value="inactive">Tidak Aktif</option> </select>
        </div>
        <div><label class="block text-sm font-medium text-gray-700 mb-2">Otorisasi Akses</label>
         <div class="flex flex-wrap gap-3"><label class="flex items-center"> <input type="checkbox" id="authInput1" class="mr-2 rounded"> <span class="text-sm">Input Temuan</span> </label> <label class="flex items-center"> <input type="checkbox" id="authInput2" class="mr-2 rounded"> <span class="text-sm">Input Perbaikan</span> </label> <label class="flex items-center"> <input type="checkbox" id="authRekap" class="mr-2 rounded"> <span class="text-sm">Rekap Data</span> </label> <label class="flex items-center"> <input type="checkbox" id="authAnalisa" class="mr-2 rounded"> <span class="text-sm">Analisa Bulanan</span> </label>
         </div>
        </div>
       </div>
       <div class="flex justify-end"><button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-lg transition-colors"> Tambah User </button>
       </div>
      </form>
     </div><!-- User List -->
     <div class="mb-6">
      <div class="flex justify-between items-center mb-4">
       <h3 class="text-lg font-semibold text-gray-800">Daftar User</h3>
       <div class="flex gap-2"><button onclick="exportUserList()" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center text-sm"> 📥 Export CSV </button> <button onclick="refreshUserList()" class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center text-sm"> 🔄 Refresh </button>
       </div>
      </div>
      <div class="overflow-x-auto">
       <table class="w-full border-collapse border border-gray-300">
        <thead>
         <tr class="bg-gray-50">
          <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Username</th>
          <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Role</th>
          <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Status</th>
          <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Otorisasi</th>
          <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Tanggal Dibuat</th>
          <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">Aksi</th>
         </tr>
        </thead>
        <tbody id="userListTableBody">
         <tr>
          <td colspan="6" class="border border-gray-300 px-4 py-8 text-center text-gray-500">Loading user data...</td>
         </tr>
        </tbody>
       </table>
      </div>
     </div>
    </div>
   </div>
  </main><!-- Success Modal -->
  <div id="successModal" class="hidden fixed inset-0 modal-backdrop flex items-center justify-center z-50">
   <div class="bg-white rounded-xl shadow-2xl p-8 max-w-md mx-4">
    <div class="text-center">
     <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4"><span class="text-white text-2xl">✓</span>
     </div>
     <h3 class="text-xl font-bold text-gray-800 mb-2">Berhasil!</h3>
     <p id="successMessage" class="text-gray-600 mb-6"></p><button onclick="closeModal('successModal')" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-6 rounded-lg transition-colors"> OK </button>
    </div>
   </div>
  </div>
  <script>
        // Global variables
        let currentUser = '';
        let temuanData = JSON.parse(localStorage.getItem('gmpTemuanData')) || [];
        let perbaikanData = JSON.parse(localStorage.getItem('gmpPerbaikanData')) || [];
        let documentCounter = parseInt(localStorage.getItem('gmpDocumentCounter')) || 1;
        let customUsers = JSON.parse(localStorage.getItem('gmpCustomUsers')) || [];

        // User permissions and passwords
        const defaultUserPermissions = {
            'USER_A': ['input1', 'rekap', 'analisa'],
            'BC': ['input2', 'rekap', 'analisa'],
            'SH': ['input2', 'rekap', 'analisa'],
            'FP': ['input2', 'rekap', 'analisa'],
            'SP': ['input2', 'rekap', 'analisa'],
            'WH': ['input2', 'rekap', 'analisa'],
            'ENG': ['input2', 'rekap', 'analisa'],
            'QC': ['input2', 'rekap', 'analisa'],
            'PGA': ['input2', 'rekap', 'analisa'],
            'MANAGER': ['rekap', 'analisa'],
            'SUPER_ADMIN': ['input1', 'input2', 'rekap', 'analisa', 'userManagement']
        };

        // Get user permissions (including custom users)
        function getUserPermissions(username) {
            // Check default users first
            if (defaultUserPermissions[username]) {
                return defaultUserPermissions[username];
            }
            
            // Check custom users
            const customUser = customUsers.find(u => u.username === username && u.status === 'active');
            if (customUser) {
                return customUser.permissions;
            }
            
            return [];
        }

        const defaultUserPasswords = {
            'USER_A': 'usera123',
            'BC': 'bc123',
            'SH': 'sh123',
            'FP': 'fp123',
            'SP': 'sp123',
            'WH': 'wh123',
            'ENG': 'eng123',
            'QC': 'qc123',
            'PGA': 'pga123',
            'MANAGER': 'manager123',
            'SUPER_ADMIN': 'admin123'
        };

        // Get user password (including custom users)
        function getUserPassword(username) {
            // Check default users first
            if (defaultUserPasswords[username]) {
                return defaultUserPasswords[username];
            }
            
            // Check custom users
            const customUser = customUsers.find(u => u.username === username && u.status === 'active');
            if (customUser) {
                return customUser.password;
            }
            
            return null;
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setCurrentTimestamp();
            updateRekapData();
            loadOpenDocuments();
            initializeAnalisaFilters();
            populateLoginUsers();
        });

        // Set current timestamp (locked)
        function setCurrentTimestamp() {
            const now = new Date();
            const timestamp = now.toLocaleString('id-ID', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            document.getElementById('tanggalTemuan').value = timestamp;
        }

        // Calculate points based on completion time (simplified scoring)
        function calculatePoints(startTimestamp, endTimestamp) {
            const start = new Date(startTimestamp);
            const end = new Date(endTimestamp);
            
            // Check if same day
            const startDate = new Date(start.getFullYear(), start.getMonth(), start.getDate());
            const endDate = new Date(end.getFullYear(), end.getMonth(), end.getDate());
            const diffDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
            
            // Simplified scoring system
            if (diffDays === 0) {
                // Same day completion: +0 points
                return 0;
            } else {
                // Each additional day adds 1 point
                return diffDays;
            }
        }

        // Format completion time display
        function formatCompletionTime(startTimestamp, endTimestamp) {
            const start = new Date(startTimestamp);
            const end = new Date(endTimestamp);
            
            // Check if same day
            const startDate = new Date(start.getFullYear(), start.getMonth(), start.getDate());
            const endDate = new Date(end.getFullYear(), end.getMonth(), end.getDate());
            const diffDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
            
            if (diffDays === 0) {
                // Same day - show hours
                const diffTime = end - start;
                const diffHours = Math.ceil(diffTime / (1000 * 60 * 60));
                return `${diffHours} jam`;
            } else {
                // Different days - show days
                return `${diffDays} hari`;
            }
        }

        // Login handling
        function handleLogin(event) {
            event.preventDefault();
            const selectedUser = document.getElementById('loginUser').value;
            const enteredPassword = document.getElementById('loginPassword').value;
            
            if (!selectedUser) {
                showLoginError('Silakan pilih user terlebih dahulu');
                return;
            }

            if (!enteredPassword) {
                showLoginError('Silakan masukkan password');
                return;
            }

            // Validate password
            const correctPassword = getUserPassword(selectedUser);
            if (!correctPassword || correctPassword !== enteredPassword) {
                showLoginError('Password salah! Silakan coba lagi.');
                return;
            }

            currentUser = selectedUser;
            document.getElementById('currentUser').textContent = `Logged in as: ${selectedUser}`;
            document.getElementById('loginScreen').classList.add('hidden');
            document.getElementById('mainContent').classList.remove('hidden');
            
            setupUserInterface();
        }

        // Show login error
        function showLoginError(message) {
            // Create error message element
            let errorElement = document.getElementById('loginError');
            if (!errorElement) {
                errorElement = document.createElement('div');
                errorElement.id = 'loginError';
                errorElement.className = 'mt-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm';
                document.querySelector('#loginScreen form').appendChild(errorElement);
            }
            errorElement.textContent = message;
            
            // Clear password field
            document.getElementById('loginPassword').value = '';
            
            // Remove error after 3 seconds
            setTimeout(() => {
                if (errorElement) {
                    errorElement.remove();
                }
            }, 3000);
        }

        function logout() {
            currentUser = '';
            document.getElementById('loginScreen').classList.remove('hidden');
            document.getElementById('mainContent').classList.add('hidden');
            showTab('input1');
        }

        function setupUserInterface() {
            const permissions = getUserPermissions(currentUser);
            
            // Hide/show tabs based on permissions
            document.getElementById('tabInput1').style.display = permissions.includes('input1') ? 'block' : 'none';
            document.getElementById('tabInput2').style.display = permissions.includes('input2') ? 'block' : 'none';
            document.getElementById('tabRekap').style.display = permissions.includes('rekap') ? 'block' : 'none';
            document.getElementById('tabAnalisa').style.display = permissions.includes('analisa') ? 'block' : 'none';
            
            // Show/hide user management button (separate from tabs)
            const userManagementBtn = document.getElementById('userManagementBtn');
            if (permissions.includes('userManagement')) {
                userManagementBtn.classList.remove('hidden');
            } else {
                userManagementBtn.classList.add('hidden');
            }
            
            // Setup download buttons based on user role
            setupDownloadButtons();
            
            // Show first available tab
            if (permissions.includes('input1')) {
                showTab('input1');
            } else if (permissions.includes('input2')) {
                showTab('input2');
            } else if (permissions.includes('rekap')) {
                showTab('rekap');
            } else if (permissions.includes('analisa')) {
                showTab('analisa');
            }
        }

        // Setup download buttons based on user role
        function setupDownloadButtons() {
            const downloadButtonsContainer = document.getElementById('downloadButtons');
            downloadButtonsContainer.innerHTML = '';
            
            // Users who can download all data
            const canDownloadAll = ['USER_A', 'MANAGER', 'SUPER_ADMIN'];
            
            // PIC users who can only download their own data
            const picUsers = ['BC', 'SH', 'FP', 'SP', 'WH', 'ENG', 'QC', 'PGA'];
            
            if (canDownloadAll.includes(currentUser)) {
                // Show download all button
                const downloadAllBtn = document.createElement('button');
                downloadAllBtn.onclick = downloadExcel;
                downloadAllBtn.className = 'bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center text-sm';
                downloadAllBtn.innerHTML = '📥 Download Semua';
                downloadButtonsContainer.appendChild(downloadAllBtn);
            } else if (picUsers.includes(currentUser)) {
                // Show download my data button only
                const downloadMyBtn = document.createElement('button');
                downloadMyBtn.onclick = downloadMyData;
                downloadMyBtn.className = 'bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center text-sm';
                downloadMyBtn.innerHTML = `📥 Download Data ${currentUser}`;
                downloadButtonsContainer.appendChild(downloadMyBtn);
            }
        }

        // Tab navigation
        function showTab(tabName) {
            // Hide all tabs
            document.getElementById('input1Tab').classList.add('hidden');
            document.getElementById('input2Tab').classList.add('hidden');
            document.getElementById('rekapTab').classList.add('hidden');
            document.getElementById('analisaTab').classList.add('hidden');
            document.getElementById('userManagementTab').classList.add('hidden');
            
            // Remove active class from all tab buttons
            document.querySelectorAll('[id^="tab"]').forEach(tab => {
                tab.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
                tab.classList.add('text-gray-500');
            });
            
            // Reset user management button style
            const userManagementBtn = document.getElementById('userManagementBtn');
            userManagementBtn.classList.remove('bg-indigo-700');
            userManagementBtn.classList.add('bg-indigo-500');
            
            // Show selected tab
            if (tabName === 'input1') {
                document.getElementById('input1Tab').classList.remove('hidden');
                document.getElementById('tabInput1').classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
                document.getElementById('tabInput1').classList.remove('text-gray-500');
                setCurrentTimestamp(); // Refresh timestamp when showing input tab
            } else if (tabName === 'input2') {
                document.getElementById('input2Tab').classList.remove('hidden');
                document.getElementById('tabInput2').classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
                document.getElementById('tabInput2').classList.remove('text-gray-500');
                loadOpenDocuments();
            } else if (tabName === 'rekap') {
                document.getElementById('rekapTab').classList.remove('hidden');
                document.getElementById('tabRekap').classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
                document.getElementById('tabRekap').classList.remove('text-gray-500');
                updateRekapData();
            } else if (tabName === 'analisa') {
                document.getElementById('analisaTab').classList.remove('hidden');
                document.getElementById('tabAnalisa').classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
                document.getElementById('tabAnalisa').classList.remove('text-gray-500');
                updateAnalisaBulanan();
            } else if (tabName === 'userManagement') {
                document.getElementById('userManagementTab').classList.remove('hidden');
                // Highlight user management button when active
                userManagementBtn.classList.remove('bg-indigo-500');
                userManagementBtn.classList.add('bg-indigo-700');
                loadUserList();
            }
        }

        // Generate document number per PIC
        function generateDocumentNumber(pic, timestamp) {
            const date = new Date(timestamp);
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            
            // Get counter for this PIC and date
            const counterKey = `gmpCounter_${pic}_${year}${month}${day}`;
            let counter = parseInt(localStorage.getItem(counterKey)) || 1;
            
            const docNumber = `GMP-${pic}-${year}${month}${day}-${String(counter).padStart(3, '0')}`;
            
            // Update counter
            counter++;
            localStorage.setItem(counterKey, counter.toString());
            
            return docNumber;
        }

        // Submit temuan
        function submitTemuan(event) {
            event.preventDefault();
            
            const timestamp = new Date().toISOString();
            const picTemuan = document.getElementById('picTemuan').value;
            
            const formData = {
                nomorDokumen: generateDocumentNumber(picTemuan, timestamp),
                tanggalTemuan: document.getElementById('tanggalTemuan').value,
                timestampTemuan: timestamp,
                fotoBefore: document.getElementById('fotoBefore').files[0]?.name || 'foto_before.jpg',
                deskripsiTemuan: document.getElementById('deskripsiTemuan').value,
                keteranganTemuan: document.getElementById('keteranganTemuan').value,
                lokasiTemuan: document.getElementById('lokasiTemuan').value,
                picTemuan: picTemuan,
                statusTemuan: 'Open',
                inputBy: currentUser,
                inputDate: timestamp
            };
            
            temuanData.push(formData);
            localStorage.setItem('gmpTemuanData', JSON.stringify(temuanData));
            
            // Reset form
            event.target.reset();
            setCurrentTimestamp();
            
            showSuccessMessage(`Temuan berhasil disimpan dengan nomor dokumen: ${formData.nomorDokumen}`);
            updateRekapData();
        }

        // Load open documents for input 2
        function loadOpenDocuments() {
            const select = document.getElementById('nomorDokumen');
            select.innerHTML = '<option value="">-- Pilih Nomor Dokumen --</option>';
            
            const openTemuan = temuanData.filter(item => {
                // Check if user has permission to access this finding
                let hasPermission = false;
                
                if (currentUser === 'SUPER_ADMIN') {
                    hasPermission = true;
                } else {
                    // Check if current user matches the PIC
                    if (item.picTemuan === currentUser) {
                        hasPermission = true;
                    } else {
                        // For custom users, check if their role matches the PIC
                        const customUser = customUsers.find(u => u.username === currentUser && u.status === 'active');
                        if (customUser && customUser.role === item.picTemuan) {
                            hasPermission = true;
                        }
                    }
                }
                
                const isOpen = item.statusTemuan === 'Open';
                return hasPermission && isOpen;
            });
            
            openTemuan.forEach(item => {
                const option = document.createElement('option');
                option.value = item.nomorDokumen;
                option.textContent = `${item.nomorDokumen} - ${item.deskripsiTemuan}`;
                select.appendChild(option);
            });
        }

        // Load temuan data for selected document
        function loadTemuanData() {
            const nomorDokumen = document.getElementById('nomorDokumen').value;
            const temuanInfo = document.getElementById('temuanInfo');
            const temuanDetails = document.getElementById('temuanDetails');
            
            if (!nomorDokumen) {
                temuanInfo.classList.add('hidden');
                return;
            }
            
            const temuan = temuanData.find(item => item.nomorDokumen === nomorDokumen);
            if (temuan) {
                temuanDetails.innerHTML = `
                    <p><strong>Tanggal Temuan:</strong> ${temuan.tanggalTemuan}</p>
                    <p><strong>Deskripsi:</strong> ${temuan.deskripsiTemuan}</p>
                    <p><strong>Lokasi:</strong> ${temuan.lokasiTemuan}</p>
                    <p><strong>PIC:</strong> ${temuan.picTemuan}</p>
                `;
                temuanInfo.classList.remove('hidden');
            }
        }

        // Submit perbaikan
        function submitPerbaikan(event) {
            event.preventDefault();
            
            const nomorDokumen = document.getElementById('nomorDokumen').value;
            const perbaikanTimestamp = new Date().toISOString();
            const perbaikanDisplay = new Date().toLocaleString('id-ID', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            
            // Find and update temuan status
            const temuanIndex = temuanData.findIndex(item => item.nomorDokumen === nomorDokumen);
            if (temuanIndex !== -1) {
                const temuan = temuanData[temuanIndex];
                const startTimestamp = temuan.timestampTemuan;
                const points = calculatePoints(startTimestamp, perbaikanTimestamp);
                const completionTime = formatCompletionTime(startTimestamp, perbaikanTimestamp);
                
                // Update status to closed
                temuanData[temuanIndex].statusTemuan = 'Closed';
                temuanData[temuanIndex].tanggalPerbaikan = perbaikanDisplay;
                temuanData[temuanIndex].timestampPerbaikan = perbaikanTimestamp;
                temuanData[temuanIndex].waktuPenyelesaian = completionTime;
                temuanData[temuanIndex].poin = points;
                temuanData[temuanIndex].fotoAfter = document.getElementById('fotoAfter').files[0]?.name || 'foto_after.jpg';
                temuanData[temuanIndex].perbaikanBy = currentUser;
                temuanData[temuanIndex].perbaikanDate = perbaikanTimestamp;
                
                localStorage.setItem('gmpTemuanData', JSON.stringify(temuanData));
                
                // Reset form
                event.target.reset();
                document.getElementById('temuanInfo').classList.add('hidden');
                document.getElementById('perhitunganHari').textContent = 'Akan dihitung otomatis saat submit perbaikan';
                document.getElementById('tanggalPerbaikan').value = '';
                
                showSuccessMessage(`Perbaikan berhasil disimpan. Status temuan ${nomorDokumen} telah diubah menjadi Closed. Waktu penyelesaian: ${completionTime}, Poin: ${points}`);
                loadOpenDocuments();
                updateRekapData();
            }
        }

        // Update rekap data
        function updateRekapData() {
            const filterDepartment = document.getElementById('filterDepartment').value;
            let filteredData = temuanData;
            
            if (filterDepartment) {
                filteredData = temuanData.filter(item => item.picTemuan === filterDepartment);
            }
            
            const totalTemuan = filteredData.length;
            const openTemuan = filteredData.filter(item => item.statusTemuan === 'Open').length;
            const closedTemuan = filteredData.filter(item => item.statusTemuan === 'Closed').length;
            
            document.getElementById('totalTemuan').textContent = totalTemuan;
            document.getElementById('openTemuan').textContent = openTemuan;
            document.getElementById('closedTemuan').textContent = closedTemuan;
            
            // Update department statistics
            updateDepartmentStats();
            
            // Update table
            const tbody = document.getElementById('rekapTableBody');
            tbody.innerHTML = '';
            
            // Show/hide action header based on user role
            const actionHeader = document.getElementById('actionHeader');
            if (currentUser === 'SUPER_ADMIN') {
                actionHeader.style.display = 'table-cell';
            } else {
                actionHeader.style.display = 'none';
            }

            if (filteredData.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="${currentUser === 'SUPER_ADMIN' ? '9' : '8'}" class="border border-gray-300 px-4 py-8 text-center text-gray-500">
                            ${filterDepartment ? `Belum ada data temuan untuk departemen ${filterDepartment}` : 'Belum ada data temuan'}
                        </td>
                    </tr>
                `;
            } else {
                filteredData.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="border border-gray-300 px-4 py-3 text-sm">
                            ${item.statusTemuan === 'Open' && canAccessPerbaikan(item) ? 
                                `<button onclick="goToInputPerbaikan('${item.nomorDokumen}')" class="text-blue-600 hover:text-blue-800 underline font-medium">${item.nomorDokumen}</button>` : 
                                item.nomorDokumen
                            }
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-sm">${item.tanggalTemuan}</td>
                        <td class="border border-gray-300 px-4 py-3 text-sm">${item.deskripsiTemuan}</td>
                        <td class="border border-gray-300 px-4 py-3 text-sm">${item.lokasiTemuan}</td>
                        <td class="border border-gray-300 px-4 py-3 text-sm">${item.picTemuan}</td>
                        <td class="border border-gray-300 px-4 py-3 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-medium ${item.statusTemuan === 'Open' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'}">
                                ${item.statusTemuan}
                            </span>
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-sm">${item.waktuPenyelesaian || '-'}</td>
                        <td class="border border-gray-300 px-4 py-3 text-sm">
                            ${item.poin ? `<span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">${item.poin}</span>` : '-'}
                        </td>
                        ${currentUser === 'SUPER_ADMIN' ? 
                            `<td class="border border-gray-300 px-4 py-3 text-sm">
                                <button onclick="deleteTemuan('${item.nomorDokumen}')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition-colors">
                                    🗑️ Hapus
                                </button>
                            </td>` : ''
                        }
                    `;
                    tbody.appendChild(row);
                });
            }
        }

        // Update department statistics
        function updateDepartmentStats() {
            const departments = ['BC', 'SH', 'FP', 'SP', 'WH', 'ENG', 'QC', 'PGA'];
            const departmentStatsContainer = document.getElementById('departmentStats');
            departmentStatsContainer.innerHTML = '';
            
            departments.forEach(dept => {
                const deptData = temuanData.filter(item => item.picTemuan === dept);
                const total = deptData.length;
                const closed = deptData.filter(item => item.statusTemuan === 'Closed').length;
                const percentage = total > 0 ? Math.round((closed / total) * 100) : 0;
                
                // Calculate total completion time and points
                const closedData = deptData.filter(item => item.statusTemuan === 'Closed');
                const totalPoinTambahan = closedData.reduce((sum, item) => sum + (item.poin || 0), 0);
                const totalPoin = total + totalPoinTambahan;
                
                // Calculate average completion time in hours
                let totalHours = 0;
                closedData.forEach(item => {
                    if (item.timestampTemuan && item.timestampPerbaikan) {
                        const start = new Date(item.timestampTemuan);
                        const end = new Date(item.timestampPerbaikan);
                        const diffHours = Math.ceil((end - start) / (1000 * 60 * 60));
                        totalHours += diffHours;
                    }
                });
                const avgHours = closed > 0 ? Math.round(totalHours / closed) : 0;
                const avgDays = Math.round(avgHours / 24 * 10) / 10; // Round to 1 decimal
                
                const statCard = document.createElement('div');
                statCard.className = 'bg-white border border-gray-200 rounded-lg p-4 shadow-sm';
                statCard.innerHTML = `
                    <div class="text-center">
                        <h4 class="font-bold text-gray-800 text-lg mb-2">${dept}</h4>
                        
                        <!-- Completion Percentage -->
                        <div class="mb-3">
                            <div class="text-lg font-bold ${percentage >= 80 ? 'text-green-600' : percentage >= 60 ? 'text-yellow-600' : 'text-red-600'} mb-1">
                                ${percentage}%
                            </div>
                            <div class="text-xs text-gray-500 mb-2">
                                ${closed}/${total} selesai
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-3">
                                <div class="h-1.5 rounded-full ${percentage >= 80 ? 'bg-green-500' : percentage >= 60 ? 'bg-yellow-500' : 'bg-red-500'}" style="width: ${percentage}%"></div>
                            </div>
                        </div>
                        
                        <!-- Total Completion Time -->
                        <div class="mb-2">
                            <div class="text-xs text-gray-600 font-medium">Total Waktu Perbaikan</div>
                            <div class="text-sm font-semibold text-blue-600">
                                ${Math.round(totalHours / 24)} hari
                            </div>
                        </div>
                        
                        <!-- Total Points -->
                        <div>
                            <div class="text-xs text-gray-600 font-medium">Total Poin Ketidaksesuaian</div>
                            <div class="text-sm font-semibold text-purple-600">
                                ${totalPoin}
                            </div>
                        </div>
                    </div>
                `;
                departmentStatsContainer.appendChild(statCard);
            });
        }

        // Download Excel - All Data
        function downloadExcel() {
            if (temuanData.length === 0) {
                showSuccessMessage('Tidak ada data untuk didownload');
                return;
            }
            
            let csvContent = "data:text/csv;charset=utf-8,";
            csvContent += "No Dokumen,Tanggal Temuan,Deskripsi,Keterangan,Lokasi,PIC,Status,Tanggal Perbaikan,Waktu Penyelesaian,Poin Tambahan\n";
            
            temuanData.forEach(item => {
                const row = [
                    item.nomorDokumen,
                    item.tanggalTemuan,
                    `"${item.deskripsiTemuan}"`,
                    `"${item.keteranganTemuan}"`,
                    `"${item.lokasiTemuan}"`,
                    item.picTemuan,
                    item.statusTemuan,
                    item.tanggalPerbaikan || '',
                    item.waktuPenyelesaian || '',
                    item.poin || ''
                ].join(',');
                csvContent += row + "\n";
            });
            
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", `rekap_ketidaksesuaian_semua_${new Date().toISOString().split('T')[0]}.csv`);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // Download My Data - Only for PIC users
        function downloadMyData() {
            const myData = temuanData.filter(item => item.picTemuan === currentUser);
            
            if (myData.length === 0) {
                showSuccessMessage(`Tidak ada data temuan untuk departemen ${currentUser}`);
                return;
            }
            
            let csvContent = "data:text/csv;charset=utf-8,";
            csvContent += "No Dokumen,Tanggal Temuan,Deskripsi,Keterangan,Lokasi,PIC,Status,Tanggal Perbaikan,Waktu Penyelesaian,Poin Tambahan\n";
            
            myData.forEach(item => {
                const row = [
                    item.nomorDokumen,
                    item.tanggalTemuan,
                    `"${item.deskripsiTemuan}"`,
                    `"${item.keteranganTemuan}"`,
                    `"${item.lokasiTemuan}"`,
                    item.picTemuan,
                    item.statusTemuan,
                    item.tanggalPerbaikan || '',
                    item.waktuPenyelesaian || '',
                    item.poin || ''
                ].join(',');
                csvContent += row + "\n";
            });
            
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", `rekap_ketidaksesuaian_${currentUser}_${new Date().toISOString().split('T')[0]}.csv`);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // Show success message
        function showSuccessMessage(message) {
            document.getElementById('successMessage').textContent = message;
            document.getElementById('successModal').classList.remove('hidden');
        }

        // Close modal
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Check if user can access perbaikan for specific item
        function canAccessPerbaikan(item) {
            if (currentUser === 'SUPER_ADMIN') {
                return true;
            }
            
            // Check if current user matches the PIC
            if (item.picTemuan === currentUser) {
                return true;
            }
            
            // For custom users, check if their role matches the PIC
            const customUser = customUsers.find(u => u.username === currentUser && u.status === 'active');
            if (customUser && customUser.role === item.picTemuan) {
                return true;
            }
            
            return false;
        }

        // Navigate to input perbaikan with selected document
        function goToInputPerbaikan(nomorDokumen) {
            // Check if user has permission to access input perbaikan
            const permissions = getUserPermissions(currentUser);
            if (!permissions.includes('input2')) {
                showSuccessMessage('Anda tidak memiliki akses untuk input perbaikan');
                return;
            }
            
            // Switch to input perbaikan tab
            showTab('input2');
            
            // Set the selected document
            setTimeout(() => {
                const selectElement = document.getElementById('nomorDokumen');
                selectElement.value = nomorDokumen;
                loadTemuanData();
                
                // Set current timestamp for repair
                const now = new Date();
                const timestamp = now.toLocaleString('id-ID', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
                document.getElementById('tanggalPerbaikan').value = timestamp;
                
                // Show calculation preview
                const temuan = temuanData.find(item => item.nomorDokumen === nomorDokumen);
                if (temuan) {
                    const startTime = new Date(temuan.timestampTemuan);
                    const currentTime = new Date();
                    const diffHours = Math.ceil((currentTime - startTime) / (1000 * 60 * 60));
                    const points = calculatePoints(temuan.timestampTemuan, currentTime.toISOString());
                    const completionTime = formatCompletionTime(temuan.timestampTemuan, currentTime.toISOString());
                    
                    document.getElementById('perhitunganHari').innerHTML = `
                        <strong>Waktu Penyelesaian:</strong> ${completionTime}<br>
                        <strong>Poin yang akan diperoleh:</strong> ${points}<br>
                        <small class="text-gray-500">Dihitung dari waktu temuan sampai sekarang</small>
                    `;
                }
            }, 100);
        }

        // Delete temuan (Super Admin only)
        function deleteTemuan(nomorDokumen) {
            if (currentUser !== 'SUPER_ADMIN') {
                showSuccessMessage('Hanya Super Admin yang dapat menghapus data temuan');
                return;
            }
            
            // Create custom confirmation modal
            const confirmModal = document.createElement('div');
            confirmModal.className = 'fixed inset-0 modal-backdrop flex items-center justify-center z-50';
            confirmModal.innerHTML = `
                <div class="bg-white rounded-xl shadow-2xl p-8 max-w-md mx-4">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-white text-2xl">⚠️</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Konfirmasi Hapus</h3>
                        <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus temuan dengan nomor dokumen <strong>${nomorDokumen}</strong>?</p>
                        <div class="flex gap-4 justify-center">
                            <button onclick="confirmDelete('${nomorDokumen}'); document.body.removeChild(this.closest('.fixed'))" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                                Ya, Hapus
                            </button>
                            <button onclick="document.body.removeChild(this.closest('.fixed'))" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-2 px-6 rounded-lg transition-colors">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(confirmModal);
        }

        // Confirm delete temuan
        function confirmDelete(nomorDokumen) {
            const temuanIndex = temuanData.findIndex(item => item.nomorDokumen === nomorDokumen);
            
            if (temuanIndex !== -1) {
                temuanData.splice(temuanIndex, 1);
                localStorage.setItem('gmpTemuanData', JSON.stringify(temuanData));
                
                showSuccessMessage(`Temuan ${nomorDokumen} berhasil dihapus`);
                updateRekapData();
                loadOpenDocuments();
            }
        }

        // Toggle password reference
        function togglePasswordRef() {
            const content = document.getElementById('passwordRefContent');
            const icon = document.getElementById('passwordRefIcon');
            
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                content.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }

        // Initialize analisa filters
        function initializeAnalisaFilters() {
            const currentYear = new Date().getFullYear();
            const currentMonth = new Date().getMonth() + 1;
            
            // Populate year filter
            const yearSelect = document.getElementById('filterTahun');
            yearSelect.innerHTML = '';
            
            // Add years from 2020 to current year + 2
            for (let year = 2020; year <= currentYear + 2; year++) {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                if (year === currentYear) {
                    option.selected = true;
                }
                yearSelect.appendChild(option);
            }
            
            // Set current month
            document.getElementById('filterBulan').value = currentMonth;
        }

        // Toggle periode filter
        function togglePeriodeFilter() {
            const periode = document.getElementById('filterPeriode').value;
            const bulananContainer = document.getElementById('filterBulananContainer');
            
            if (periode === 'tahunan') {
                bulananContainer.style.display = 'none';
            } else {
                bulananContainer.style.display = 'flex';
            }
            
            updateAnalisaBulanan();
        }

        // Update analisa bulanan
        function updateAnalisaBulanan() {
            const periode = document.getElementById('filterPeriode').value;
            const selectedYear = parseInt(document.getElementById('filterTahun').value);
            
            let filteredData;
            
            if (periode === 'tahunan') {
                // Filter data by selected year only
                filteredData = temuanData.filter(item => {
                    const itemDate = new Date(item.timestampTemuan);
                    return itemDate.getFullYear() === selectedYear;
                });
            } else {
                // Filter data by selected month and year
                const selectedMonth = parseInt(document.getElementById('filterBulan').value);
                filteredData = temuanData.filter(item => {
                    const itemDate = new Date(item.timestampTemuan);
                    return itemDate.getMonth() + 1 === selectedMonth && itemDate.getFullYear() === selectedYear;
                });
            }
            
            // Calculate summary statistics
            const totalTemuan = filteredData.length;
            const closedTemuan = filteredData.filter(item => item.statusTemuan === 'Closed').length;
            const openTemuan = totalTemuan - closedTemuan;
            const totalPoinTambahan = filteredData.reduce((sum, item) => sum + (item.poin || 0), 0);
            const totalPoin = totalTemuan + totalPoinTambahan;
            
            // Update summary cards
            document.getElementById('totalTemuanBulan').textContent = totalTemuan;
            document.getElementById('totalClosedBulan').textContent = closedTemuan;
            document.getElementById('totalOpenBulan').textContent = openTemuan;
            document.getElementById('totalPoinBulan').textContent = totalPoin;
            
            // Generate area analysis
            generateAreaAnalysis(filteredData, periode);
        }

        // Generate area analysis
        function generateAreaAnalysis(filteredData, periode) {
            const areas = ['BC', 'SH', 'FP', 'SP', 'WH', 'ENG', 'QC', 'PGA'];
            const tableBody = document.getElementById('analisaTableBody');
            tableBody.innerHTML = '';
            
            const areaStats = [];
            
            areas.forEach(area => {
                const areaData = filteredData.filter(item => item.picTemuan === area);
                const total = areaData.length;
                const closed = areaData.filter(item => item.statusTemuan === 'Closed').length;
                const percentage = total > 0 ? Math.round((closed / total) * 100) : 0;
                
                // Calculate total completion time in days
                const closedData = areaData.filter(item => item.statusTemuan === 'Closed');
                let totalDays = 0;
                closedData.forEach(item => {
                    if (item.timestampTemuan && item.timestampPerbaikan) {
                        const start = new Date(item.timestampTemuan);
                        const end = new Date(item.timestampPerbaikan);
                        const startDate = new Date(start.getFullYear(), start.getMonth(), start.getDate());
                        const endDate = new Date(end.getFullYear(), end.getMonth(), end.getDate());
                        const diffDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
                        totalDays += diffDays;
                    }
                });
                
                const totalPoinTambahan = areaData.reduce((sum, item) => sum + (item.poin || 0), 0);
                const totalPoin = total + totalPoinTambahan;
                
                const stats = {
                    area,
                    total,
                    closed,
                    percentage,
                    totalDays,
                    totalPoin
                };
                
                areaStats.push(stats);
                
                // Create table row
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="border border-gray-300 px-4 py-3 text-sm font-medium">${area}</td>
                    <td class="border border-gray-300 px-4 py-3 text-sm text-center">${total}</td>
                    <td class="border border-gray-300 px-4 py-3 text-sm text-center">${closed}</td>
                    <td class="border border-gray-300 px-4 py-3 text-sm text-center">
                        <span class="px-2 py-1 rounded-full text-xs font-medium ${percentage >= 80 ? 'bg-green-100 text-green-800' : percentage >= 60 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'}">
                            ${percentage}%
                        </span>
                    </td>
                    <td class="border border-gray-300 px-4 py-3 text-sm text-center">${totalDays}</td>
                    <td class="border border-gray-300 px-4 py-3 text-sm text-center">
                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            ${totalPoin}
                        </span>
                    </td>
                `;
                tableBody.appendChild(row);
            });
            
            // Generate charts
            generateRankingChart(areaStats);
            generateCompletionChart(areaStats);
        }

        // Generate ranking chart (best departments based on completion rate and low points)
        function generateRankingChart(areaStats) {
            const chartContainer = document.getElementById('rankingChart');
            chartContainer.innerHTML = '';
            
            // Filter areas with data and calculate ranking score
            const areasWithData = areaStats.filter(stat => stat.total > 0);
            
            // Calculate ranking score: higher completion rate and lower points per completion = better
            areasWithData.forEach(stat => {
                const avgPointsPerCompletion = stat.closed > 0 ? stat.totalPoin / stat.closed : 999;
                // Score = completion percentage - (average points per completion * 5)
                // This rewards high completion rate and penalizes high points (slow completion)
                stat.rankingScore = stat.percentage - (avgPointsPerCompletion * 5);
            });
            
            // Sort by ranking score (descending - higher is better)
            const sortedStats = areasWithData.sort((a, b) => b.rankingScore - a.rankingScore);
            
            sortedStats.forEach((stat, index) => {
                const rankContainer = document.createElement('div');
                rankContainer.className = 'flex items-center space-x-3 mb-3 p-3 bg-white rounded-lg border';
                
                const rankColor = index === 0 ? 'bg-yellow-500' : 
                                index === 1 ? 'bg-gray-400' : 
                                index === 2 ? 'bg-orange-600' : 'bg-blue-500';
                
                const medal = index === 0 ? '🥇' : 
                            index === 1 ? '🥈' : 
                            index === 2 ? '🥉' : `${index + 1}`;
                
                const avgPoints = stat.closed > 0 ? Math.round((stat.totalPoin / stat.closed) * 10) / 10 : 0;
                
                rankContainer.innerHTML = `
                    <div class="w-8 h-8 ${rankColor} rounded-full flex items-center justify-center text-white font-bold text-sm">
                        ${typeof medal === 'string' && medal.includes('🏆') ? medal : index < 3 ? medal : index + 1}
                    </div>
                    <div class="flex-1">
                        <div class="font-semibold text-gray-800">${stat.area}</div>
                        <div class="text-xs text-gray-600">
                            ${stat.percentage}% selesai • Rata-rata ${avgPoints} poin/temuan
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-medium text-gray-800">${stat.closed}/${stat.total}</div>
                        <div class="text-xs text-gray-500">${stat.totalPoin} total poin</div>
                    </div>
                `;
                chartContainer.appendChild(rankContainer);
            });
            
            if (areasWithData.length === 0) {
                chartContainer.innerHTML = '<div class="text-center text-gray-500 py-4">Belum ada data untuk ditampilkan</div>';
            }
        }

        // Generate completion chart
        function generateCompletionChart(areaStats) {
            const chartContainer = document.getElementById('completionChart');
            chartContainer.innerHTML = '';
            
            // Sort by completion percentage (descending)
            const sortedStats = [...areaStats].sort((a, b) => b.percentage - a.percentage);
            
            sortedStats.forEach(stat => {
                if (stat.total > 0) {
                    const barContainer = document.createElement('div');
                    barContainer.className = 'flex items-center space-x-3 mb-2';
                    
                    const barColor = stat.percentage >= 80 ? 'bg-green-500' : 
                                   stat.percentage >= 60 ? 'bg-yellow-500' : 'bg-red-500';
                    
                    barContainer.innerHTML = `
                        <div class="w-8 text-xs font-medium text-gray-700">${stat.area}</div>
                        <div class="flex-1 bg-gray-200 rounded-full h-4 relative">
                            <div class="${barColor} h-4 rounded-full transition-all duration-500" style="width: ${stat.percentage}%"></div>
                            <div class="absolute inset-0 flex items-center justify-center text-xs font-medium text-white">
                                ${stat.percentage}%
                            </div>
                        </div>
                        <div class="w-16 text-xs text-gray-600">${stat.closed}/${stat.total}</div>
                    `;
                    chartContainer.appendChild(barContainer);
                }
            });
        }

        // User Management Functions

        // Populate login users dropdown
        function populateLoginUsers() {
            const loginSelect = document.getElementById('loginUser');
            
            // Clear existing options except the first one
            const firstOption = loginSelect.firstElementChild;
            loginSelect.innerHTML = '';
            loginSelect.appendChild(firstOption);
            
            // Add default users
            Object.keys(defaultUserPermissions).forEach(username => {
                const option = document.createElement('option');
                option.value = username;
                if (username === 'USER_A') {
                    option.textContent = '👤 User A (Input Temuan)';
                } else if (username === 'MANAGER') {
                    option.textContent = '👔 Manager (View Only)';
                } else if (username === 'SUPER_ADMIN') {
                    option.textContent = '⚡ Super Admin';
                } else {
                    option.textContent = `🔧 ${username} (Perbaikan)`;
                }
                loginSelect.appendChild(option);
            });
            
            // Add custom users to login dropdown
            customUsers.forEach(user => {
                if (user.status === 'active') {
                    const option = document.createElement('option');
                    option.value = user.username;
                    option.textContent = `👤 ${user.username} (${user.role})`;
                    loginSelect.appendChild(option);
                }
            });
        }

        // Add new user
        function addNewUser(event) {
            event.preventDefault();
            
            const username = document.getElementById('newUsername').value.trim();
            const password = document.getElementById('newPassword').value;
            const role = document.getElementById('newUserRole').value;
            const status = document.getElementById('newUserStatus').value;
            
            // Get selected permissions
            const permissions = [];
            if (document.getElementById('authInput1').checked) permissions.push('input1');
            if (document.getElementById('authInput2').checked) permissions.push('input2');
            if (document.getElementById('authRekap').checked) permissions.push('rekap');
            if (document.getElementById('authAnalisa').checked) permissions.push('analisa');
            
            // Validation
            if (!username || !password || !role) {
                showSuccessMessage('Semua field wajib diisi!');
                return;
            }
            
            if (permissions.length === 0) {
                showSuccessMessage('Minimal pilih satu otorisasi akses!');
                return;
            }
            
            // Check if username already exists
            const allUsers = [...Object.keys(defaultUserPasswords), ...customUsers.map(u => u.username)];
            if (allUsers.includes(username)) {
                showSuccessMessage('Username sudah ada! Gunakan username lain.');
                return;
            }
            
            // Create new user
            const newUser = {
                id: Date.now().toString(),
                username: username,
                password: password,
                role: role,
                status: status,
                permissions: permissions,
                createdAt: new Date().toISOString(),
                createdBy: currentUser
            };
            
            customUsers.push(newUser);
            localStorage.setItem('gmpCustomUsers', JSON.stringify(customUsers));
            
            // Reset form
            event.target.reset();
            
            // Refresh displays
            loadUserList();
            populateLoginUsers();
            
            showSuccessMessage(`User ${username} berhasil ditambahkan!`);
        }

        // Load user list
        function loadUserList() {
            const tbody = document.getElementById('userListTableBody');
            tbody.innerHTML = '';
            
            // Show default users
            Object.keys(defaultUserPermissions).forEach(username => {
                const permissions = defaultUserPermissions[username];
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="border border-gray-300 px-4 py-3 text-sm font-medium">${username}</td>
                    <td class="border border-gray-300 px-4 py-3 text-sm">${username}</td>
                    <td class="border border-gray-300 px-4 py-3 text-sm">
                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            ✅ Default User
                        </span>
                    </td>
                    <td class="border border-gray-300 px-4 py-3 text-sm">
                        ${permissions.map(p => getPermissionLabel(p)).join(', ')}
                    </td>
                    <td class="border border-gray-300 px-4 py-3 text-sm text-gray-500">-</td>
                    <td class="border border-gray-300 px-4 py-3 text-sm text-gray-500">Default User</td>
                `;
                tbody.appendChild(row);
            });
            
            // Show custom users
            customUsers.forEach(user => {
                const row = document.createElement('tr');
                const createdDate = new Date(user.createdAt).toLocaleDateString('id-ID');
                
                row.innerHTML = `
                    <td class="border border-gray-300 px-4 py-3 text-sm font-medium">${user.username}</td>
                    <td class="border border-gray-300 px-4 py-3 text-sm">${user.role}</td>
                    <td class="border border-gray-300 px-4 py-3 text-sm">
                        <span class="px-2 py-1 rounded-full text-xs font-medium ${user.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                            ${user.status === 'active' ? '✅ Aktif' : '❌ Tidak Aktif'}
                        </span>
                    </td>
                    <td class="border border-gray-300 px-4 py-3 text-sm">
                        ${user.permissions.map(p => getPermissionLabel(p)).join(', ')}
                    </td>
                    <td class="border border-gray-300 px-4 py-3 text-sm">${createdDate}</td>
                    <td class="border border-gray-300 px-4 py-3 text-sm">
                        <div class="flex gap-2">
                            <button onclick="editUser('${user.id}')" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs transition-colors">
                                ✏️ Edit
                            </button>
                            <button onclick="toggleUserStatus('${user.id}')" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs transition-colors">
                                ${user.status === 'active' ? '⏸️ Nonaktif' : '▶️ Aktifkan'}
                            </button>
                            <button onclick="deleteUser('${user.id}')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition-colors">
                                🗑️ Hapus
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
            
            if (Object.keys(defaultUserPermissions).length + customUsers.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="border border-gray-300 px-4 py-8 text-center text-gray-500">
                            Belum ada user yang terdaftar
                        </td>
                    </tr>
                `;
            }
        }

        // Get permission label
        function getPermissionLabel(permission) {
            const labels = {
                'input1': 'Input Temuan',
                'input2': 'Input Perbaikan',
                'rekap': 'Rekap Data',
                'analisa': 'Analisa Bulanan',
                'userManagement': 'Manajemen User'
            };
            return labels[permission] || permission;
        }

        // Toggle user status
        function toggleUserStatus(userId) {
            const userIndex = customUsers.findIndex(u => u.id === userId);
            if (userIndex !== -1) {
                const user = customUsers[userIndex];
                const newStatus = user.status === 'active' ? 'inactive' : 'active';
                
                customUsers[userIndex].status = newStatus;
                localStorage.setItem('gmpCustomUsers', JSON.stringify(customUsers));
                
                loadUserList();
                populateLoginUsers();
                
                showSuccessMessage(`Status user ${user.username} berhasil diubah menjadi ${newStatus === 'active' ? 'aktif' : 'tidak aktif'}`);
            }
        }

        // Delete user
        function deleteUser(userId) {
            const user = customUsers.find(u => u.id === userId);
            if (!user) return;
            
            // Create custom confirmation modal
            const confirmModal = document.createElement('div');
            confirmModal.className = 'fixed inset-0 modal-backdrop flex items-center justify-center z-50';
            confirmModal.innerHTML = `
                <div class="bg-white rounded-xl shadow-2xl p-8 max-w-md mx-4">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-white text-2xl">⚠️</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Konfirmasi Hapus User</h3>
                        <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus user <strong>${user.username}</strong>?</p>
                        <div class="flex gap-4 justify-center">
                            <button onclick="confirmDeleteUser('${userId}'); document.body.removeChild(this.closest('.fixed'))" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                                Ya, Hapus
                            </button>
                            <button onclick="document.body.removeChild(this.closest('.fixed'))" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-2 px-6 rounded-lg transition-colors">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(confirmModal);
        }

        // Confirm delete user
        function confirmDeleteUser(userId) {
            const userIndex = customUsers.findIndex(u => u.id === userId);
            if (userIndex !== -1) {
                const username = customUsers[userIndex].username;
                customUsers.splice(userIndex, 1);
                localStorage.setItem('gmpCustomUsers', JSON.stringify(customUsers));
                
                loadUserList();
                populateLoginUsers();
                
                showSuccessMessage(`User ${username} berhasil dihapus`);
            }
        }

        // Edit user
        function editUser(userId) {
            const user = customUsers.find(u => u.id === userId);
            if (!user) return;
            
            // Create edit modal
            const editModal = document.createElement('div');
            editModal.className = 'fixed inset-0 modal-backdrop flex items-center justify-center z-50';
            editModal.innerHTML = `
                <div class="bg-white rounded-xl shadow-2xl p-8 max-w-2xl mx-4 w-full">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Edit User: ${user.username}</h3>
                        <p class="text-gray-600">Ubah informasi dan otorisasi user</p>
                    </div>
                    
                    <form onsubmit="updateUser(event, '${userId}')" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                                <input type="text" id="editUsername" value="${user.username}" readonly class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed">
                                <p class="text-xs text-gray-500 mt-1">Username tidak dapat diubah</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                                <input type="password" id="editPassword" placeholder="Kosongkan jika tidak ingin mengubah" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Role/Departemen</label>
                                <select id="editUserRole" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="BC" ${user.role === 'BC' ? 'selected' : ''}>BC</option>
                                    <option value="SH" ${user.role === 'SH' ? 'selected' : ''}>SH</option>
                                    <option value="FP" ${user.role === 'FP' ? 'selected' : ''}>FP</option>
                                    <option value="SP" ${user.role === 'SP' ? 'selected' : ''}>SP</option>
                                    <option value="WH" ${user.role === 'WH' ? 'selected' : ''}>WH</option>
                                    <option value="ENG" ${user.role === 'ENG' ? 'selected' : ''}>ENG</option>
                                    <option value="QC" ${user.role === 'QC' ? 'selected' : ''}>QC</option>
                                    <option value="PGA" ${user.role === 'PGA' ? 'selected' : ''}>PGA</option>
                                    <option value="USER_INPUT" ${user.role === 'USER_INPUT' ? 'selected' : ''}>User Input</option>
                                    <option value="MANAGER" ${user.role === 'MANAGER' ? 'selected' : ''}>Manager</option>
                                    <option value="ADMIN" ${user.role === 'ADMIN' ? 'selected' : ''}>Admin</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <select id="editUserStatus" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="active" ${user.status === 'active' ? 'selected' : ''}>Aktif</option>
                                    <option value="inactive" ${user.status === 'inactive' ? 'selected' : ''}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Otorisasi Akses</label>
                            <div class="flex flex-wrap gap-3">
                                <label class="flex items-center">
                                    <input type="checkbox" id="editAuthInput1" ${user.permissions.includes('input1') ? 'checked' : ''} class="mr-2 rounded">
                                    <span class="text-sm">Input Temuan</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" id="editAuthInput2" ${user.permissions.includes('input2') ? 'checked' : ''} class="mr-2 rounded">
                                    <span class="text-sm">Input Perbaikan</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" id="editAuthRekap" ${user.permissions.includes('rekap') ? 'checked' : ''} class="mr-2 rounded">
                                    <span class="text-sm">Rekap Data</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" id="editAuthAnalisa" ${user.permissions.includes('analisa') ? 'checked' : ''} class="mr-2 rounded">
                                    <span class="text-sm">Analisa Bulanan</span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="flex gap-4 justify-end pt-4">
                            <button type="button" onclick="document.body.removeChild(this.closest('.fixed'))" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-2 px-6 rounded-lg transition-colors">
                                Batal
                            </button>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            `;
            document.body.appendChild(editModal);
        }

        // Update user
        function updateUser(event, userId) {
            event.preventDefault();
            
            const userIndex = customUsers.findIndex(u => u.id === userId);
            if (userIndex === -1) return;
            
            const newPassword = document.getElementById('editPassword').value.trim();
            const role = document.getElementById('editUserRole').value;
            const status = document.getElementById('editUserStatus').value;
            
            // Get selected permissions
            const permissions = [];
            if (document.getElementById('editAuthInput1').checked) permissions.push('input1');
            if (document.getElementById('editAuthInput2').checked) permissions.push('input2');
            if (document.getElementById('editAuthRekap').checked) permissions.push('rekap');
            if (document.getElementById('editAuthAnalisa').checked) permissions.push('analisa');
            
            // Validation
            if (!role) {
                showSuccessMessage('Role/Departemen wajib dipilih!');
                return;
            }
            
            if (permissions.length === 0) {
                showSuccessMessage('Minimal pilih satu otorisasi akses!');
                return;
            }
            
            // Update user data
            customUsers[userIndex].role = role;
            customUsers[userIndex].status = status;
            customUsers[userIndex].permissions = permissions;
            customUsers[userIndex].updatedAt = new Date().toISOString();
            customUsers[userIndex].updatedBy = currentUser;
            
            // Update password if provided
            if (newPassword) {
                customUsers[userIndex].password = newPassword;
            }
            
            localStorage.setItem('gmpCustomUsers', JSON.stringify(customUsers));
            
            // Close modal
            document.body.removeChild(event.target.closest('.fixed'));
            
            // Refresh displays
            loadUserList();
            populateLoginUsers();
            
            showSuccessMessage(`User ${customUsers[userIndex].username} berhasil diperbarui!`);
        }

        // Export user list
        function exportUserList() {
            const allUsers = [];
            
            // Add default users
            Object.keys(defaultUserPermissions).forEach(username => {
                allUsers.push({
                    username: username,
                    role: username,
                    status: 'Default User',
                    permissions: defaultUserPermissions[username].join(', '),
                    createdAt: '-'
                });
            });
            
            // Add custom users
            customUsers.forEach(user => {
                allUsers.push({
                    username: user.username,
                    role: user.role,
                    status: user.status === 'active' ? 'Aktif' : 'Tidak Aktif',
                    permissions: user.permissions.map(p => getPermissionLabel(p)).join(', '),
                    createdAt: new Date(user.createdAt).toLocaleDateString('id-ID')
                });
            });
            
            let csvContent = "data:text/csv;charset=utf-8,";
            csvContent += "Username,Role,Status,Otorisasi,Tanggal Dibuat\n";
            
            allUsers.forEach(user => {
                const row = [
                    user.username,
                    user.role,
                    user.status,
                    `"${user.permissions}"`,
                    user.createdAt
                ].join(',');
                csvContent += row + "\n";
            });
            
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", `daftar_user_${new Date().toISOString().split('T')[0]}.csv`);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // Refresh user list
        function refreshUserList() {
            loadUserList();
            showSuccessMessage('Daftar user berhasil diperbarui');
        }
    </script>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'991d5f2eb3336d16',t:'MTc2MTAxNDIzMy4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>