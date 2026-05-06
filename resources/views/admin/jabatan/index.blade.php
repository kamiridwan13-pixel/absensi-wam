<x-app-layout>
<div class="flex">

<x-sidebar-admin />

<div class="flex-1 p-6 bg-gray-100 min-h-screen">

<div class="max-w-5xl mx-auto">

{{-- HEADER --}}
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">🏢 Manajemen Jabatan</h1>

    <a href="/admin/jabatan/create"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl shadow transition">
        + Tambah Jabatan
    </a>
</div>

{{-- TABLE CARD --}}
<div class="bg-white rounded-2xl shadow overflow-hidden">

<table class="w-full text-sm">

    <thead class="bg-gray-100 text-gray-700">
        <tr>
            <th class="p-4 text-left">Nama Jabatan</th>
            <th class="p-4 text-left">Rate per Jam</th>
            <th class="p-4 text-left">Aksi</th>
        </tr>
    </thead>

    <tbody>

        @forelse($jabatans as $j)
        <tr class="border-t hover:bg-gray-50 transition">

            {{-- NAMA --}}
            <td class="p-4 font-medium">
                {{ $j->nama }}
            </td>

            {{-- RATE --}}
            <td class="p-4">
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                    Rp {{ number_format($j->rate_per_jam) }} / jam
                </span>
            </td>

            {{-- AKSI --}}
            <td class="p-4 flex gap-2">

                <a href="/admin/jabatan/{{ $j->id }}/edit"
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-xs transition">
                    ✏ Edit
                </a>

                <form action="/admin/jabatan/{{ $j->id }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus jabatan ini?')">
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
            <td colspan="3" class="text-center p-6 text-gray-500">
                Belum ada data jabatan
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