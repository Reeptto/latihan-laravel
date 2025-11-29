<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Footer Links') }}
        </h2>
    </x-slot>

    <div class="py-2" x-data="footerPage()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Flash Message --}}
            @if (session('success'))
                <div class="text-green-700 bg-green-100 mb-4 p-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tombol Tambah --}}
            <div class="mb-6">
                <button @click="openCreateModal()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + Tambah Link
                </button>
            </div>

            {{-- Tabel Data --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 p-6 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">Daftar Footer Links</h3>
                    <table class="table-auto w-full border">
                        <thead class="bg-gray-200 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-center w-16">Pos</th>
                                <th class="px-4 py-2">Label</th>
                                <th class="px-4 py-2">URL</th>
                                <th class="px-4 py-2 text-center w-24">Status</th>
                                <th class="px-4 py-2 text-center w-24">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($links as $item)
                                <tr>
                                    <td class="border px-4 py-2 text-center">{{ $item->position}}</td>
                                    <td class="border px-4 py-2">{{ $item->label}}</td>
                                    <td class="border px-4 py-2">{{ $item->url}}</td>

                                    <td class="text-center border px-4 py-2">
                                        <span class="rounded text-white {{ $item->status ? 'bg-green-500' : 'bg-red-500' }} px-2 py-1">
                                            {{ $item->status ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>

                                    <td class="text-center border px-4 py-2">
                                        {{-- Edit Button --}}
                                        <button @click="openEditModal({{ $item }})" class="bg-yellow-500 text-white rounded px-3 py-1">
                                            Edit
                                        </button>
                                        {{-- Delete --}}
                                        <form action="{{ route('admin.landing.footer.destroy', $item->id) }}" method="post" class="inline-block">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus link ini?')" class="bg-red-600 text-white rounded px-3 py-1">
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

        {{-- ---------------------------------------------------- --}}
        {{-- MODAL CREATE --}}
        {{-- ---------------------------------------------------- --}}
        <div x-show="showCreate" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50" x-transition>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
                <h2 class="font-semibold mb-4 text-xl"> Tambah Footer Link</h2>

                <form action="{{ route('admin.landing.footer.store') }}" class="space-y-4" method="post">
                    @csrf    
                    <div>
                        <label for="" class="block mb-1">Label</label>
                        <input type="text" name="label" class="border-gray-300 rounded-md w-full" id="" required>
                    </div>

                    <div>
                        <label for="" class="block mb-1">URL</label>
                        <input type="text" name="url" class="border-gray-300 rounded-md w-full" id="" required>
                    </div>

                    <div>
                        <label for="" class="block mb-1">Status</label>
                        <select name="status" class="border-gray-300 rounded-md w-full" id="">
                            <option value="1">Aktif</option>
                            <option value="2">Nonaktif</option>
                        </select>
                    </div>

                    <div class="justify-end flex gap-2">
                        <button type="button" @click="showCreate=false" class="px-4 py-2 bg-gray-500 text-white rounded">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ---------------------------------------------------- --}}
        {{-- MODAL EDIT --}}
        {{-- ---------------------------------------------------- --}}
        <div x-show="showEdit" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50" x-transition>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">

                <h2 class="text-xl font-semibold mb-4">Edit Footer Link</h2>

                <form method="POST"
                      :action="'/admin/landing/footer/' + editData.id" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="" class="block mb-1">Label</label>
                        <input type="text" name="label" x-model="editData.label" class="border-gray-300 rounded-md w-full" id="" required>
                    </div>

                    <div>
                        <label for="" class="block mb-1">URL</label>
                        <input type="text" name="url" x-model="editData.url" class="border-gray-300 rounded-md w-full" id="" required>
                    </div>
                    <div>
                        <label for="" class="block mb-1">Status</label>
                        <select class="border-gray-300 rounded-md w-full" name="status" x-model="editData.status" id="">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                    <div class="justify-end gap-2 flex">
                        <button type="button" @click="showEdit=false" class="px-4 py-2 bg-gray-500 text-white rounded">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function footerPage() {
            return {
                showCreate: false,
                showEdit: false,
                editData: {},

                openCreateModal() {
                    this.showCreate = true;
                },

                openEditModal(item) {
                    this.editData = {
                        id: item.id,
                        label: item.label,
                        url: item.url,
                        status: item.status
                    };
                    this.showEdit = true;
                }
            }
        }
    </script>
</x-app-layout>