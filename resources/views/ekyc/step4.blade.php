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
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    <form action="{{ route('ekyc.step4.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="" class="block text-sm font-medium mb-1">Alamat Domisili</label>
            <textarea name="domisili" class="w-full rounded" id="">{{ old('domisili', $data->domisili) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="" class="block text-sm font-medium mb-1">Provinsi</label>
            <select name="provinsi" class="border-gray-300 rounded-md w-full" id="provinsi">
                <option value="">-- Pilih Provinsi --</option>
                @foreach ($provinsiList as $prov)
                <option value="{{ $prov }}" {{ old('provinsi', $data->provinsi == $prov ? 'selected' : '' ) }}>
                    {{ $prov }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="" class="block text-sm font-medium mb-1">Kota</label>
            <select name="kota" class="border-gray-300 rounded-md w-full" id="kota">
                <option value="">-- Pilih Kota --</option>
                @foreach ($kotaList as $kota)
                <option value="{{ $kota }}" {{ old('kota', $data->kota == $kota ? 'selected' : '' ) }}>
                    {{ $kota }}
                </option>
                @endforeach
            </select>
        </div>

         <div class="mb-4">
            <label for="" class="block text-sm font-medium mb-1">Kecamatan</label>
            <select name="kecamatan" class="border-gray-300 rounded-md w-full" id="kecamatan">
                <option value="">-- Pilih Kecamatan --</option>
                @foreach ($kecamatanList as $kec)
                <option value="{{ $kec }}" {{ old('kecamatan', $data->kecamatan == $kec ? 'selected' : '' ) }}>
                    {{ $kec }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="" class="block text-sm font-medium mb-1">Kode Pos</label>
            <input type="text" value="{{ old('kode_pos', $data->kode_pos) }}" name="kode_pos" id="kode_pos" class="w-full border-gray-300 rounded-md p-2" readonly>
        </div>


        <div class="mb-4">
            <label for="" class="block text-sm font-medium mb-1">Nama Ibu Kandung</label>
            <input type="text" value="{{ old('nama_ibu', $data->nama_ibu) }}" name="nama_ibu" id="" class="w-full border-gray-300 rounded-md p-2">
        </div>

        <div class="mb-4">
            <label for="" class="block text-sm font-medium mb-1">Sumber Referensi</label>
            <select name="sumber" class="border-gray-300 rounded-md w-full" id="">
                <option value="">-- Pilih Sumber --</option>
                <option value="Sosial Media"{{ old('sumber', $data->sumber) == 'Sosial Media' ? 'selected' : '' }}>Sosial Media</option>
                <option value="Teman"{{ old('sumber', $data->sumber) == 'Teman' ? 'selected' : '' }}>Teman</option>
                <option value="Langsung dari Kampus"{{ old('sumber', $data->sumber) == 'Langsung dari Kampus' ? 'selected' : '' }}>Langsung dari Kampus</option>
            </select>
        </div>


        <div class="flex justify-between items-center mt-4">
                @if ($data && $data->status === 'submitted')
                     <a href="{{ route('ekyc.step5') }}" class="text-sm text-gray-100 bg-green-600 px-4 py-2 rounded hover:text-gray-700">Next</a>
                     <a href="{{ route('ekyc.step3') }}" class="text-sm text-gray-800 px-4 py-2 rounded hover:text-gray-700">Kembali Ke Step 3</a>
                    @else 
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan & Lanjut Step 5</button>
                        <a href="{{ route('ekyc.step3') }}" class="text-sm text-gray-800 px-4 py-2 rounded hover:text-gray-700">Kembali Ke Step 3</a>
                    @endif
        </div>
    </form>    
    </div>

    {{-- Script Dinamis (Provinsi -> Kota -> Kecamatan -> Kode Pos) --}}
   <script>
        const alamatData = @json($alamatList);

        document.getElementById('provinsi').addEventListener('change', function() {
            const prov = this.value;
            const kotaSelect = document.getElementById('kota');
            kotaSelect.innerHTML = `<option value="">-- Pilih Kota --</option>`;

            const filteredKota = alamatData.filter(item => item.provinsi === prov).map(item => item.kota);
            const unik = [...new Set(filteredKota)];
            unik.forEach(item => {
                kotaSelect.innerHTML += `<option value="${item}">${item}</option>`;
            });
        });

        document.getElementById('kota').addEventListener('change', function() {
            const kota = this.value;
            const kecSelect = document.getElementById('kecamatan');
            kecSelect.innerHTML = `<option value="">-- Pilih Kecamatan --</option>`;

            const filteredKec = alamatData.filter(item => item.kota === kota);
            filteredKec.forEach(item => {
                kecSelect.innerHTML += `<option value="${item.kecamatan}">${item.kecamatan}</option>`;
            });
        });

        document.getElementById('kecamatan').addEventListener('change', function() {
            const kec = this.value;
            const kodeInput = document.getElementById('kode_pos');
            const selected = alamatData.find(item => item.kecamatan === kec);
            kodeInput.value = selected ? selected.kode_pos : '';
        });
</script>

</x-app-layout>