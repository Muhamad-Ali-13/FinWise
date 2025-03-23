<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('METODE PEMBAYARAN') }}
        </h2>
    </x-slot>
    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-700 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Responsive Grid Container -->
                <div class="p-4 sm:p-6 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <!-- Form Section -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                        <div class="mb-4 text-base sm:text-lg font-medium text-gray-700 dark:text-gray-300">
                            INPUT DATA METODE PEMBAYARAN
                        </div>
                        <form id="addForm" class="space-y-4">
                            @csrf
                            <div>
                                <label for="metode_pembayaran"
                                    class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                                    Metode Pembayaran
                                </label>
                                <input type="text" name="metode_pembayaran" id="metode_pembayaran"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                                    dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                                    placeholder="Masukkan nama metode pembayaran..." required>
                            </div>
                            <button type="submit"
                                class="w-full sm:w-auto text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none 
                                focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700">
                                SIMPAN
                            </button>
                        </form>
                    </div>
                    <!-- Table Section -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                        <div class="mb-4 text-base sm:text-lg font-medium text-gray-700 dark:text-gray-300">
                            DAFTAR METODE PEMBAYARAN
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-600 dark:text-gray-300">
                                    <tr>
                                        <th scope="col" class="px-4 py-2 sm:py-3">NO</th>
                                        <th scope="col" class="px-4 py-2 sm:py-3">METODE PEMBAYARAN</th>
                                        <th scope="col" class="px-4 py-2 sm:py-3">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($metode as $key => $M)
                                        <tr
                                            class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="px-4 py-2 sm:py-3">
                                                {{ $metode->perPage() * ($metode->currentPage() - 1) + $key + 1 }}
                                            </td>
                                            <td class="px-4 py-2 sm:py-3">{{ $M->metode_pembayaran }}</td>
                                            <td class="px-4 py-2 sm:py-3 flex flex-col gap-2 sm:flex-row">
                                                <button type="button"
                                                    class="w-full sm:w-auto bg-amber-400 p-2 rounded-lg text-white hover:bg-amber-500 transition-colors"
                                                    onclick="editSourceModal(this)" data-modal-target="sourceModal"
                                                    data-id="{{ $M->id }}"
                                                    data-metode_pembayaran="{{ $M->metode_pembayaran }}">
                                                    <i class="fi fi-sr-file-edit"></i> Edit
                                                </button>
                                                <button type="button"
                                                    class="w-full sm:w-auto bg-red-500 p-2 rounded-lg text-white hover:bg-red-600 transition-colors mt-2 sm:mt-0"
                                                    onclick="return paketDelete('{{ $M->id }}','{{ $M->metode_pembayaran }}')">
                                                    <i class="fi fi-sr-delete-document"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 flex justify-end items-center">
                            {{ $metode->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Responsive Modal -->
    <div id="sourceModal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50" onclick="sourceModalClose()"></div>
        <div class="relative w-full max-w-md mx-auto mt-10">
            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4 sm:p-6">
                <div class="flex justify-between items-center mb-4 border-b pb-2 dark:border-gray-600">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-gray-300">Update Metode
                        Pembayaran</h3>
                    <button type="button" onclick="sourceModalClose()"
                        class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form id="editForm" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label for="edit_metode_pembayaran"
                            class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Metode Pembayaran
                        </label>
                        <input type="text" id="edit_metode_pembayaran" name="metode_pembayaran"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            required>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="sourceModalClose()"
                            class="text-gray-600 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 
                            rounded-lg border border-gray-200 text-sm font-medium px-4 py-2 hover:text-gray-900 
                            dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">
                            Batal
                        </button>
                        <button type="submit"
                            class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 
                            font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Handle Add Form Submission
        document.getElementById('addForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            try {
                const response = await axios.post('{{ route('metode_pembayaran.store') }}', formData);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Metode Pembayaran berhasil ditambahkan!',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true,
                }).then(() => location.reload());
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: error.response.data.message || 'Gagal menambahkan data.',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true,
                    });
                } else {
                    console.error(error);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Terjadi kesalahan!',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true,
                    });
                }
            }
        });

        // Handle Edit Modal
        const editSourceModal = (button) => {
            const modal = document.getElementById('sourceModal');
            const form = document.getElementById('editForm');
            const id = button.dataset.id;
            const metode_pembayaran = button.dataset.metode_pembayaran;

            // Set form action and input value
            form.action = `/metode_pembayaran/${id}`;
            document.getElementById('edit_metode_pembayaran').value = metode_pembayaran;

            // Show modal
            modal.classList.remove('hidden');
        };

        // Close Modal
        const sourceModalClose = () => {
            const modal = document.getElementById('sourceModal');
            modal.classList.add('hidden');
        };

        // Handle Edit Form Submission
        document.getElementById('editForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = this.action.split('/').pop();
            try {
                const response = await axios.post(`/metode_pembayaran/${id}`, formData);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Metode Pembayaran berhasil diperbarui!',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true,
                }).then(() => location.reload());
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: error.response.data.message || 'Gagal memperbarui data.',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true,
                    });
                } else {
                    console.error(error);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Terjadi kesalahan!',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true,
                    });
                }
            }
        });

        // Handle Delete Action
        const paketDelete = async (id, metode_pembayaran) => {
            const isConfirmed = await Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Anda akan menghapus metode pembayaran "${metode_pembayaran}".`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            });
            if (isConfirmed.isConfirmed) {
                try {
                    await axios.post(`/metode_pembayaran/${id}`, {
                        '_method': 'DELETE',
                        '_token': '{{ csrf_token() }}'
                    });
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Metode Pembayaran berhasil dihapus!',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true,
                    }).then(() => location.reload());
                } catch (error) {
                    console.error(error);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Gagal menghapus metode pembayaran.',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true,
                    });
                }
            }
        };
    </script>

    @if (session('message_insert'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{ session('message_insert') }}',
                showConfirmButton: false,
                timer: 1500,
                toast: true,
            });
        </script>
    @endif

    @if (session('message_update'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{ session('message_update') }}',
                showConfirmButton: false,
                timer: 1500,
                toast: true,
            });
        </script>
    @endif

    @if (session('message_delete'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{ session('message_delete') }}',
                showConfirmButton: false,
                timer: 1500,
                toast: true,
            });
        </script>
    @endif
</x-app-layout>
