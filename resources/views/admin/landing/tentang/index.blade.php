<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Landing Page tentangs') }}
        </h2>
    </x-slot>

    <div x-data="{ open: false, tentang: { id: null, key: '', value: '', type: 'text', status: 1 } }" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Flash Message --}}
            @if (session('success'))
                <div class="mb-4 p-4 rounded bg-green-200 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-lg">Landing tentangs</h3>
                        {{-- Tombol Tambah --}}
                        <button 
                            @click="tentang = { id: null, key: '', value: '', type: 'text', status: 1 }; open = true"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            + Tambah tentang
                        </button>
                    </div>

                    {{-- Tabel Data --}}
                    <table class="table-auto w-full border">
                        <thead class="bg-gray-200 text-gray-700">
                            <tr>
                                <th class="px-3 py-2 text-left">Key</th>
                                <th class="px-3 py-2 text-left">Value</th>
                                <th class="px-3 py-2 w-24">Type</th>
                                <th class="px-3 py-2 w-24">Status</th>
                                <th class="px-3 py-2 w-24 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tentang as $item)
                                <tr class="border-t">
                                    <td class="px-3 py-2 font-medium">{{ $item->key }}</td>
                                    
                                    {{-- Kolom Value (Menyesuaikan Type) --}}
                                    <td class="px-3 py-2">
                                        @if($item->type === 'image')
                                            {{-- Menampilkan gambar jika type image --}}
                                            <img src="{{ asset('storage/' . $item->value) }}" class="h-16 rounded shadow" alt="tentang Image">
                                        @elseif($item->type === 'json')
                                            <pre class="bg-gray-100 p-2 rounded text-xs">{{ json_encode(json_decode($item->value, true), JSON_PRETTY_PRINT) }}</pre>
                                        @else
                                            {{ Str::limit($item->value, 60) }}
                                        @endif
                                    </td>

                                    <td class="px-3 py-2 capitalize">{{ $item->type }}</td>
                                    
                                    <td class="px-3 py-2 text-center">
                                        <span class="{{ $item->status ? 'text-green-600' : 'text-gray-500' }}">
                                            {{ $item->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    
                                    <td class="px-3 py-2 text-center">
                                        <button 
                                            class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700"
                                            @click="open = true; tentang = {{ $item->toJson() }}">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        {{-- MODAL CREATE / EDIT --}}
        <div 
            x-show="open" 
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50"
            x-transition
            style="display: none;">
            
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl w-full max-w-md shadow-2xl" @click.away="open = false">
                
                <h2 class="text-xl font-semibold mb-4" x-text="tentang.id ? 'Edit tentang' : 'Tambah tentang'"></h2>

                {{-- Form Handling: Menggunakan x-bind:action untuk URL dinamis --}}
                <form method="POST" 
                      :action="tentang.id ? '{{ url('admin/landing/tentang') }}/' + tentang.id : '{{ route('admin.landing.tentang.store') }}'"
                      enctype="multipart/form-data">
                    
                    @csrf
                    
                    {{-- Method Spoofing untuk Edit (PUT) --}}
                    <template x-if="tentang.id">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    {{-- Input Key --}}
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Key</label>
                        <input type="text" name="key" class="w-full border rounded px-3 py-2" x-model="tentang.key" required>
                    </div>

                    {{-- Input Type (Hidden/Readonly saat Edit agar tidak merusak logika) --}}
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Type</label>
                        <select name="type" x-model="tentang.type" class="w-full border rounded px-3 py-2">
                            <option value="text">Text</option>
                            <option value="image">Image</option>
                        </select>
                    </div>

                    {{-- Input Value: Logic untuk Image --}}
                    <template x-if="tentang.type === 'image'">
                        <div class="mb-4">
                            <label class="block font-medium mb-1">Upload Image</label>
                            <input type="file" name="value" class="w-full border rounded px-3 py-2">
                            
                            {{-- Preview Gambar Lama --}}
                            <div class="mt-3" x-show="tentang.value && tentang.id">
                                <p class="text-sm text-gray-500 mb-1">Gambar Saat Ini:</p>
                                <img :src="'/storage/' + tentang.value" class="h-24 rounded shadow">
                            </div>
                        </div>
                    </template>

                    {{-- Input Value: Logic untuk Text --}}
                    <template x-if="tentang.type !== 'image'">
                        <div class="mb-4">
                            <label class="block font-medium mb-1">Value</label>
                            <textarea name="value" rows="4" class="w-full border rounded px-3 py-2" x-model="tentang.value"></textarea>
                        </div>
                    </template>

                    {{-- Input Status --}}
                    <div class="mb-4">
                         <label class="block font-medium mb-1">Status</label>
                         <select name="status" x-model="tentang.status" class="w-full border rounded px-3 py-2">
                             <option value="1">Active</option>
                             <option value="0">Inactive</option>
                         </select>
                    </div>

                    <div class="flex justify-end gap-3 mt-5">
                        <button type="button" @click="open = false" class="px-4 py-2 bg-gray-500 text-white rounded">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>