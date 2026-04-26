@extends('layouts.app')

@section('title', 'Kelola Staf')

@section('header')
<div class="bg-[#6B21A8] text-white p-6 md:p-8 rounded-[2rem] relative overflow-hidden border-none shadow-2xl mt-2 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
    <div class="relative z-10">
        <h2 class="text-2xl md:text-3xl font-black mb-2">Manajemen Staf 👑</h2>
        <p class="text-white/90 font-medium text-sm">Kelola data akses untuk Operator dan Dosen Pembimbing.</p>
    </div>
    
    <button onclick="addUserModal.showModal()" class="relative z-10 btn min-h-0 h-10 px-5 rounded-xl bg-white hover:bg-purple-50 text-[#6B21A8] border-none font-black text-xs uppercase tracking-widest shadow-lg self-start md:self-auto">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
        Tambah Staf
    </button>
</div>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/dashboard/admin" class="hover:text-primary transition-colors">SIDUL</a></li> 
    <li>Kelola Staf</li>
  </ul>
</div>
@endsection

@section('content')
<div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden font-sans">
    <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
        <h3 class="font-black text-xl text-gray-800 flex items-center gap-3">
             <span class="w-2 h-6 bg-[#6B21A8] rounded-full"></span>
             Daftar Akses
        </h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="table w-full border-none">
            <thead>
                <tr class="text-gray-400 font-black text-[10px] uppercase tracking-[0.2em] bg-gray-50/30 border-b border-gray-100">
                    <th class="pl-8 py-4">Nama Lengkap</th>
                    <th>Username / NIK</th>
                    <th>Role</th>
                    <th class="pr-8 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $u)
                <tr class="hover:bg-gray-50 transition-all group">
                    <td class="pl-8 py-4 w-1/3">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-purple-50 text-[#6B21A8] font-black flex items-center justify-center text-xs">
                                {{ strtoupper(substr($u->name, 0, 2)) }}
                            </div>
                            <div class="font-bold text-gray-800 text-sm">{{ $u->name }}</div>
                        </div>
                    </td>
                    <td>
                        <div class="text-xs font-black text-gray-500 bg-gray-100 inline-block px-3 py-1 rounded-lg border border-gray-200">{{ $u->username }}</div>
                    </td>
                    <td>
                        @if($u->role === 'dosen')
                            <span class="px-3 py-1.5 rounded-lg bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-wider border border-amber-100">Dosen</span>
                        @else
                            <span class="px-3 py-1.5 rounded-lg bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-wider border border-blue-100">Operator</span>
                        @endif
                    </td>
                    <td class="pr-8 text-right">
                        <form action="{{ route('admin.users.destroy', $u->id_user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini secara permanen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-xl text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors tooltip tooltip-left" data-tip="Hapus Akun">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-20 text-center">
                        <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Tidak ada data staf</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah User -->
<dialog id="addUserModal" class="modal">
    <div class="modal-box rounded-[2rem] p-8 shadow-2xl border border-gray-100">
        <h3 class="font-black text-xl text-gray-800 mb-6">Tambah Akun Baru 🆕</h3>
        
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="space-y-5 font-sans">
                <!-- Role -->
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Tipe Akun (Role)</label>
                    <select name="role" class="select select-bordered w-full rounded-2xl bg-gray-50 border-gray-200 focus:border-[#6B21A8] font-bold text-sm h-12" required>
                        <option value="dosen">Dosen Pembimbing</option>
                        <option value="operator">Operator (Admin)</option>
                    </select>
                </div>
                
                <!-- Nama Lengkap -->
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Nama Lengkap (Serta Gelar Jika Dosen)</label>
                    <input type="text" name="name" class="input input-bordered w-full rounded-2xl bg-gray-50 border-gray-200 focus:border-[#6B21A8] font-bold text-sm h-12" placeholder="Contoh: Dr. Budi Santoso, S.T., M.T." required>
                </div>
                
                <!-- Username / NIK -->
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Username / NIK</label>
                    <input type="text" name="username" class="input input-bordered w-full rounded-2xl bg-gray-50 border-gray-200 focus:border-[#6B21A8] font-bold text-sm h-12" placeholder="Masukkan NIK atau Username" required>
                </div>

                <!-- Password -->
                <div>
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Password Baru</label>
                    <input type="password" name="password" minlength="8" class="input input-bordered w-full rounded-2xl bg-gray-50 border-gray-200 focus:border-[#6B21A8] font-bold text-sm h-12" placeholder="Minimal 8 karakter" required>
                </div>

                <div class="modal-action flex gap-3 pt-4 border-t border-gray-100 mt-6">
                    <button type="button" onclick="addUserModal.close()" class="btn flex-1 rounded-xl bg-white border border-gray-200 text-gray-500 hover:bg-gray-50 font-black text-[10px] uppercase tracking-wider h-12">Batal</button>
                    <button type="submit" class="btn flex-1 rounded-xl bg-[#6B21A8] hover:bg-purple-800 border-none text-white font-black text-[10px] uppercase tracking-wider h-12">Simpan Akun</button>
                </div>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

@endsection
