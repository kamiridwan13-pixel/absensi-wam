<x-app-layout>
<div class="flex">

<x-sidebar-admin />

<div class="flex-1 p-6 bg-gray-100 min-h-screen">

<div class="max-w-xl mx-auto">

<h1 class="text-2xl font-bold mb-6">Buat Survey Event</h1>

<div class="bg-white p-6 rounded-2xl shadow">

<form method="POST" action="/admin/survey-event">
@csrf

{{-- JUDUL --}}
<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Judul Survey</label>
    <input type="text" name="judul"
        class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200"
        placeholder="Contoh: Survey Lapangan Proyek A"
        required>
</div>

{{-- TANGGAL --}}
<div class="grid grid-cols-2 gap-4 mb-4">

    <div>
        <label class="block text-sm font-medium mb-1">Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai"
            class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200"
            required>
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai"
            class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200"
            required>
    </div>

</div>

{{-- PILIH KARYAWAN --}}
<div class="mb-4">
    <label class="block text-sm font-medium mb-2">Pilih Karyawan</label>

    <div id="karyawan-wrapper" class="space-y-3">

        {{-- ITEM --}}
        <div class="flex gap-2">
            <select name="users[]" class="w-full border p-3 rounded-lg">
                <option value="">-- Pilih Karyawan --</option>
                @foreach($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>

            <button type="button"
                onclick="hapusBaris(this)"
                class="bg-red-500 text-white px-3 rounded">
                ✖
            </button>
        </div>

    </div>

    {{-- BUTTON TAMBAH --}}
    <button type="button"
        onclick="tambahKaryawan()"
        class="mt-3 text-blue-600 font-semibold">
        ➕ Tambah Karyawan
    </button>
</div>

{{-- BUTTON --}}
<button
    class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold transition">
    💾 Simpan Survey
</button>

</form>

</div>

</div>

</div>
</div>

{{-- SCRIPT --}}
<script>
function tambahKaryawan() {
    let wrapper = document.getElementById('karyawan-wrapper');

    let html = `
        <div class="flex gap-2">
            <select name="users[]" class="w-full border p-3 rounded-lg">
                <option value="">-- Pilih Karyawan --</option>
                @foreach($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>

            <button type="button"
                onclick="hapusBaris(this)"
                class="bg-red-500 text-white px-3 rounded">
                ✖
            </button>
        </div>
    `;

    wrapper.insertAdjacentHTML('beforeend', html);
}

function hapusBaris(button) {
    button.parentElement.remove();
}
</script>

</x-app-layout>