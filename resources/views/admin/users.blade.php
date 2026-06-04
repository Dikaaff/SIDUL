@extends('layouts.app')

@section('title', 'Kelola Staf')

@section('header')
<x-page-header 
    title="Manajemen Staf 👑" 
    subtitle="Kelola data akses untuk Operator dan Dosen Pembimbing."
>
    <button onclick="openModalAddUserModal()" class="btn min-h-0 h-10 px-5 rounded bg-white hover:bg-purple-50 text-[#6B21A8] border-none font-black text-xs uppercase tracking-widest shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
        Tambah Staf
    </button>
</x-page-header>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/dashboard/admin" class="hover:text-[#6B21A8] transition-colors">SIDUL</a></li> 
    <li>Kelola Staf</li>
  </ul>
</div>
@endsection

@section('content')
<div class="space-y-6">
    {{-- Main Container --}}
    <div class="bg-white rounded border border-gray-100 shadow-sm overflow-hidden font-sans">
        <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/10 flex items-center justify-between">
            <h3 class="font-black text-xl text-gray-800 flex items-center gap-3 italic">
                 <span class="w-2 h-8 bg-[#6B21A8] rounded-full shadow-lg shadow-purple-200"></span>
                 Daftar Akses Sistem
            </h3>
        </div>
        
        <div class="p-4 md:p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 md:gap-6">
                @forelse($users as $u)
                <div class="bg-white hover:bg-gray-50 border border-gray-100 rounded p-6 transition-all group shadow-sm hover:shadow-md flex flex-col justify-between">
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded bg-purple-50 text-[#6B21A8] font-black flex items-center justify-center text-lg shadow-inner group-hover:rotate-3 transition-transform">
                                {{ strtoupper(substr($u->name, 0, 2)) }}
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-black text-gray-800 text-sm tracking-tight truncate leading-tight">{{ $u->name }}</h4>
                                <div class="text-[10px] font-bold text-gray-400 mt-1 flex items-center gap-2">
                                    <span class="uppercase tracking-widest">{{ $u->username }}</span>
                                </div>
                            </div>
                        </div>
                        
                        @if($u->role === 'dosen')
                            <span class="px-3 py-1 rounded bg-amber-50 text-amber-600 text-[8px] font-black uppercase tracking-[0.15em] border border-amber-100">Dosen</span>
                        @else
                            <span class="px-3 py-1 rounded bg-blue-50 text-blue-600 text-[8px] font-black uppercase tracking-[0.15em] border border-blue-100">Operator</span>
                        @endif
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-50 mt-auto">
                        <div class="flex items-center gap-1">
                            <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div>
                            <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic">Active Access</span>
                        </div>
                        
                        <button type="button" aria-label="Hapus pengguna" onclick="confirmDelete('{{ $u->id }}', '{{ addslashes($u->name) }}')" class="p-2.5 rounded text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all active:scale-95 group/btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover/btn:rotate-12 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-24 text-center">
                    <div class="w-24 h-24 bg-gray-50 rounded flex items-center justify-center mx-auto mb-6 text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <h4 class="text-xl font-black text-gray-800 uppercase italic tracking-tighter">Tidak Ada Data Staf</h4>
                    <p class="text-gray-500 font-medium text-sm mt-2">Belum ada akun Operator atau Dosen yang terdaftar di sistem.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah User -->
<x-modal id="add_user_modal" title="Tambah Akun Baru" size="md">
    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="space-y-5 font-sans">
            <!-- Role -->
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Tipe Akun (Role)</label>
                <select name="role" class="select select-bordered w-full rounded bg-gray-50 border-gray-100 focus:border-[#6B21A8]/30 font-bold text-sm h-14" required>
                    <option value="dosen">Dosen</option>
                    <option value="operator">Operator (Admin)</option>
                </select>
            </div>
            
            <!-- Nama Lengkap -->
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Nama Lengkap & Gelar</label>
                <input type="text" name="name" class="input input-bordered w-full rounded bg-gray-50 border-gray-100 focus:border-[#6B21A8]/30 font-bold text-sm h-14" placeholder="Contoh: Dr. Budi Santoso, S.T., M.T." required>
            </div>
            
            <!-- Username / NIK -->
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Username / NIK</label>
                <input type="text" name="username" class="input input-bordered w-full rounded bg-gray-50 border-gray-100 focus:border-[#6B21A8]/30 font-bold text-sm h-14" placeholder="Masukkan NIK atau Username" required>
            </div>

            <!-- Password -->
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Password Baru</label>
                <input type="password" name="password" minlength="8" class="input input-bordered w-full rounded bg-gray-50 border-gray-100 focus:border-[#6B21A8]/30 font-bold text-sm h-14" placeholder="Minimal 8 karakter" required>
            </div>

            <div class="flex flex-col gap-3 pt-6 border-t border-gray-50 mt-8">
                <button type="submit" class="btn h-14 rounded bg-[#6B21A8] hover:bg-purple-800 border-none text-white font-black text-xs uppercase tracking-widest shadow-lg shadow-purple-900/20 active:scale-95 transition-all">
                    Simpan Akun Baru
                </button>
                <button type="button" onclick="closeModalAddUserModal()" class="btn h-14 rounded bg-gray-50 hover:bg-gray-100 border-none text-gray-500 font-black text-xs uppercase tracking-widest transition-all">
                    Batalkan
                </button>
            </div>
        </div>
    </form>
</x-modal>

<!-- Modal Konfirmasi Hapus -->
<x-modal id="delete_user_modal" title="Hapus Akun" subtitle="Tindakan ini tidak dapat dibatalkan." size="sm">
    <div class="space-y-6">
        <div class="flex items-center gap-4 p-5 bg-red-50 rounded border border-red-100">
            <div class="w-12 h-12 rounded bg-red-100 flex items-center justify-center text-red-600 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            </div>
            <div>
                <p class="font-black text-gray-800 text-sm">Hapus <span id="deleteUserName" class="text-red-600"></span>?</p>
                <p class="text-[10px] font-bold text-gray-500 mt-1">Akun ini akan dihapus secara permanen dari sistem.</p>
            </div>
        </div>

        <form id="deleteUserForm" method="POST" class="flex flex-col gap-3 pt-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn h-14 rounded bg-red-500 hover:bg-red-600 border-none text-white font-black text-xs uppercase tracking-widest shadow-lg shadow-red-500/20 active:scale-95 transition-all">
                Ya, Hapus Akun
            </button>
            <button type="button" onclick="closeModalDeleteUserModal()" class="btn h-14 rounded bg-gray-50 hover:bg-gray-100 border-none text-gray-500 font-black text-xs uppercase tracking-widest transition-all">
                Batalkan
            </button>
        </form>
    </div>
</x-modal>

@push('scripts')
<script>
    function openModalAddUserModal() {
        document.getElementById('add_user_modal').showModal();
    }

    function closeModalAddUserModal() {
        document.getElementById('add_user_modal').close();
    }

    function closeModalDeleteUserModal() {
        document.getElementById('delete_user_modal').close();
    }

    // fungsi untuk menampilkan modal konfirmasi hapus akun
    function confirmDelete(userId, userName) {
        document.getElementById('deleteUserName').innerText = userName;
        document.getElementById('deleteUserForm').action = '/admin/users/' + userId;
        document.getElementById('delete_user_modal').showModal();
    }

    // Link the header button to the new modal component function
    // fungsi untuk membuka modal tambah pengguna baru
    function showAddModal() {
        openModalAddUserModal();
    }
</script>
@endpush

@endsection
