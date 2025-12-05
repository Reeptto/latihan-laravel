<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Programs') }}
        </h2>
    </x-slot>

    <div x-data="programPage()" class="py-12">
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
                    + Tambah Program
                </button>
            </div>

            {{-- Tabel Data --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">Daftar Programs</h3>
                    
                    <table class="table-auto w-full border">
                        <thead class="bg-gray-200 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-center w-24">Gambar</th>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Icon</th>
                                <th class="px-4 py-2 text-center w-24">Pos</th>
                                <th class="px-4 py-2 text-center w-24">Status</th>
                                <th class="px-4 py-2 text-center w-40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($programs as $program)
                                <tr class="border-t">
                                    {{-- Gambar --}}
                                    <td class="px-4 py-2 text-center">
                                        @if($program->image)
                                            <img src="{{ asset('storage/' . $program->image) }}" class="h-12 mx-auto rounded shadow" alt="Program Image">
                                        @else
                                            <span class="text-xs text-gray-500">No Image</span>
                                        @endif
                                    </td>
                                    
                                    {{-- Title --}}
                                    <td class="px-4 py-2 font-medium">{{ $program->title }}</td>
                                    
                                    {{-- Icon --}}
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $program->icon }}</td>
                                    
                                    {{-- Position --}}
                                    <td class="px-4 py-2 text-center">{{ $program->position }}</td>
                                    
                                    {{-- Status --}}
                                    <td class="px-4 py-2 text-center">
                                        <span class="px-2 py-1 rounded text-white text-xs {{ $program->status ? 'bg-green-600' : 'bg-red-600' }}">
                                            {{ $program->status ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    
                                    {{-- Aksi --}}
                                    <td class="px-4 py-2 text-center">
                                        <button @click="openEditModal({{ $program }})"
                                                class="px-3 py-1 bg-yellow-500 text-white rounded text-sm hover:bg-yellow-600">
                                            Edit
                                        </button>
                                        
                                        <form action="{{ route('admin.landing.programs.destroy', $program->id) }}"
                                              method="POST" class="inline-block"
                                              onsubmit="return confirm('Hapus program ini?');">
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
                <h2 class="text-xl font-semibold mb-4">Tambah Program</h2>
                
                <form method="POST" action="{{ route('admin.landing.programs.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    
                    {{-- Title --}}
                    <div>
                        <label class="block mb-1 font-medium">Title</label>
                        <input type="text" name="title" class="border-gray-300 rounded-md w-full" required>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label class="block mb-1 font-medium">Description</label>
                        <textarea name="description" class="border-gray-300 rounded-md w-full" rows="3"></textarea>
                    </div>

                    {{-- Icon --}}
                    <div>
                        <label class="block mb-1 font-medium">Icon (Class)</label>
                        <input type="text" name="icon" class="border-gray-300 rounded-md w-full" placeholder="ex: fas fa-code">
                    </div>

                    {{-- Position --}}
                    <div>
                        <label class="block mb-1 font-medium">Position</label>
                        <input type="number" name="position" value="0" class="border-gray-300 rounded-md w-full" required>
                    </div>

                    {{-- Image --}}
                    <div>
                        <label class="block mb-1 font-medium">Image</label>
                        <input type="file" name="image" class="border-gray-300 rounded-md w-full text-sm">
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
                <h2 class="text-xl font-semibold mb-4">Edit Program</h2>
                
                {{-- Form Action Dinamis --}}
                <form method="POST" :action="'{{ url('admin/landing/programs') }}/' + editData.id" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    {{-- Title --}}
                    <div>
                        <label class="block mb-1 font-medium">Title</label>
                        <input type="text" name="title" x-model="editData.title" class="border-gray-300 rounded-md w-full" required>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label class="block mb-1 font-medium">Description</label>
                        <textarea name="description" x-model="editData.description" class="border-gray-300 rounded-md w-full" rows="3"></textarea>
                    </div>

                    {{-- Icon --}}
                    <div>
                        <label class="block mb-1 font-medium">Icon</label>
                        <input type="text" name="icon" x-model="editData.icon" class="border-gray-300 rounded-md w-full">
                    </div>

                    {{-- Position --}}
                    <div>
                        <label class="block mb-1 font-medium">Position</label>
                        <input type="number" name="position" x-model="editData.position" class="border-gray-300 rounded-md w-full" required>
                    </div>

                    {{-- Image --}}
                    <div>
                        <label class="block mb-1 font-medium">Image (Biarkan kosong jika tetap)</label>
                        <input type="file" name="image" class="border-gray-300 rounded-md w-full text-sm">
                        
                        {{-- Preview Image Lama --}}
                        <template x-if="editData.image">
                            <div class="mt-2">
                                <p class="text-xs text-gray-500">Current Image:</p>
                                <img :src="'/storage/' + editData.image" class="mt-1 h-16 rounded shadow">
                            </div>
                        </template>
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
        function programPage() {
            return {
                showCreate: false,
                showEdit: false,
                editData: { id: '', title: '', description: '', icon: '', position: 0, status: 1, image: '' },
                
                openCreateModal() {
                    this.showCreate = true;
                },
                
                openEditModal(item) {
                    this.editData = {
                        id: item.id,
                        title: item.title,
                        description: item.description,
                        icon: item.icon,
                        position: item.position,
                        status: item.status,
                        image: item.image // Mengambil path gambar untuk preview
                    };
                    this.showEdit = true;
                }
            };
        }
    </script>
</x-app-layout>