<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow mt-8 text-center">
        <h2 class="font-semibold mb-4 text-green-700 text-xl">
            E-KYC Selesai !
        </h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="items-center justify-center flex flex-col">
            <svg class="h-16 w-16 text-green-500 mb-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 122.88">
                <path fill="currentColor" d="M61.44,0A61.44,61.44,0,1,1,0,61.44,61.44,61.44,0,0,1,61.44,0Z"/>
                
                <path fill="#fff" d="M42.37,51.68,53.26,62,79,35.87c2.13-2.16,3.47-3.9,6.1-1.19l8.53,8.74c2.8,2.77,2.66,4.4,0,7L58.14,85.34c-5.58,5.46-4.61,5.79-10.26.19L28,65.77c-1.18-1.28-1.05-2.57.24-3.84l9.9-10.27c1.5-1.58,2.7-1.44,4.22,0Z"/>
            </svg>

            <p class="text-gray-700 mb-3">
                Data anda telah kami terima dan sedang dalam proses verifikasi oleh tim kami. <br>
                Mohon menunggu maksimal <strong>1x24 jam</strong> untuk hasil verifikasi.
            </p>

            <a href="{{ route('ekyc.step1') }}" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                ♻️ Cek Lagi
            </a>
        </div>
    </div>
</x-app-layout>