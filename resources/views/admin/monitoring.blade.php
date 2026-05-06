<x-app-layout>
<div class="flex">

<x-sidebar-admin />

<div class="flex-1 p-6 bg-gray-100 min-h-screen">

<div class="max-w-6xl mx-auto">

<h1 class="text-2xl font-bold mb-6">📡 Monitoring Harian</h1>

{{-- SUMMARY --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 text-center">

    @php
        $total = count($data);
        $hadir = collect($data)->where('status','hadir')->count();
        $survey = collect($data)->where('survey',true)->count();
        $alpha = collect($data)->where('status','Alpha')->count();
    @endphp

    <div class="bg-white p-4 rounded-xl shadow">
        <p class="text-sm text-gray-500">Total</p>
        <p class="text-2xl font-bold">{{ $total }}</p>
    </div>

    <div class="bg-green-50 p-4 rounded-xl shadow">
        <p class="text-sm text-green-700">Hadir</p>
        <p class="text-2xl font-bold text-green-600">{{ $hadir }}</p>
    </div>

    <div class="bg-blue-50 p-4 rounded-xl shadow">
        <p class="text-sm text-blue-700">Survey</p>
        <p class="text-2xl font-bold text-blue-600">{{ $survey }}</p>
    </div>

    <div class="bg-red-50 p-4 rounded-xl shadow">
        <p class="text-sm text-red-700">Alpha</p>
        <p class="text-2xl font-bold text-red-600">{{ $alpha }}</p>
    </div>

</div>

{{-- TABLE --}}
<div class="bg-white rounded-2xl shadow overflow-hidden">

<table class="w-full text-sm">

<thead class="bg-gray-100 text-gray-700">
<tr>
    <th class="p-4 text-left">Nama</th>
    <th class="p-4 text-left">Status</th>
    <th class="p-4 text-left">Jam Masuk</th>
    <th class="p-4 text-left">Aksi</th>
</tr>
</thead>

<tbody>

@foreach($data as $d)
<tr class="border-t hover:bg-gray-50 transition">

<td class="p-4 font-medium">
    {{ $d['user']->name }}
</td>

<td class="p-4">

    @if($d['survey'])
        <span class="px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-700">
            📍 Survey
        </span>

    @elseif($d['absen'])

        @if($d['absen']->status_hadir == 'hadir')
            <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">
                🟢 Hadir
            </span>
        @elseif($d['absen']->status_hadir == 'telat')
            <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">
                🟡 Telat
            </span>
        @else
            <span class="px-3 py-1 rounded-full text-xs bg-red-100 text-red-700">
                🔴 Alpha
            </span>
        @endif

    @else
        <span class="px-3 py-1 rounded-full text-xs bg-gray-200 text-gray-700">
            ⚪ Belum Absen
        </span>
    @endif

</td>

<td class="p-4">
    {{ $d['absen']->jam_masuk ?? '-' }}
</td>

<td class="p-4">

@if($d['absen'])
    <a href="/admin/absensi/{{ $d['absen']->id }}/edit"
       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-xs transition">
       ✏ Edit
    </a>
@else
    <span class="text-gray-400 text-xs">-</span>
@endif

</td>

</tr>
@endforeach

</tbody>

</table>

</div>

</div>

</div>
</div>
</x-app-layout>