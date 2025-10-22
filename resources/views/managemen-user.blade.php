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
                    <div><label for="newUserRole" class="block text-sm font-medium text-gray-700 mb-2">Role/Departemen</label> <select id="newUserRole" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">-- Pilih Role --</option>
                            <option value="BC">BC</option>
                            <option value="SH">SH</option>
                            <option value="FP">FP</option>
                            <option value="SP">SP</option>
                            <option value="WH">WH</option>
                            <option value="ENG">ENG</option>
                            <option value="QC">QC</option>
                            <option value="PGA">PGA</option>
                            <option value="USER_INPUT">User Input</option>
                            <option value="MANAGER">Manager</option>
                            <option value="ADMIN">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label for="newUserStatus" class="block text-sm font-medium text-gray-700 mb-2">Status</label> <select id="newUserStatus" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="active">Aktif</option>
                            <option value="inactive">Tidak Aktif</option>
                        </select>
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