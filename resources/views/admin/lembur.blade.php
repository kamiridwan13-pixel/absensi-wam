<x-app-layout>
    <div class="flex">

        <x-sidebar-admin />

        <div class="flex-1 p-6 bg-gray-100 min-h-screen">

            <h1 class="text-xl font-bold mb-4">Approval Lembur</h1>

            {{-- ALERT --}}
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded shadow p-4">

                <table class="w-full text-sm">

                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-3 text-left">Nama</th>
                            <th class="p-3 text-left">Tanggal</th>
                            <th class="p-3 text-left">Durasi</th>
                            <th class="p-3 text-left">Tujuan</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($data as $item)
                            <tr class="border-t">
                                <td class="p-3">{{ $item->user->name }}</td>
                                <td class="p-3">{{ $item->tanggal }}</td>
                                <td class="p-3">{{ $item->durasi_jam }} jam</td>
                                <td class="p-3">{{ $item->tujuan }}</td>

                                <td class="p-3 flex justify-center gap-2">

                                    <form method="POST" action="/admin/lembur/{{ $item->id }}/approve">
                                        @csrf
                                        <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
                                            ✔
                                        </button>
                                    </form>

                                    <form method="POST" action="/admin/lembur/{{ $item->id }}/reject">
                                        @csrf
                                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                            ✖
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-gray-500">
                                    Tidak ada pengajuan lembur
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

        </div>

    </div>
</x-app-layout>