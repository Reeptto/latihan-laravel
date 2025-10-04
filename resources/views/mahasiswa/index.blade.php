<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            {{ __('Data Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-width-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Form  tambah mahasiswa --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">Tambah Mahasiswa</h3>
                    <form method="POST" action="{{ route('mahasiswa.store') }}">
                        @csrf
                        <input type="text" name="nama" placeholder="Nama" id=""
                        class="border-gray-300 rounded-md w-full"><br><br>
                        <input type="text" name="nim" placeholder="NIM" id=""
                        class="border-gray-300 rounded-md w-full"><br><br>
                        <select name="kelas_id" class="border-gray-300 rounded-md w-full" id="">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelas as $kls)
                                <option value="{{ $kls->id }}">{{ $kls->nama_kelas }}</option>
                            @endforeach
                        </select><br><br>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>

            {{-- List mahasiswa --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">List Mahasiswa</h3>
                    <table class="table-auto w-full border">
                        <thead class="bg-gray-200 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 border">Id</th>
                                <th class="px-4 py-2 border">Nama</th>
                                <th class="px-4 py-2 border">NIM</th>
                                <th class="px-4 py-2 border">Kelas</th>
                                <th class="px-4 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $mhs)
                                <tr>
                                    <td class="border px-4 py-2 text-center"> {{ $loop->iteration }}</td>
                                    <td class="border px-4 py-2"> {{ $mhs->nama }}</td>
                                    <td class="border px-4 py-2"> {{ $mhs->nim }}</td>
                                    <td class="border px-4 py-2"> {{ $mhs->Kelas->nama_kelas ?? '' }}</td>
                                    <td class="border px-4 py-2 text-center"> 
                                        <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="inline-block px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
                                        
                                        <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus data ini?')" class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>