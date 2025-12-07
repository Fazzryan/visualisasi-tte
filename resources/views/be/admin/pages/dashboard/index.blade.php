@extends('be.admin.layouts.main')

@push('meta-seo')
    <title>Dashboard - Visualisasi TTE Kabupaten Tasikmalaya</title>
    <meta name="description" content="Dashboard - Visualisasi TTE Kabupaten Tasikmalaya">
    <meta name="keywords" content="Dashboard - Visualisasi TTE Kabupaten Tasikmalaya, Dashboard, Laravel">
    <meta name="author" content="Dinda Fazryan, S.Kom">
@endpush

@section('content')
    <div class="w-full p-4 mx-auto max-w-screen-2xl">
        <h1 class="text-2xl font-semibold text-gray-700 mb-6">👋 Dashboard TTE Kabupaten Tasikmalaya</h1>

        <div class="grid grid-cols-1 gap-5 mb-8 md:grid-cols-2 lg:grid-cols-3">

            {{-- Total Pegawai TTE --}}
            <div class="p-4 bg-white rounded-xl shadow border-l-4 border-indigo-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 text-indigo-500 bg-indigo-100 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-5a2 2 0 012-2H2a2 2 0 012-2h10l-2-2m0 0l-2-2m2 2l2-2"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Pegawai TTE</p>
                        <p class="text-2xl font-semibold text-gray-900">12.345</p> {{-- Ganti dengan data dinamis --}}
                    </div>
                </div>
            </div>

            {{-- Pegawai Aktif (30 Hari) --}}
            <div class="p-4 bg-white rounded-xl shadow border-l-4 border-green-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 text-green-500 bg-green-100 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Akses Spesimen (30 Hari)</p>
                        <p class="text-2xl font-semibold text-gray-900">450</p> {{-- Ganti dengan data dinamis --}}
                    </div>
                </div>
            </div>

            {{-- Total SKPD Terintegrasi --}}
            {{-- <div class="p-4 bg-white rounded-xl shadow border-l-4 border-yellow-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 text-yellow-500 bg-yellow-100 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2h2m4 0a2 2 0 002-2V5a2 2 0 00-2-2h-2a2 2 0 00-2 2v2m7 5h-2M7 11h-2">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total SKPD Terintegrasi</p>
                        <p class="text-2xl font-semibold text-gray-900">54</p>
                    </div>
                </div>
            </div> --}}

            {{-- Status Koneksi API --}}
            <div class="p-4 bg-white rounded-xl shadow border-l-4 border-red-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 text-red-500 bg-red-100 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-6-6z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Status API SIMPEG</p>
                        <p class="text-2xl font-semibold text-green-600">ONLINE</p> {{-- Ganti berdasarkan status real-time --}}
                    </div>
                </div>
            </div>

        </div>

        <hr class="mb-8 border-gray-200">

        <div class="grid grid-cols-1 gap-6 mb-8 lg:grid-cols-3">

            {{-- Kolom Kiri: Tren Pencarian (2/3 lebar) --}}
            <div class="lg:col-span-2">
                <div class="p-6 bg-white rounded-xl shadow">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">📈 Tren Pencarian Spesimen (7 Hari Terakhir)</h2>

                    {{-- Placeholder untuk Grafik Chart.js/ApexCharts --}}
                    <div
                        class="h-80 bg-gray-50 flex items-center justify-center text-gray-500 rounded-md border border-dashed">
                        [Placeholder Grafik Tren]
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Log dan Akses Cepat (1/3 lebar) --}}
            <div class="lg:col-span-1 space-y-6">

                <a href="{{ route('be.spesimen') }}"
                    class="block p-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl shadow-lg transition duration-150 text-center">
                    <p class="text-lg font-semibold">▶️ Cari Spesimen Baru Sekarang</p>
                </a>

                <div class="p-4 bg-white rounded-xl shadow">
                    <h2 class="text-lg font-semibold text-gray-700 mb-3 border-b pb-2">⏱️ Log Pencarian Terbaru</h2>
                    <ul class="divide-y divide-gray-200">
                        {{-- Contoh Log --}}
                        <li class="py-2 text-sm">
                            <span class="font-medium">1977...003</span> mencari. <span
                                class="float-right text-green-600 font-medium">Sukses</span>
                        </li>
                        <li class="py-2 text-sm">
                            <span class="font-medium">1985...450</span> mencari. <span
                                class="float-right text-red-600 font-medium">Gagal</span>
                        </li>
                        <li class="py-2 text-sm">
                            <span class="font-medium">1990...111</span> mencari. <span
                                class="float-right text-green-600 font-medium">Sukses</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
    {{-- Tempat Anda bisa menambahkan script untuk Chart.js/ApexCharts di sini --}}
@endpush
