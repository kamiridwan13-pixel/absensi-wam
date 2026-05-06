<x-app-layout>
<div class="flex">

<x-sidebar />

<div class="flex-1 p-6 bg-gray-100 min-h-screen">

<div class="max-w-xl mx-auto">

<h1 class="text-2xl font-bold mb-6">⏱ Pengajuan Lembur</h1>

{{-- ALERT --}}
@if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-xl">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-xl">
        {{ session('error') }}
    </div>
@endif

{{-- KUOTA --}}
<div class="bg-purple-50 border border-purple-200 p-5 rounded-2xl mb-6 text-center shadow">
    <p class="text-sm text-purple-700">Sisa Kuota Lembur</p>
    <p class="text-3xl font-bold text-purple-600 mt-2">
        {{ $user->sisa_kuota_lembur }} Jam
    </p>
</div>

{{-- FORM --}}
<div class="bg-white p-6 rounded-2xl shadow">

<form method="POST" action="/lembur" class="space-y-4">
@csrf

{{-- TANGGAL --}}
<div>
    <label class="block text-sm font-medium mb-1">Tanggal Lembur</label>
    <input type="date" name="tanggal"
        class="w-full border p-3 rounded-lg focus:ring focus:ring-purple-200"
        required>
</div>

{{-- DURASI --}}
<div>
    <label class="block text-sm font-medium mb-1">Durasi (Jam)</label>
    <input type="number" name="durasi_jam"
        class="w-full border p-3 rounded-lg focus:ring focus:ring-purple-200"
        placeholder="Contoh: 2"
        required>
</div>

{{-- TUJUAN --}}
<div>
    <label class="block text-sm font-medium mb-1">Tujuan Lembur</label>
    <textarea name="tujuan"
        class="w-full border p-3 rounded-lg focus:ring focus:ring-purple-200"
        placeholder="Jelaskan alasan lembur..."
        rows="3"
        required></textarea>
</div>

{{-- BUTTON --}}
<button
    class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-xl font-semibold transition">
    🚀 Ajukan Lembur
</button>

</form>

</div>

</div>

</div>
</div>
</x-app-layout>