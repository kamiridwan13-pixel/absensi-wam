<x-app-layout>
<div class="flex">

<x-sidebar-admin />

<div class="flex-1 p-6 bg-gray-100 min-h-screen">

<div class="max-w-xl mx-auto">

<h1 class="text-2xl font-bold mb-6">Edit Survey Event</h1>

<div class="bg-white p-6 rounded-2xl shadow">

<form method="POST" action="/admin/survey-event/{{ $survey->id }}">
@csrf
@method('PUT')

{{-- JUDUL --}}
<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Judul Survey</label>
    <input type="text" name="judul"
        value="{{ $survey->judul }}"
        class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200"
        required>
</div>

{{-- TANGGAL --}}
<div class="grid grid-cols-2 gap-4 mb-4">

    <div>
        <label class="block text-sm font-medium mb-1">Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai"
            value="{{ $survey->tanggal_mulai }}"
            class="w-full border p-3 rounded-lg"
            required>
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai"
            value="{{ $survey->tanggal_selesai }}"
            class="w-full border p-3 rounded-lg"
            required>
    </div>

</div>

{{-- KARYAWAN --}}
<div class="mb-4">
    <label class="block text-sm font-medium mb-2">Pilih Karyawan</label>

    <div id="karyawan-wrapper" class="space-y-3">

        {{-- DATA LAMA --}}
        @foreach($survey->users as $selected)
        <div class="flex gap-2">
            <select name="users[]" class="w-full border p-3 rounded-lg">
                <option value="">-- Pilih Karyawan --</option>
                @foreach($users as $u)
                    <option value="{{ $u->id }}"
                        {{ $selected->id == $u->id ? 'selected' : '' }}>
                        {{ $u->name }}
                    </option>
                @endforeach
            </select>

            <button type="button"
                onclick="hapusBaris(this)"
                class="bg-red-500 text-white px-3 rounded">
                ✖
            </button>
        </div>
        @endforeach

    </div>

    {{-- TAMBAH --}}
    <button type="button"
        onclick="tambahKaryawan()"
        class="mt-3 text-blue-600 font-semibold">
        ➕ Tambah Karyawan
    </button>
</div>

{{-- BUTTON --}}
<div class="flex gap-3 mt-6">

    <a href="/admin/survey-event"
       class="flex-1 text-center bg-gray-300 hover:bg-gray-400 py-3 rounded-xl">
        ⬅ Kembali
    </a>

    <button
        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold">
        💾 Update
    </button>

</div>

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

function hapusBaris(btn) {
    btn.parentElement.remove();
}
</script>

</x-app-layout>