<x-app-layout>
<div class="flex">

<x-sidebar-admin />

<div class="flex-1 p-6 bg-gray-100 min-h-screen">

<h1 class="text-xl font-bold mb-4">Tambah Jabatan</h1>

<div class="bg-white p-6 rounded shadow max-w-lg">

<form method="POST" action="/admin/jabatan">
@csrf

<input type="text" name="nama" placeholder="Nama Jabatan"
       class="border p-2 w-full mb-3" required>

<input type="number" name="rate_per_jam" placeholder="Rate per Jam"
       class="border p-2 w-full mb-3" required>

<button class="bg-green-600 text-white px-4 py-2 rounded">
    Simpan
</button>

</form>

</div>

</div>
</div>
</x-app-layout>