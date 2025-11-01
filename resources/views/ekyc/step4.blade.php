<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow mt-8">
        <h2 class="text-xl font-semibold mb-4">E-KYC - Langkah 4: Domisili</h2>
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <ul class="list-disc ml-4 text-sm">
                @foreach ($errors->all as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    <form action="" method="POST">
        @csrf
        <div class="mb-4">
            <label for="" class="block text-sm font-medium mb-1">Alamat Domisili</label>
            <textarea name="domisili" class="w-full rounded" id=""></textarea>
        </div>

        <div class="mb-4">
            <label for="" class="block text-sm font-medium mb-1">Provinsi</label>
            <select name="provinsi" class="border-gray-300 rounded-md w-full" id="">
                <option value="">-- Pilih Provinsi --</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="" class="block text-sm font-medium mb-1">Provinsi</label>
            <select name="kota" class="border-gray-300 rounded-md w-full" id="">
                <option value="">-- Pilih Kota --</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="" class="block text-sm font-medium mb-1">Provinsi</label>
            <select name="kecamatan" class="border-gray-300 rounded-md w-full" id="">
                <option value="">-- Pilih Kecamatan --</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="" class="block text-sm font-medium mb-1">Kode Pos</label>
            <input type="number" name="kode_pos" onKeyPress="if(this.value.length==6) return false;" class="w-full border-gray-300 rounded-md p-2"/>
        </div>

        <div class="mb-4">
            <label for="" class="block text-sm font-medium mb-1">Nama Ibu Kandung</label>
            <input type="text" name="nama_ibu" id="" class="w-full border-gray-300 rounded-md p-2">
        </div>

        <div class="mb-4">
            <label for="" class="block text-sm font-medium mb-1">Sumber Informasi</label>
            <select name="sumber" class="border-gray-300 rounded-md w-full" id="">
                <option value="">-- Pilih Referensi --</option>
            </select>
        </div>


        <div class="flex justify-between items-center mt-4">
                <a href="{{ route('ekyc.step3') }}" class="text-sm text-gray-500 hover:text-gray-700">Kembali ke Step 3</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
            </div>
    </form>    
    </div>
</x-app-layout>