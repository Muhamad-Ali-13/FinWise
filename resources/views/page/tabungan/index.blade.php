<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('TABUNGAN') }}
        </h2>
    </x-slot>
    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-2">
            <div class="bg-gray-700 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Header Section -->
                <div class="p-2 sm:p-5 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900 text-white">DATA TABUNGAN</h3>
                    <button type="button" onclick="openAddModal()"
                        class="text-white bg-gray-500 hover:bg-gray-900 focus:ring-4 focus:outline-none 
                        focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-600 dark:hover:bg-gray-700">
                        TAMBAH TABUNGAN
                    </button>
                </div>
                <!-- Table Section -->
                <div class="bg-gray-700 text-white dark:bg-gray-500 p-4 rounded-lg shadow">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left text-white dark:text-gray-400">
                            <thead class="text-xs text-white uppercase bg-gray-900 dark:bg-gray-600 dark:text-gray-300">
                                <tr>
                                    <th scope="col" class="px-4 py-3">NO</th>
                                    <th scope="col" class="px-4 py-3">USER</th>
                                    <th scope="col" class="px-4 py-3">JUMLAH</th>
                                    <th scope="col" class="px-4 py-3">TUJUAN</th>
                                    <th scope="col" class="px-4 py-3">TANGGAL</th>
                                    <th scope="col" class="px-4 py-3">KETERANGAN</th>
                                    <th scope="col" class="px-4 py-3">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($tabungan as $key => $T)
                                    <tr class="border-b dark:border-gray-700 hover:bg-gray-600 dark:hover:bg-gray-700">
                                        <td class="px-4 py-2 sm:py-3">
                                            {{ $tabungan->perPage() * ($tabungan->currentPage() - 1) + $key + 1 }}
                                        </td>
                                        <td class="px-4 py-3">{{ $T->user->name }}</td>
                                        <td class="px-4 py-3">{{ number_format($T->jumlah, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3">{{ $T->tujuan }}</td>
                                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($T->tanggal)->format('d/m/Y') }}
                                        </td>
                                        <td class="px-4 py-3">{{ $T->keterangan ?? '-' }}</td>
                                        <td class="px-4 py-3 flex flex-col gap-2 sm:flex-row">
                                            <button type="button"
                                                class="w-full sm:w-auto bg-amber-400 p-2 rounded-lg text-white hover:bg-amber-500 transition-colors"
                                                onclick="editSourceModal(this)" data-modal-target="editModal"
                                                data-id="{{ $T->id }}" data-user_id="{{ $T->user_id }}"
                                                data-jumlah="{{ $T->jumlah }}" data-tujuan="{{ $T->tujuan }}"
                                                data-tanggal="{{ $T->tanggal }}"
                                                data-keterangan="{{ $T->keterangan }}">
                                                <i class="fi fi-sr-file-edit"></i> Edit
                                            </button>
                                            <button type="button"
                                                class="w-full sm:w-auto bg-red-500 p-2 rounded-lg text-white hover:bg-red-600 transition-colors mt-2 sm:mt-0"
                                                onclick="return tabunganDelete('{{ $T->id }}','{{ $T->tujuan }}')">
                                                <i class="fi fi-sr-delete-document"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 flex justify-end">
                        {{ $tabungan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal -->
    <div id="addModal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50" onclick="closeAddModal()"></div>
        <div class="relative w-full max-w-md mx-auto mt-10">
            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4 sm:p-6">
                <div class="flex justify-between items-center mb-4 border-b pb-2 dark:border-gray-600">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-gray-300">
                        Tambah Tabungan
                    </h3>
                    <button type="button" onclick="closeAddModal()"
                        class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form id="addForm" class="space-y-4">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <div>
                        <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Jumlah
                        </label>
                        <input type="number" id="jumlah" name="jumlah"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            placeholder="Masukkan jumlah..." required>
                    </div>
                    <div>
                        <label for="tujuan" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Tujuan
                        </label>
                        <input type="text" id="tujuan" name="tujuan"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            placeholder="Masukkan tujuan..." required>
                    </div>
                    <div>
                        <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Tanggal
                        </label>
                        <input type="date" id="tanggal" name="tanggal"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            required>
                    </div>
                    <div>
                        <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Keterangan
                        </label>
                        <textarea id="keterangan" name="keterangan"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            placeholder="Masukkan keterangan..."></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeAddModal()"
                            class="text-gray-600 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 
                            rounded-lg border border-gray-200 text-sm font-medium px-4 py-2 hover:text-gray-900 
                            dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">
                            Batal
                        </button>
                        <button type="submit"
                            class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 
                            font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50" onclick="closeEditModal()"></div>
        <div class="relative w-full max-w-md mx-auto mt-10">
            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4 sm:p-6">
                <div class="flex justify-between items-center mb-4 border-b pb-2 dark:border-gray-600">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-gray-300">
                        Update Tabungan
                    </h3>
                    <button type="button" onclick="closeEditModal()"
                        class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form id="editForm" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <div>
                        <label for="edit_jumlah"
                            class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Jumlah
                        </label>
                        <input type="number" id="edit_jumlah" name="jumlah"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            placeholder="Masukkan jumlah..." required>
                    </div>
                    <div>
                        <label for="edit_tujuan"
                            class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Tujuan
                        </label>
                        <input type="text" id="edit_tujuan" name="tujuan"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            placeholder="Masukkan tujuan..." required>
                    </div>
                    <div>
                        <label for="edit_tanggal"
                            class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Tanggal
                        </label>
                        <input type="date" id="edit_tanggal" name="tanggal"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            required>
                    </div>
                    <div>
                        <label for="edit_keterangan"
                            class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Keterangan
                        </label>
                        <textarea id="edit_keterangan" name="keterangan"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            placeholder="Masukkan keterangan..."></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeEditModal()"
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Open Add Modal
        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }
        // Close Add Modal
        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        async function editSourceModal(button) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            const id = button.dataset.id;

            try {
                const response = await axios.get(`/tabungan/${id}`);
                const data = response.data;

                // Isi input form
                document.getElementById('edit_jumlah').value = data.jumlah;
                document.getElementById('edit_tujuan').value = data.tujuan;
                document.getElementById('edit_tanggal').value = data.tanggal;
                document.getElementById('edit_keterangan').value = data.keterangan;

                // Set action form
                form.action = `/tabungan/${id}`;

                // Tampilkan modal
                modal.classList.remove('hidden');
            } catch (error) {
                console.error(error);
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Gagal memuat data.',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true,
                });
            }
        }
        // Handle Add Form Submission
        document.getElementById('addForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            try {
                const response = await axios.post('{{ route('tabungan.store') }}', formData);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Tabungan berhasil ditambahkan!',
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
        document.getElementById('editForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = this.action.split('/').pop();

            // Pakai _method untuk PATCH atau PUT jika perlu
            formData.append('_method', 'PUT');

            try {
                const response = await axios.post(`/tabungan/${id}`, formData, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Tabungan berhasil diperbarui!',
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
        function tabunganDelete(id, tujuan) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Anda akan menghapus tabungan "${tujuan}".`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(`/tabungan/${id}`, {
                        '_method': 'DELETE',
                        '_token': '{{ csrf_token() }}'
                    }).then(() => {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Tabungan berhasil dihapus!',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true,
                        }).then(() => location.reload());
                    }).catch((error) => {
                        console.error(error);
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Gagal menghapus tabungan.',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true,
                        });
                    });
                }
            });
        }
    </script>
</x-app-layout>
