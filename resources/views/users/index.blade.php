@extends('layouts.layout')

@section('content')
<div id="userManagementTab" class="fade-in">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <span
                    class="w-8 h-8 bg-indigo-500 rounded-full flex items-center justify-center text-white text-sm mr-3">👥</span>
                Manajemen User
            </h2>
            <p class="text-gray-600 mt-2">Kelola akun pengguna dan otorisasi akses sistem</p>
        </div>

        {{-- Tambah User Baru --}}
        <div class="bg-gray-50 rounded-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah User Baru</h3>
            <form action="#" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                        <input type="text" name="username" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role/Departemen</label>
                        <select name="role" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-lg transition-colors">
                        Tambah User
                    </button>
                </div>
            </form>
        </div>

        {{-- Daftar User --}}
        <div class="mb-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Daftar User</h3>
                <div class="flex gap-2">
                    <a href="#"
                        class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors text-sm">📥
                        Export CSV</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">
                                Username</th>
                            <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">
                                Role</th>
                            <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">
                                Status</th>
                            <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">
                                Tanggal Dibuat</th>
                            <th class="border border-gray-300 px-4 py-3 text-left text-sm font-medium text-gray-700">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="border border-gray-300 px-4 py-3 text-sm">{{ $user->name }}</td>
                            <td class="border border-gray-300 px-4 py-3 text-sm">{{ $user->role }}</td>
                            <td class="border border-gray-300 px-4 py-3 text-sm">
                                <span
                                    class="px-3 py-1 rounded-full text-xs {{ $user->status == 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="border border-gray-300 px-4 py-3 text-sm">
                                {{ $user->created_at->format('d M Y') }}</td>
                            <td class="border border-gray-300 px-4 py-3 text-sm">
                                <a href="#" class="text-blue-600 hover:underline">Edit</a>
                                |
                                <form action="#" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline"
                                        onclick="return confirm('Hapus user ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="border border-gray-300 px-4 py-8 text-center text-gray-500">
                                Belum ada data user.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection