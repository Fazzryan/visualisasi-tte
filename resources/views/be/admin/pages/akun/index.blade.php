@extends('be.admin.layouts.main')

@push('meta-seo')
    <title>Akun - Visualisasi TTE - Kabupaten Tasikmalaya</title>
    <meta name="description" content="Akun - Visualisasi TTE - Kabupaten Tasikmalaya">
    <meta name="keywords" content="Akun - Visualisasi TTE - Kabupaten Tasikmalaya, Dashboard, Laravel">
    <meta name="author" content="Dinda Fazryan, S.Kom">
@endpush

@section('content')
    <div class="w-full p-4 mx-auto max-w-screen-2xl">
        <div class="mb-8 sm:flex sm:justify-between sm:items-center">
            <!-- 📁 Page Title -->
            <div>
                <h1 class="mb-2 text-xl font-semibold text-slate-700">Akun</h1>
                <p class="text-slate-600">List akun user.</p>
            </div>
            <!-- Breadcrumb -->
            <nav class="mb-1 text-base text-gray-500" aria-label="Breadcrumb">
                <ol class="inline-flex p-0 list-none">
                    <li class="flex items-center">
                        <a href="{{ route('be.dashboard') }}" class="text-gray-500 hover:text-gray-600">Dashboard</a>
                        <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6 6L14 10L6 14V6Z" />
                        </svg>
                    </li>
                    <li class="font-medium text-green-500">Akun</li>
                </ol>
            </nav>
        </div>

        <livewire:akun-list />
    </div>
@endsection

@push('js')
@endpush
