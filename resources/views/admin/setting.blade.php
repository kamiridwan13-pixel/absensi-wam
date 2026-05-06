<x-app-layout>
<div class="flex">

<x-sidebar-admin />

<div class="flex-1 p-6 bg-gray-100 min-h-screen">

<h1 class="text-xl font-bold mb-4">Setting</h1>

<div class="bg-white p-6 rounded shadow max-w-lg">

<form method="POST" action="/admin/setting">
@csrf

<label>Rate Lembur</label>
<input type="number" name="rate_lembur"
       value="{{ $rate_lembur }}"
       class="border p-2 w-full mb-3">

<label>SPJ</label>
<input type="number" name="spj"
       value="{{ $spj }}"
       class="border p-2 w-full mb-3">

<button class="bg-blue-600 text-white px-4 py-2 rounded">
    Simpan
</button>

</form>

</div>

</div>
</div>
</x-app-layout>