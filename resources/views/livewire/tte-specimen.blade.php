<div class="p-6 bg-white rounded-3xl border border-slate-200">
    <h3 class="text-lg font-medium text-gray-800 mb-6">Pencarian Spesimen TTE Pegawai</h3>

    <form wire:submit.prevent="searchPegawai" class="space-y-4 mb-8">
        <div class="flex items-end space-x-4">
            <div class="flex-grow">
                <label for="nip" class="block text-sm font-medium text-gray-700 mb-3">NIP Pegawai</label>
                <input wire:model.defer="nip" type="number" id="nip" placeholder="Masukkan NIP"
                    class="px-4 py-2 border border-gray-300 rounded-xl duration-150 focus:outline-none focus:ring-1 focus:ring-green-400 focus:border-green-500 w-full">
            </div>

            <div class="flex space-x-2">
                <button type="submit"
                    class="px-4 py-2 bg-green-500 text-white text-base font-normal rounded-xl hover:bg-green-600 transition duration-150 shadow">
                    Cari Data
                </button>
                <button type="button" wire:click="resetForm"
                    class="px-4 py-2 bg-rose-400 text-white text-base font-normal rounded-xl hover:bg-rose-500 transition duration-150 shadow">
                    Reset
                </button>
            </div>
        </div>
        @error('nip')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
        @enderror
    </form>

    <div wire:loading wire:target="searchPegawai" class="mb-4 flex justify-center">
        <div
            class="p-3 text-sm text-gray-700 bg-green-100 rounded-lg flex items-center justify-start border border-green-300">
            <span class="relative flex h-3 w-3 mr-3">
                <span
                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-600"></span>
            </span>
            Sedang memuat data pegawai...
        </div>
    </div>

    @if ($message)
        <div class="p-3 mb-4 border border-green-400 text-sm {{ $found ? 'text-green-700 bg-green-100' : 'text-yellow-700 bg-yellow-100' }} rounded-lg"
            role="alert">
            {{ $message }}
        </div>
    @endif

    @if ($found)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <div class="space-y-4">
                <h3 class="text-lg font-medium text-gray-800 border-b pb-2 mb-4">Detail Pegawai</h3>

                {{-- NIP Pegawai --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">NIP</label>
                    <input type="text" value="{{ $nip_pegawai }}" disabled
                        class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md">
                </div>

                {{-- Nama Lengkap --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" value="{{ $nama_lengkap }}" disabled
                        class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md">
                </div>

                {{-- Jabatan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jabatan</label>
                    <input type="text" value="{{ $jabatan }}" disabled
                        class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md">
                </div>

                {{-- Pangkat dan Golongan --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Pangkat</label>
                        <input type="text" value="{{ $nama_pangkat }}" disabled
                            class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Golongan</label>
                        <input type="text" value="{{ $nama_golongan }}" disabled
                            class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md">
                    </div>
                </div>
            </div>

            <div class="border-l lg:pl-8">
                <h3 class="text-lg font-medium text-gray-800 border-b pb-2 mb-4">Pratinjau Spesimen TTE</h3>

                <div id="tteSpecimenPreview" style="font-family: Arial, sans-serif;"
                    class="border-[1px] bg-white border-2 shadow rounded-xl border-gray-300 p-2 min-w-[225px] w-auto max-w-[310px]">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('assets/img/logo/logokabtasik.png') }}" alt="Logo Kab. Tasikmalaya"
                                style="width: 2cm; height: auto;">
                        </div>
                        <div class="flex-grow flex flex-col justify-between">
                            <div class="mt-[-6px]">
                                <p class="text-[7px] font-arial-mt tracking-normal ml-4 font-medium mb-[1px] ">
                                    Ditandatangani secara elektronik oleh:</p>

                                <p
                                    class="text-[8px] font-arial-mt uppercase ml-4 break-word leading-[10px] font-medium ">
                                    {{ $jabatan }}
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <p class="text-[8px] ml-4 font-arial-mt mb-[-2px] font-medium ">
                                    {{ $nama_lengkap }}
                                </p>
                                <p class="text-[7px] ml-4 mb-1 font-arial-mt font-medium ">
                                    {{ $nama_pangkat }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="mt-3 text-red-500 text-sm">* Spesimen ini hanya untuk pratinjau dan verifikasi data.</p>

                <button type="button" onclick="downloadTteSpecimen(this)" data-nama="{{ $nama_lengkap }}"
                    data-nip="{{ $nip_pegawai }}"
                    class="mt-4 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 sm:w-auto sm:text-sm">
                    Download PNG
                </button>
            </div>
        </div>
</div>
@endif
</div>

{{-- untuk download spesimen --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    function downloadTteSpecimen(el) {
        const element = document.getElementById('tteSpecimenPreview');

        if (!element || typeof html2canvas === 'undefined') {
            console.error("Elemen pratinjau atau library html2canvas tidak ditemukan.");
            return;
        }

        // 1. Ambil data nama lengkap dan NIP.
        const rawName = el.getAttribute('data-nama');
        const nipFallback = el.getAttribute('data-nip');

        let baseName = '';

        // Gunakan NAMA LENGKAP jika ada, jika tidak, gunakan NIP.
        if (rawName && rawName.trim() !== '' && rawName.trim() !== '-') {
            baseName = rawName;
        } else if (nipFallback && nipFallback.trim() !== '') {
            baseName = nipFallback;
        } else {
            baseName = 'unknown';
        }

        // 2. **PERUBAHAN:** Hanya ganti spasi dengan hyphen dan hapus strip di awal/akhir.
        const finalFileName = baseName
            .trim()
            .replace(/\s+/g, '-') // Ganti satu atau lebih spasi dengan hyphen
            .replace(/^-+|-+$/g, ''); // Hapus hyphen di awal/akhir

        // Cek jika setelah dibersihkan stringnya kosong, gunakan "tte-specimen"
        const finalNameForDownload = finalFileName || 'tte-specimen';


        // 3. Ubah elemen HTML menjadi Canvas
        html2canvas(element, {
            scale: 3,
            useCORS: true,
            backgroundColor: null

        }).then(canvas => {

            const image = canvas.toDataURL('image/png');
            const link = document.createElement('a');

            // GUNAKAN FINAL NAME FOR DOWNLOAD
            link.download = `${finalNameForDownload}.png`;
            link.href = image;

            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    }
</script>
