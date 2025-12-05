<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Navigation Menu') }}
        </h2>
    </x-slot>

    <div x-data="navPage()" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Flash Message --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tombol Tambah --}}
            <div class="mb-6">
                <button @click="openCreateModal()"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + Tambah Menu
                </button>
            </div>

            {{-- Tabel Data --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">Daftar Navigation Menu</h3>
                    
                    <table class="table-auto w-full border">
                        <thead class="bg-gray-200 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 w-16 text-center">Pos</th>
                                <th class="px-4 py-2">Label</th>
                                <th class="px-4 py-2">URL</th>
                                <th class="px-4 py-2 text-center w-24">Status</th>
                                <th class="px-4 py-2 text-center w-40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr class="border-t">
                                    <td class="px-4 py-2 text-center">{{ $item->position }}</td>
                                    <td class="px-4 py-2 font-medium">{{ $item->label }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">{{ $item->url }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <span class="px-2 py-1 rounded text-white text-xs {{ $item->status ? 'bg-green-600' : 'bg-red-600' }}">
                                            {{ $item->status ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        {{-- Edit Button --}}
                                        <button @click="openEditModal({{ $item }})"
                                                class="px-3 py-1 bg-yellow-500 text-white rounded text-sm hover:bg-yellow-600">
                                            Edit
                                        </button>
                                        
                                        {{-- Delete Button --}}
                                        <form action="{{ route('admin.landing.navigation.destroy', $item->id) }}"
                                              method="POST" class="inline-block"
                                              onsubmit="return confirm('Hapus menu ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-3 py-1 bg-red-600 text-white rounded text-sm hover:bg-red-700">
                                                Hapus
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

        {{-- MODAL CREATE --}}
        <div x-show="showCreate"
             class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50"
             x-transition
             style="display: none;">
            
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96" @click.away="showCreate = false">
                <h2 class="text-xl font-semibold mb-4">Tambah Menu Navigasi</h2>
                
                <form method="POST" action="{{ route('admin.landing.navigation.store') }}" class="space-y-4">
                    @csrf
                    
                    {{-- Label --}}
                    <div>
                        <label class="block mb-1 font-medium">Label</label>
                        <input type="text" name="label" class="border-gray-300 rounded-md w-full" required>
                    </div>

                    {{-- URL --}}
                    <div>
                        <label class="block mb-1 font-medium">URL</label>
                        <input type="text" name="url" class="border-gray-300 rounded-md w-full" required>
                    </div>

                    {{-- Position --}}
                    <div>
                        <label class="block mb-1 font-medium">Position</label>
                        <input type="number" name="position" value="0" class="border-gray-300 rounded-md w-full" required>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block mb-1 font-medium">Status</label>
                        <select name="status" class="border-gray-300 rounded-md w-full">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" @click="showCreate = false" class="px-4 py-2 bg-gray-500 text-white rounded">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- MODAL EDIT --}}
        <div x-show="showEdit"
             class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50"
             x-transition
             style="display: none;">
            
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96" @click.away="showEdit = false">
                <h2 class="text-xl font-semibold mb-4">Edit Menu</h2>
                
                {{-- Form Action Dinamis menggunakan x-bind --}}
                <form method="POST" :action="'{{ url('admin/landing/navigation') }}/' + editData.id" class="space-y-4">
                    @csrf
                    @method('PUT')

                    {{-- Label --}}
                    <div>
                        <label class="block mb-1 font-medium">Label</label>
                        <input type="text" name="label" x-model="editData.label" class="border-gray-300 rounded-md w-full" required>
                    </div>

                    {{-- URL --}}
                    <div>
                        <label class="block mb-1 font-medium">URL</label>
                        <input type="text" name="url" x-model="editData.url" class="border-gray-300 rounded-md w-full" required>
                    </div>

                    {{-- Position --}}
                    <div>
                        <label class="block mb-1 font-medium">Position</label>
                        <input type="number" name="position" x-model="editData.position" class="border-gray-300 rounded-md w-full" required>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block mb-1 font-medium">Status</label>
                        <select name="status" x-model="editData.status" class="border-gray-300 rounded-md w-full">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" @click="showEdit = false" class="px-4 py-2 bg-gray-500 text-white rounded">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    {{-- Script Alpine.js --}}
    <script>
        function navPage() {
            return {
                showCreate: false,
                showEdit: false,
                editData: { id: '', label: '', url: '', position: 0, status: 1 },
                
                openCreateModal() {
                    this.showCreate = true;
                },
                
                openEditModal(item) {
                    this.editData = {
                        id: item.id,
                        label: item.label,
                        url: item.url,
                        position: item.position,
                        status: item.status
                    };
                    this.showEdit = true;
                }
            };
        }
    </script>
</x-app-layout>