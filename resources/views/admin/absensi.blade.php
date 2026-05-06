<x-app-layout>
    <div class="flex">

        <x-sidebar-admin />

        <div class="flex-1 p-6 bg-gray-100 min-h-screen">

            <h1 class="text-xl font-bold mb-4">Approval Absensi</h1>

            <div class="bg-white rounded shadow p-4">

                <table class="w-full text-sm">

                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-3 text-left">Nama</th>
                            <th class="p-3 text-left">Tanggal</th>
                            <th class="p-3 text-left">Alasan</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($data as $item)
                            <tr class="border-t">
                                <td class="p-3">{{ $item->user->name }}</td>
                                <td class="p-3">{{ $item->tanggal }}</td>
                                <td class="p-3">{{ $item->alasan }}</td>

                                <td class="p-3 flex justify-center gap-2">

                                    <form method="POST" action="/admin/absensi/{{ $item->id }}/approve">
                                        @csrf
                                        <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
                                            ✔
                                        </button>
                                    </form>

                                    <form method="POST" action="/admin/absensi/{{ $item->id }}/reject">
                                        @csrf
                                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                            ✖
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