<x-app-layout>
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow mt-8">
        <h2 class="font-semibold text-xl mb-4">Daftar eKYC Calon Mahasiswa</h2>

        @if (session('success'))
            <div class="text-green-700 bg-green-100 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="border-gray-300 border-collapse border w-full text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">#</th>
                    <th class="border p-2">Nama</th>
                    <th class="border p-2">NIK</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($list as $i => $row)
                <tr>
                    <td class="border p-2">{{ $i + 1 }}</td>
                    <td class="border p-2">{{ $row->user->name ?? ''}}</td>
                    <td class="border p-2">{{ $row->nik ?? '-' }}</td>
                    <td class="border p-2">
                        <span class="px-2 py-1 rounded text-white  {{ $row->status == 'accepted' ? 'bg-green-500' : ($row->status == 'rejected' ? 'bg-red-500' : 'bg-yellow-500') }}">
                            {{ ucfirst(str_replace('_', ' ', $row->status ?? 'belum')) }}    
                        </span>
                    </td>
                    <td class="border p-2">{{ $row->updated_at->format('d M Y H:i') }}</td>
                    <td class="border p-2 text-center">
                        <a href="{{ route('admin.ekyc.show', $row->id) }}" class="text-blue-600 hover:underline">Detail</a>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-gray-500 text-center p-3">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $list->links() }}</div>
    </div>
</x-app-layout>