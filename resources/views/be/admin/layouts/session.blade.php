{{-- Success Alert --}}
@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition
        class="flex items-center p-4 mb-4 text-green-800 border border-green-200 rounded-xl bg-green-50" role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
        </svg>
        <span class="sr-only">Success</span>
        <div class="text-sm font-medium ms-3">
            {{ session('success') }}
        </div>
        {{-- <button type="button" @click="show = false"
            class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-xl focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
            aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button> --}}
    </div>
@endif
{{-- Info Alert --}}
@if (session('info'))
    <div x-data="{ show: true }" x-show="show" x-transition
        class="flex items-center p-4 mb-4 text-blue-800 border border-blue-200 rounded-xl bg-blue-50" role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div class="text-sm font-medium ms-3">
            {{ session('info') }}
        </div>
        {{-- <button type="button" @click="show = false"
            class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-xl focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8"
            aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button> --}}
    </div>
@endif
{{-- Warning Alert --}}
@if (session('warning'))
    <div x-data="{ show: true }" x-show="show" x-transition
        class="flex items-center p-4 mb-4 text-yellow-800 border border-yellow-200 rounded-xl bg-yellow-50"
        role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM8.5 6a1.5 1.5 0 1 1 3 0v5a1.5 1.5 0 1 1-3 0V6Zm3 8.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
        </svg>
        <span class="sr-only">Warning</span>
        <div class="text-sm font-medium ms-3">
            {{ session('warning') }}
        </div>
        {{-- <button type="button" @click="show = false"
            class="ms-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-xl focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8"
            aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button> --}}
    </div>
@endif

{{-- Failed/Danger Alert --}}
@if (session('failed'))
    <div x-data="{ show: true }" x-show="show" x-transition
        class="flex items-center p-4 mb-4 text-red-800 border border-red-200 rounded-xl bg-red-50" role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
        </svg>
        <span class="sr-only">Error</span>
        <div class="text-sm font-medium ms-3">
            {{ session('failed') }}
        </div>
        {{-- <button type="button" @click="show = false"
            class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-xl focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
            aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button> --}}
    </div>
@endif
