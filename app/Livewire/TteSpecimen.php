<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http; // Pastikan ini di-use untuk hit API

class TteSpecimen extends Component
{
    // Properti untuk Input Form
    public $nip = '';

    // Properti untuk Menampilkan Hasil Data
    public $found = false; // Status apakah data ditemukan atau belum
    public $nip_pegawai = '';     //(untuk menampilkan NIP hasil pencarian)
    public $nama_lengkap = '';
    public $jabatan = '';
    public $nama_pangkat = '';
    public $nama_golongan = '';

    // Properti untuk Notifikasi
    public $message = '';

    // URL API SIMPEG Anda (Ganti dengan URL yang sebenarnya)
    protected $simpegApiUrl = 'https://ws-simpeg.tasikmalayakab.go.id/api/nik/';

    // app/Livewire/TteSpecimen.php

    public function searchPegawai()
    {
        // 1. Reset status, notifikasi, dan properti data
        $this->reset(['found', 'nip_pegawai', 'nama_lengkap', 'jabatan', 'nama_pangkat', 'nama_golongan', 'message']);

        // 2. Validasi NIP (optional: tambahkan digits:18 jika NIP wajib 18 digit)
        $this->validate([
            'nip' => 'required|numeric',
        ]);

        try {
            $apiToken = '21|n2RSJVJSdcyok4lRpsUTco2zrYk27PCFUqT9h2yF';
            // 3. Hit API SIMPEG
            $response = Http::timeout(20)
                ->withToken($apiToken)
                ->get($this->simpegApiUrl . $this->nip);

            // Cek status response
            if ($response->successful()) {
                // **PERBAIKAN 1: Gunakan $responseData untuk menampung seluruh JSON**
                $responseData = $response->json();

                // 1. Cek apakah response sukses dan array data pegawai tersedia
                if (
                    isset($responseData['success']) && $responseData['success'] === true &&
                    isset($responseData['mapData']['data']) &&
                    !empty($responseData['mapData']['data']) // Pastikan array tidak kosong
                ) {

                    // **PERBAIKAN 2: Ambil objek data pegawai tunggal**
                    $pegawaiData = $responseData['mapData']['data'][0];

                    // 2. Assign data ke properti Livewire dengan fallback '-'
                    $this->found = true;

                    $this->nip_pegawai = $pegawaiData['nip'] ?? '-';
                    $this->nama_lengkap = $pegawaiData['nama_lengkap'] ?? '-';
                    $this->jabatan = $pegawaiData['jabatan'] ?? '-';
                    $this->nama_pangkat = $pegawaiData['nama_pangkat'] ?? '-';
                    $this->nama_golongan = $pegawaiData['nama_golongan'] ?? '-';

                    $this->message = 'Data pegawai ditemukan.';
                } else {
                    // Jika response sukses, tapi API bilang 'success: false' atau data kosong
                    $this->message = 'Data pegawai tidak ditemukan untuk NIP tersebut.';
                }
            } else if ($response->status() == 401) {
                $this->message = 'Otentikasi gagal. Pastikan token API valid.';
            } else {
                // Jika API mengembalikan error 4xx/5xx lainnya
                $this->message = 'Gagal mengambil data dari server SIMPEG. (Status: ' . $response->status() . ')';
            }
        } catch (\Exception $e) {
            $this->message = 'Terjadi kesalahan saat menghubungi server SIMPEG. (' . $e->getMessage() . ')';
        }
    }

    /**
     * Fungsi untuk mereset semua input dan hasil pencarian
     */
    public function resetForm()
    {
        // Reset properti input (nip) dan properti hasil
        $this->reset([
            'nip',
            'found',
            'nip_pegawai',
            'nama_lengkap',
            'jabatan',
            'nama_pangkat',
            'nama_golongan',
            'message'
        ]);
    }

    public function render()
    {
        return view('livewire.tte-specimen');
    }
}
