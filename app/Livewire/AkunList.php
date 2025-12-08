<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class AkunList extends Component
{
    use WithPagination;

    // Properti untuk fitur search dan filter
    public $search = '';
    public $perPage = 10;


    // Properti untuk Modal Add
    public $showCreateModal = false;
    public $nip_new = '';
    public $name_new = '';
    public $email_new = '';
    public $password_new = '';
    public $role_new = 'user_skpd'; // Default role

    // Properti untuk Modal Edit
    public $showEditModal = false;
    public $editingUser = null;
    public $nip = '';
    public $name = '';
    public $email = '';
    public $role = '';
    public $password = ''; // Password Baru
    public $password_confirmation = ''; // Konfirmasi Password

    // Properti untuk Modal Delete
    public $showDeleteModal = false;
    public $deletingUserId = null;


    // Reset halaman paginasi saat melakukan pencarian
    public function updatedSearch()
    {
        $this->resetPage();
    }

    // Fungsi untuk menampilkan modal TAMBAH DATA
    public function create()
    {
        // Reset semua properti form sebelum membuka modal
        $this->reset(['nip_new', 'name_new', 'email_new', 'password_new', 'role_new']);
        $this->resetErrorBag(); // Bersihkan error validasi sebelumnya
        $this->showCreateModal = true;
    }

    // Fungsi untuk menyimpan data pengguna baru
    public function store()
    {
        // 1. Aturan Validasi
        $this->validate([
            'nip_new' => 'required|numeric|min:16|unique:users,nip', // NIP harus 18 digit dan unik
            'name_new' => 'required|string|max:255',
            'email_new' => 'required|email|unique:users,email',
            'password_new' => 'required|min:6', // Password minimal 8 karakter
            'role_new' => 'required|string|in:user_skpd,admin,superadmin',
        ]);

        // 2. Buat User Baru
        User::create([
            'nip' => $this->nip_new,
            'name' => $this->name_new,
            'email' => $this->email_new,
            'password' => Hash::make($this->password_new),
            'role' => $this->role_new,
        ]);

        // 3. Tutup Modal dan Berikan Notifikasi
        $this->showCreateModal = false;
        session()->flash('success', 'Akun baru berhasil ditambahkan.');
    }

    // Fungsi untuk menampilkan modal EDIT
    public function edit(User $user)
    {
        $this->editingUser = $user;
        $this->nip = $user->nip;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        // RESET password field setiap kali modal edit dibuka
        $this->reset(['password', 'password_confirmation']);
        $this->resetErrorBag(); // Bersihkan error validasi sebelumnya
        $this->showEditModal = true;
    }

    // Fungsi untuk menyimpan perubahan data pengguna
    public function save()
    {
        // 1. Definisikan aturan validasi dasar
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->editingUser->id,
            'role' => 'required|string|in:user_skpd,admin,superadmin', // Perbaiki: gunakan $this->role, bukan role_new
        ];

        // 2. Tambahkan aturan validasi password HANYA jika field diisi
        if (!empty($this->password)) {
            $rules['password'] = 'required|min:6|confirmed'; // 'confirmed' akan cek $this->password_confirmation
            $rules['password_confirmation'] = 'required';
        }

        // 3. Jalankan validasi
        $validatedData = $this->validate($rules);

        // 4. Persiapkan data update
        $dataToUpdate = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ];

        // 5. Proses Password (Hashing)
        if (!empty($this->password)) {
            $dataToUpdate['password'] = Hash::make($this->password);
        }

        // 6. Eksekusi Update
        $this->editingUser->update($dataToUpdate);

        // 7. Tutup Modal dan Berikan Notifikasi
        $this->showEditModal = false;
        session()->flash('success', 'Akun ' . $this->name . ' berhasil diperbarui.');
    }

    // Fungsi untuk menampilkan modal DELETE
    public function delete($userId)
    {
        $this->deletingUserId = $userId;
        $this->showDeleteModal = true;
    }

    // Fungsi untuk menghapus data pengguna
    public function destroy()
    {
        User::find($this->deletingUserId)->delete();
        $this->showDeleteModal = false;
        $this->deletingUserId = null;
        session()->flash('success', 'Akun berhasil dihapus.');
    }

    public function render()
    {
        // Query untuk mendapatkan data dengan filter dan paginasi
        $users = User::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('nip', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);

        return view('livewire.akun-list', [
            'users' => $users,
        ]);
    }
}
