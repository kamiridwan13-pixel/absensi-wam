<x-app-layout>
<div class="flex">

<x-sidebar-admin />

<div class="flex-1 p-6 bg-gray-100 min-h-screen">

<h1 class="text-xl font-bold mb-4">Survey Event</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
        {{ session('error') }}
    </div>
@endif

<a href="/admin/survey-event/create"
   class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
   + Buat Survey
</a>

<div class="bg-white rounded shadow p-4">

<table class="w-full text-sm">

    <thead class="bg-gray-200">
        <tr>
            <th class="p-3">Judul</th>
            <th class="p-3">Tanggal</th>
            <th class="p-3">Peserta</th>
            <th class="p-3">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($surveys as $s)
        <tr class="border-t">
            <td class="p-3">{{ $s->judul }}</td>
            <td class="p-3">
                {{ $s->tanggal_mulai }} - {{ $s->tanggal_selesai }}
            </td>
            <td class="p-3">
                @foreach($s->users as $u)
                    <span class="bg-gray-200 px-2 py-1 rounded text-xs">
                        {{ $u->name }}
                    </span>
                @endforeach
            </td>
            <td class="p-3 flex gap-2">

                <a href="/admin/survey-event/{{ $s->id }}/edit"
                   class="bg-yellow-500 text-white px-3 py-1 rounded">
                   Edit
                </a>

                <form action="/admin/survey-event/{{ $s->id }}" method="POST"
                      onsubmit="return confirm('Hapus survey?')">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 text-white px-3 py-1 rounded">
                        Hapus
                    </button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>

</table>

</div>

</div>
</div>
</x-app-layout>