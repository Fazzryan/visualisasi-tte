@extends('be.admin.layouts.main')

@push('meta-seo')
    <title>Dashboard - Visualisasi TTE Kabupaten Tasikmalaya</title>
    <meta name="description" content="Dashboard - Visualisasi TTE Kabupaten Tasikmalaya">
    <meta name="keywords" content="Dashboard - Visualisasi TTE Kabupaten Tasikmalaya, Dashboard, Laravel">
    <meta name="author" content="Dinda Fazryan, S.Kom">
@endpush

@section('content')
    <div class="container mx-auto p-6">

        {{-- HEADER DAN INDIKATOR API --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <h2 class="text-xl font-medium text-gray-800 mb-4 md:mb-0">👋 Dashboard Admin</h2>

            {{-- INDIKATOR STATUS API SIMPEG --}}
            <div
                class="flex items-center space-x-2 p-3 rounded-xl shadow-md border 
             {{ $simpegStatusClass == 'bg-green-500' ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }}">

                <div class="w-3 h-3 rounded-full {{ $simpegStatusClass }} animate-pulse"></div>

                <div class="text-sm font-semibold 
                 {{ $simpegStatusClass == 'bg-green-500' ? 'text-green-800' : 'text-red-800' }}"
                    title="{{ $simpegMessage }}">
                    API SIMPEG: {{ $simpegStatus }}
                </div>
            </div>
            {{-- END INDIKATOR --}}
        </div>

        @include('be.admin.layouts.session')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            {{-- Kartu 1: Total Akun Terdaftar --}}
            <div class="bg-white p-6 rounded-3xl border border-gray-200">
                <p class="text-sm font-medium text-gray-500">Total Akun Terdaftar</p>
                <p class="text-3xl font-semibold text-gray-900 mt-1">{{ $totalUsers ?? '0' }}</p>
                <p class="text-xs text-gray-400 mt-2">Semua Role</p>
            </div>

            {{-- Kartu 2: Akun Admin --}}
            <div class="bg-white p-6 rounded-3xl border border-gray-200">
                <p class="text-sm font-medium text-gray-500">Total Akun Administrator</p>
                <p class="text-3xl font-semibold text-green-600 mt-1">{{ $totalAdmins ?? '0' }}</p>
                <p class="text-xs text-gray-400 mt-2">Role Admin</p>
            </div>

            {{-- Kartu 3: Akun User SKPD --}}
            <div class="bg-white p-6 rounded-3xl border border-gray-200">
                <p class="text-sm font-medium text-gray-500">Total Akun User SKPD</p>
                <p class="text-3xl font-semibold text-blue-600 mt-1">{{ $totalSkpd ?? '0' }}</p>
                <p class="text-xs text-gray-400 mt-2">Pengguna di SKPD</p>
            </div>

        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-200">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Aktivitas Login Terbaru (10 Data Terakhir)</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                NO
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                NIP
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Nama
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Role
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Login Terakhir
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($latestLogins ?? [] as $key => $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $key + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->nip }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs">
                                    @php
                                        // Untuk menampilkan role dengan format yang rapi
                                        $roleText = Str::title(str_replace('_', ' ', $user->role));
                                        $roleColor = match ($user->role) {
                                            'admin' => 'bg-green-100 text-green-800',
                                            default => 'bg-blue-100 text-blue-800',
                                        };
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 rounded-full {{ $roleColor }}">
                                        {{ $roleText }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Belum Pernah' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Belum ada data login terbaru yang tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {{-- Tempat Anda bisa menambahkan script untuk Chart.js/ApexCharts di sini --}}
@endpush
