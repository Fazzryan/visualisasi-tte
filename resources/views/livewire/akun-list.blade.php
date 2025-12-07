<div class="p-6 bg-white rounded-3xl border border-slate-200">

    @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between mb-8 space-y-4 md:space-y-0">
        <div class="space-x-2 w-full md:w-1/3 md:flex md:flex-row md:items-center">
            <select wire:model.live="perPage"
                class="px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-1 focus:ring-green-400 focus:border-green-500 w-auto">
                <option value="5">5 per halaman</option>
                <option value="10">10 per halaman</option>
                <option value="20">20 per halaman</option>
            </select>

            <input wire:model.live="search" type="text" placeholder="Cari NIP, Nama, atau Email..."
                class="px-4 py-2 border border-gray-300 rounded-xl duration-150 focus:outline-none focus:ring-1 focus:ring-green-400 focus:border-green-500 w-full">
        </div>

        <button wire:click="create"
            class="px-4 py-2 bg-green-500 text-white text-base font-normal rounded-xl hover:bg-green-600 transition duration-150 shadow">
            Tambah Akun Baru
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-green-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">NIP</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Email
                    </th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Role</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-gray-700 uppercase">Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($users as $index => $user)
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-600 whitespace-nowrap">
                            {{ $users->firstItem() + $index }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600 whitespace-nowrap">{{ $user->nip ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600 whitespace-nowrap">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-sm leading-5 font-normal rounded-full {{ $user->role == 'admin' ? 'bg-indigo-100 text-indigo-800' : 'bg-green-100 text-green-800' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm whitespace-nowrap text-center font-medium">
                            <button wire:click="edit({{ $user->id }})"
                                class="text-indigo-600 hover:text-indigo-900 mx-1">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="w-5 h-5 icon icon-tabler icons-tabler-outline icon-tabler-pencil">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                    <path d="M13.5 6.5l4 4" />
                                </svg>
                            </button>
                            <button wire:click="delete({{ $user->id }})"
                                class="text-red-600 hover:text-red-900 mx-1">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="w-5 h-5 icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 7l16 0" />
                                    <path d="M10 11l0 6" />
                                    <path d="M14 11l0 6" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada akun yang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>

    {{-- MODAL TAMBAH AKUN BARU --}}
    @if ($showCreateModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                    @click="showCreateModal = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div
                    class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form wire:submit.prevent="store">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Tambah Akun Pengguna Baru
                            </h3>
                            <div class="mt-4 space-y-4 ">
                                {{-- Input NIP --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">NIP (18 Digit)</label>
                                    <input type="number" wire:model.defer="nip_new"
                                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-1 focus:ring-green-400 focus:border-green-500 duration-200">
                                    @error('nip_new')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Input Nama --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Nama</label>
                                    <input type="text" wire:model.defer="name_new"
                                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-1 focus:ring-green-400 focus:border-green-500 duration-200">
                                    @error('name_new')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Input Email --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Email</label>
                                    <input type="email" wire:model.defer="email_new"
                                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-1 focus:ring-green-400 focus:border-green-500 duration-200">
                                    @error('email_new')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Input Password --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Password</label>
                                    <input type="password" wire:model.defer="password_new"
                                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-1 focus:ring-green-400 focus:border-green-500 duration-200">
                                    @error('password_new')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Input Role --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Role</label>
                                    <select wire:model.defer="role_new"
                                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-1 focus:ring-green-400 focus:border-green-500 duration-200">
                                        <option value="user_skpd">User SKPD</option>
                                        <option value="admin">Admin</option>
                                        <option value="superadmin">Superadmin</option>
                                    </select>
                                    @error('role_new')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 sm:ml-3 sm:w-auto sm:text-sm">
                                Simpan Akun
                            </button>
                            <button type="button" wire:click="$set('showCreateModal', false)"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- Modal Edit Akun --}}
    @if ($showEditModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                    wire:click="$set('showEditModal', false)">
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div
                    class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form wire:submit.prevent="save">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Edit Akun: {{ $editingUser->name }}
                            </h3>
                            <div class="mt-4 space-y-4">
                                {{-- Input NIP --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">NIP (18 Digit)</label>
                                    <input type="text" disabled wire:model.defer="nip"
                                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-1 focus:ring-green-400 focus:border-green-500 duration-200">
                                </div>

                                {{-- Input Nama --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Nama</label>
                                    <input type="text" wire:model.defer="name"
                                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-1 focus:ring-green-400 focus:border-green-500 duration-200">
                                    @error('name')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Input Email --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Email</label>
                                    <input type="email" wire:model.defer="email"
                                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-1 focus:ring-green-400 focus:border-green-500 duration-200">
                                    @error('email')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Input Role --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Role</label>
                                    <select wire:model.defer="role"
                                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:outline-none focus:ring-1 focus:ring-green-400 focus:border-green-500 duration-200">
                                        <option value="user_skpd">User SKPD</option>
                                        <option value="admin">Admin</option>
                                        <option value="superadmin">Superadmin</option>
                                    </select>
                                    @error('role')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 sm:ml-3 sm:w-auto sm:text-sm">
                                Simpan
                            </button>
                            <button type="button" wire:click="$set('showEditModal', false)"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- MODAL DELETE AKUN --}}
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                    wire:click="$set('showDeleteModal', false)">
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div
                    class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.398 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Hapus Akun
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Anda yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="destroy" type="button"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">
                            Hapus
                        </button>
                        <button type="button" wire:click="$set('showDeleteModal', false)"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
