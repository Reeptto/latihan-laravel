<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            {{ __('Data Dosen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-width-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Form  tambah mahasiswa --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">Tambah Dosen</h3>
                    <form method="POST" action="{{ route('dosen.store') }}">
                        @csrf
                        <input type="text" name="nid" placeholder="NID" id=""
                        class="border-gray-300 rounded-md w-full"><br>
                        <input type="text" name="nama" placeholder="Nama" id=""
                        class="border-gray-300 rounded-md w-full"><br>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>


            {{-- List mahasiswa --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">List Dosen</h3>
                    <table class="table-auto w-full border">
                        <thead class="bg-gray-200 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 border">NID</th>
                                <th class="px-4 py-2 border">Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $dsn)
                                <tr>
                                    <td class="border px-4 py-2"> {{ $dsn->nid }}</td>
                                    <td class="border px-4 py-2"> {{ $dsn->nama }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>