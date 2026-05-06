<x-app-layout>
<div class="flex">

<x-sidebar-admin />

<div class="flex-1 p-6 bg-gray-100 min-h-screen">

<div class="max-w-6xl mx-auto">

{{-- HEADER --}}
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">👥 Manajemen Karyawan</h1>

    <a href="/admin/users/create"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl shadow transition">
        + Tambah Karyawan
    </a>
</div>

{{-- CARD TABLE --}}
<div class="bg-white rounded-2xl shadow overflow-hidden">

<table class="w-full text-sm">

    <thead class="bg-gray-100 text-gray-700">
        <tr>
            <th class="p-4 text-left">Nama</th>
            <th class="p-4 text-left">Email</th>
            <th class="p-4 text-left">Jabatan</th>
            <th class="p-4 text-left">Role</th>
            <th class="p-4 text-left">Aksi</th>
        </tr>
    </thead>

    <tbody>

        @forelse($users as $u)
        <tr class="border-t hover:bg-gray-50 transition">

            {{-- NAMA --}}
            <td class="p-4 font-medium">
                {{ $u->name }}
            </td>

            {{-- EMAIL --}}
            <td class="p-4 text-gray-600">
                {{ $u->email }}
            </td>

            {{-- JABATAN --}}
            <td class="p-4">
                <span class="bg-gray-100 px-3 py-1 rounded-full text-xs">
                    {{ $u->jabatan->nama ?? '-' }}
                </span>
            </td>

            {{-- ROLE --}}
            <td class="p-4">
                @if($u->role == 'admin')
                    <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs">
                        Admin
                    </span>
                @else
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs">
                        Karyawan
                    </span>
                @endif
            </td>

            {{-- AKSI --}}
            <td class="p-4 flex gap-2">

                <a href="/admin/users/{{ $u->id }}/edit"
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-xs transition">
                    ✏ Edit
                </a>

                <form action="/admin/users/{{ $u->id }}" method="POST"
                      onsubmit="return confirm('Yakin mau hapus?')">
                    @csrf
                    @method('DELETE')

                    <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-xs transition">
                        🗑 Hapus
                    </button>
                </form>

            </td>

        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center p-6 text-gray-500">
                Belum ada data karyawan
            </td>
        </tr>
        @endforelse

    </tbody>

</table>

</div>

</div>

</div>
</div>
</x-app-layout>