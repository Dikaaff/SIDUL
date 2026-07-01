@extends('layouts.app')

@section('title', 'Kelola Staf')

@section('header')
<x-page-header 
    title="Manajemen Staf 🔑" 
    subtitle="Kelola data akses untuk Operator dan Dosen Pembimbing."
>
    <x-button onclick="openModalAddUserModal()" variant="primary" size="sm" class="!shadow-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
        Tambah Staf
    </x-button>
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
    <x-card padding="none" border class="overflow-hidden">
        {{-- Desktop --}}
        <div class="hidden md:block overflow-x-auto custom-scrollbar">
            <table class="table w-full">
                <thead>
                    <tr class="text-gray-400 font-black text-[10px] uppercase tracking-[0.2em] bg-gray-50/50 border-b border-gray-100">
                        <th class="pl-8 py-5 w-16">No</th>
                        <th class="min-w-[220px]">Nama</th>
                        <th class="min-w-[160px]">Nama Pengguna / NIK</th>
                        <th class="min-w-[120px]">Role</th>
                        <th class="pr-8 text-right w-20">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $index => $u)
                    <tr class="hover:bg-gray-50 transition-all group">
                        <td class="pl-8 py-5 text-[10px] font-medium text-gray-400">
                            {{ $users->firstItem() + $index }}
                        </td>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-2xl bg-purple-50 text-[#6B21A8] font-black flex items-center justify-center text-[8px] shadow-inner group-hover:rotate-3 transition-transform shrink-0">
                                    @php $nameParts = explode(' ', $u->display_name ?? 'User'); $initials = count($nameParts) > 1 ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1)) : strtoupper(substr($nameParts[0], 0, 2));                                         @endphp
                                    {{ $initials }}
                                </div>
                                <span class="font-semibold text-gray-800 text-sm tracking-tight truncate">{{ $u->display_name }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $u->username }}</span>
                        </td>
                        <td>
                            @if($u->role === 'dosen')
                                <span class="px-3 py-1.5 rounded-2xl bg-amber-50 text-amber-600 text-[9px] font-black uppercase tracking-wider border border-amber-100">Dosen</span>
                            @else
                                <span class="px-3 py-1.5 rounded-2xl bg-blue-50 text-blue-600 text-[9px] font-black uppercase tracking-wider border border-blue-100">Operator</span>
                            @endif
                        </td>
                        <td class="pr-8 text-right">
                            <div class="flex items-center justify-end gap-1">
                            <x-button type="button" aria-label="Edit pengguna" onclick="openEditModal('{{ $u->id }}', '{{ addslashes($u->dosen?->nama ?? $u->username) }}', '{{ $u->username }}', '{{ $u->role }}')" variant="ghost" size="sm" class="!w-9 !h-9 !p-0 text-gray-300 hover:!text-[#6B21A8] hover:!bg-purple-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </x-button>
                            <x-button type="button" aria-label="Hapus pengguna" onclick="confirmDelete('{{ $u->id }}', '{{ addslashes($u->display_name) }}')" variant="ghost" size="sm" class="!w-9 !h-9 !p-0 text-gray-300 hover:!text-red-500 hover:!bg-red-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </x-button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-24 text-center">
                            <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest italic">Tidak ada data staf</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile --}}
        <div class="md:hidden space-y-3 p-4">
            @forelse($users as $u)
            <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm active:bg-gray-50 transition-all flex flex-col gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-purple-50 text-[#6B21A8] font-black flex items-center justify-center text-xs shadow-inner shrink-0">
                        @php $nameParts = explode(' ', $u->display_name ?? 'User'); $initials = count($nameParts) > 1 ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1)) : strtoupper(substr($nameParts[0], 0, 2));                     @endphp
                        {{ $initials }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-semibold text-gray-800 text-sm truncate">{{ $u->display_name }}</h4>
                        <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">{{ $u->username }}</p>
                    </div>
                    @if($u->role === 'dosen')
                        <span class="px-2.5 py-1 rounded-2xl bg-amber-50 text-amber-600 text-[8px] font-black uppercase tracking-wider border border-amber-100 shrink-0">Dosen</span>
                    @else
                        <span class="px-2.5 py-1 rounded-2xl bg-blue-50 text-blue-600 text-[8px] font-black uppercase tracking-wider border border-blue-100 shrink-0">Operator</span>
                    @endif
                    <div class="flex items-center gap-1 shrink-0">
                    <x-button type="button" aria-label="Edit" onclick="openEditModal('{{ $u->id }}', '{{ addslashes($u->dosen?->nama ?? $u->username) }}', '{{ $u->username }}', '{{ $u->role }}')" variant="ghost" size="sm" class="!w-9 !h-9 !p-0 text-gray-300 hover:!text-[#6B21A8] hover:!bg-purple-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    </x-button>
                    <x-button type="button" aria-label="Hapus" onclick="confirmDelete('{{ $u->id }}', '{{ addslashes($u->display_name) }}')" variant="ghost" size="sm" class="!w-9 !h-9 !p-0 text-gray-300 hover:!text-red-500 hover:!bg-red-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </x-button>
                    </div>
                </div>
            </div>
            @empty
            <div class="py-16 text-center">
                <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest italic">Tidak ada data staf</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="px-8 py-5 border-t border-gray-100 bg-gray-50/30">
            {{ $users->links('vendor.pagination.sidul') }}
        </div>
    </x-card>
</div>

<!-- Modal Tambah User -->
<x-modal id="add_user_modal" title="Tambah Akun Baru" color="purple" size="md">
    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="space-y-5 font-sans">
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Tipe Akun (Role)</label>
                <select name="role" class="select select-bordered w-full rounded-2xl bg-gray-50 border-gray-100 focus:border-[#6B21A8]/30 font-bold text-sm h-14" required>
                    <option value="dosen">Dosen</option>
                    <option value="operator">Operator (Admin)</option>
                </select>
            </div>
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Nama Lengkap & Gelar</label>
                <input type="text" name="name" class="input input-bordered w-full rounded-2xl bg-gray-50 border-gray-100 focus:border-[#6B21A8]/30 font-bold text-sm h-14" placeholder="Contoh: Dr. Budi Santoso, S.T., M.T." required>
            </div>
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Nama Pengguna / NIK</label>
                <input type="text" name="username" class="input input-bordered w-full rounded-2xl bg-gray-50 border-gray-100 focus:border-[#6B21A8]/30 font-bold text-sm h-14" placeholder="Masukkan NIK atau Username" required>
            </div>
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Kata Sandi Baru</label>
                <input type="password" name="password" minlength="8" class="input input-bordered w-full rounded-2xl bg-gray-50 border-gray-100 focus:border-[#6B21A8]/30 font-bold text-sm h-14" placeholder="Minimal 8 karakter" required>
            </div>
            <div class="grid grid-cols-2 gap-4 pt-6 border-t border-gray-50 mt-8">
                <x-button type="button" variant="ghost" size="lg" :full="true" onclick="closeModalAddUserModal()">Batal</x-button>
                <x-button type="submit" variant="primary" size="lg" :full="true">Simpan Akun Baru</x-button>
            </div>
        </div>
    </form>
</x-modal>

<!-- Modal Edit User -->
<x-modal id="edit_user_modal" title="Ubah Akun" color="purple" size="md">
    <form id="editUserForm" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div class="space-y-5 font-sans">
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Tipe Akun (Role)</label>
                <select name="role" id="editRole" class="select select-bordered w-full rounded-2xl bg-gray-50 border-gray-100 focus:border-[#6B21A8]/30 font-bold text-sm h-14" required>
                    <option value="dosen">Dosen</option>
                    <option value="operator">Operator (Admin)</option>
                </select>
            </div>
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Nama Lengkap & Gelar</label>
                <input type="text" name="name" id="editName" class="input input-bordered w-full rounded-2xl bg-gray-50 border-gray-100 focus:border-[#6B21A8]/30 font-bold text-sm h-14" placeholder="Contoh: Dr. Budi Santoso, S.T., M.T." required>
            </div>
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Nama Pengguna / NIK</label>
                <input type="text" name="username" id="editUsername" class="input input-bordered w-full rounded-2xl bg-gray-50 border-gray-100 focus:border-[#6B21A8]/30 font-bold text-sm h-14" placeholder="Masukkan NIK atau Username" required>
            </div>
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Password Baru <span class="text-gray-300 normal-case tracking-normal">(biarkan kosong jika tidak diubah)</span></label>
                <input type="password" name="password" minlength="8" class="input input-bordered w-full rounded-2xl bg-gray-50 border-gray-100 focus:border-[#6B21A8]/30 font-bold text-sm h-14" placeholder="Minimal 8 karakter">
            </div>
            <div class="grid grid-cols-2 gap-4 pt-6 border-t border-gray-50 mt-8">
                <x-button type="button" variant="ghost" size="lg" :full="true" onclick="closeEditModal()">Batal</x-button>
                <x-button type="submit" variant="primary" size="lg" :full="true">Simpan Perubahan</x-button>
            </div>
        </div>
    </form>
</x-modal>

<!-- Modal Konfirmasi Hapus -->
<x-modal id="delete_user_modal" title="Hapus Akun" subtitle="Tindakan ini tidak dapat dibatalkan." color="red" size="sm">
    <div class="space-y-6">
        <div class="flex items-center gap-4 p-5 bg-red-50 rounded-2xl border border-red-100">
            <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center text-red-600 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            </div>
            <div>
                <p class="font-semibold text-gray-800 text-sm">Hapus <span id="deleteUserName" class="text-red-600"></span>?</p>
                <p class="text-[10px] font-bold text-gray-500 mt-1">Akun ini akan dihapus secara permanen dari sistem.</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 pt-2">
            <form method="dialog" data-no-loading>
                <x-button type="submit" variant="ghost" size="lg" :full="true">Batal</x-button>
            </form>
            <form id="deleteUserForm" method="POST">
                @csrf
                @method('DELETE')
                <x-button type="submit" variant="danger" size="lg" :full="true">Ya, Hapus Akun</x-button>
            </form>
        </div>
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

    // fungsi untuk menampilkan modal edit akun
    function openEditModal(userId, name, username, role) {
        document.getElementById('editUserForm').action = '/admin/users/' + userId;
        document.getElementById('editName').value = name;
        document.getElementById('editUsername').value = username;
        document.getElementById('editRole').value = role;
        document.getElementById('edit_user_modal').showModal();
    }

    function closeEditModal() {
        document.getElementById('edit_user_modal').close();
    }

    // Link the header button to the new modal component function
    // fungsi untuk membuka modal tambah pengguna baru
    function showAddModal() {
        openModalAddUserModal();
    }
</script>
@endpush

@endsection
