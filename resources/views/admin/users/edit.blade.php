<x-app-layout>
<div class="flex">

<x-sidebar-admin />

<div class="flex-1 p-6 bg-gray-100 min-h-screen">

<div class="max-w-xl mx-auto">

<h1 class="text-2xl font-bold mb-6">✏ Edit Karyawan</h1>

<div class="bg-white p-6 rounded-2xl shadow">

<form method="POST" action="/admin/users/{{ $user->id }}" class="space-y-4">
@csrf
@method('PUT')

{{-- NAMA --}}
<div>
    <label class="block text-sm font-medium mb-1">Nama</label>
    <input type="text" name="name"
        value="{{ $user->name }}"
        class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200"
        required>
</div>

{{-- EMAIL --}}
<div>
    <label class="block text-sm font-medium mb-1">Email</label>
    <input type="email" name="email"
        value="{{ $user->email }}"
        class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200"
        required>
</div>

{{-- ROLE --}}
<div>
    <label class="block text-sm font-medium mb-1">Role</label>
    <select name="role"
        class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200">

        <option value="karyawan" {{ $user->role == 'karyawan' ? 'selected' : '' }}>
            👤 Karyawan
        </option>

        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
            🛠 Admin
        </option>

    </select>
</div>

{{-- JABATAN --}}
<div>
    <label class="block text-sm font-medium mb-1">Jabatan</label>
    <select name="jabatan_id"
        class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200">

        @foreach($jabatans as $j)
            <option value="{{ $j->id }}"
                {{ $user->jabatan_id == $j->id ? 'selected' : '' }}>
                {{ $j->nama }}
            </option>
        @endforeach

    </select>
</div>

{{-- BUTTON --}}
<div class="flex gap-3 pt-4">

    <a href="/admin/users"
       class="flex-1 text-center bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 rounded-xl transition">
        ⬅ Kembali
    </a>

    <button
        class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold transition">
        💾 Update
    </button>

</div>

</form>

</div>

</div>

</div>
</div>
</x-app-layout>