<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow mt-8">
        <h2 class="text-xl font-semibold mb-4">E-KYC - Langkah 2: Upload Dokumen</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('ekyc.step2.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Foto KTP</label>
                <input type="file" name="file_ktp" accept="image/" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"><br>
                @if ($data && $data->file_ktp)
                    <p class="text-sm mt-1 text-gray-500">Sudah upload: {{ basename($data->file_ktp) }}</p>
                @endif

                @if ($data && $data->file_ktp)
                    <img src="{{ asset('storage/'. $data->file_ktp) }}" class="h-32 rounded mt-2 border" alt="">
                @endif
            </div>
            <div>
                <label for="" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Selfie dengan KTP</label>
                <input type="file" name="file_selfie" accept="image/" class="mt-1 block w-full border-gray-600 rounded-md shadow-sm"><br>
                @if ($data && $data->file_selfie)
                    <p class="text-sm mt-1 text-gray-500">Sudah upload: {{ basename($data->file_selfie) }}</p>
                @endif

                @if ($data && $data->file_selfie)
                    <img src="{{ asset('storage/'. $data->file_selfie) }}" class="h-32 rounded mt-2 border" alt="">
                @endif
            </div>
            <div>
                <a href="{{ route('ekyc.step1') }}" class="text-sm text-gray-500 hover:text-gray-700">Kembali ke Step 1</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white hover:bg-blue-700">Simpan & lanjut ke Step 3 </button>
            </div>
        </form>
    </div>
</x-app-layout>