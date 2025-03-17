<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('TABUNGAN') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Header Section -->
                <div class="p-4 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">DATA TABUNGAN</h3>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                    <button type="button" onclick="openAddModal()"
                        class="w-full sm:w-auto text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none 
                        focus:ring-gray-300 font-medium rounded-lg text-end px-5 py-2.5 dark:bg-gray-600 dark:hover:bg-gray-700 mb-4">
                        TAMBAH TABUNGAN
                    </button>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-600 dark:text-gray-300">
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
                            <tbody id="tabunganTable">
                                @foreach ($tabungan as $key => $t)
                                    <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                        data-id="{{ $t->id }}">
                                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3">{{ $t->user->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3">{{ number_format($t->jumlah, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3">{{ $t->tujuan }}</td>
                                        <td class="px-4 py-3">{{ $t->tanggal}}</td>
                                        <td class="px-4 py-3">{{ $t->keterangan }}</td>
                                        <td class="px-4 py-3 flex flex-col gap-2 sm:flex-row">
                                            <button type="button"
                                                class="w-full sm:w-auto bg-amber-400 p-2 rounded-lg text-white hover:bg-amber-500 transition-colors"
                                                onclick="editTabunganModal(this)" data-modal-target="editModal"
                                                data-id="{{ $t->id }}">
                                                <i class="fi fi-sr-file-edit"></i> Edit
                                            </button>
                                            <button type="button"
                                                class="w-full sm:w-auto bg-red-500 p-2 rounded-lg text-white hover:bg-red-600 transition-colors mt-2 sm:mt-0"
                                                onclick="deleteTabungan('{{ $t->id }}')">
                                                <i class="fi fi-sr-delete-document"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
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
            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4 border-b pb-2 dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-300">Tambah Tabungan</h3>
                    <button type="button" onclick="closeAddModal()"
                        class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form id="addForm" class="space-y-4">
                    @csrf
                    <div>
                        <label for="add_user_id"
                            class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            User
                        </label>
                        <select id="add_user_id" name="user_id"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            required>
                            <option value="" disabled selected>Pilih User</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="add_jumlah" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Jumlah
                        </label>
                        <input type="number" id="add_jumlah" name="jumlah"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            placeholder="Masukkan jumlah..." required>
                    </div>
                    <div>
                        <label for="add_tujuan" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Tujuan
                        </label>
                        <input type="text" id="add_tujuan" name="tujuan"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            placeholder="Masukkan tujuan..." required>
                    </div>
                    <div>
                        <label for="add_tanggal"
                            class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Tanggal
                        </label>
                        <input type="date" id="add_tanggal" name="tanggal"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            required>
                    </div>
                    <div>
                        <label for="add_keterangan"
                            class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Keterangan
                        </label>
                        <textarea id="add_keterangan" name="keterangan"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            placeholder="Masukkan keterangan..."></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeAddModal()"
                            class="text-gray-600 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 
                            rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 
                            dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">
                            Batal
                        </button>
                        <button type="submit"
                            class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 
                            font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-600 dark:hover:bg-gray-700">
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
            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4 border-b pb-2 dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-300">Update Tabungan</h3>
                    <button type="button" onclick="closeEditModal()"
                        class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form id="editForm" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="edit_user_id"
                            class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            User
                        </label>
                        <select id="edit_user_id" name="user_id"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            required>
                            <option value="" disabled selected>Pilih User</option>
                            @foreach ($users as $users)
                                <option value="{{ $users->id }}">{{ $users->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="edit_jumlah"
                            class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Jumlah
                        </label>
                        <input type="number" id="edit_jumlah" name="jumlah"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            required>
                    </div>
                    <div>
                        <label for="edit_tujuan"
                            class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Tujuan
                        </label>
                        <input type="text" id="edit_tujuan" name="tujuan"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            required>
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
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeEditModal()"
                            class="text-gray-600 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 
                            rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 
                            dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">
                            Batal
                        </button>
                        <button type="submit"
                            class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 
                            font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-600 dark:hover:bg-gray-700">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Open Add Modal
        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }

        // Close Add Modal
        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }

        // Handle Add Form Submission
        document.getElementById('addForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            axios.post('{{ route('tabungan.store') }}', formData)
                .then(response => {
                    Swal.fire('Berhasil!', 'Data tabungan berhasil ditambahkan.', 'success')
                        .then(() => location.reload());
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire('Error!', 'Gagal menambahkan data.', 'error');
                });
        });

        // Edit Modal Handler
        function editTabunganModal(button) {
            const id = button.dataset.id;
            const row = button.closest('tr');
            axios.get(`/tabungan/${id}`)
                .then(response => {
                    const data = response.data;
                    document.getElementById('edit_user_id').value = data.user_id;
                    document.getElementById('edit_jumlah').value = data.jumlah;
                    document.getElementById('edit_tujuan').value = data.tujuan;
                    document.getElementById('edit_tanggal').value = data.tanggal;
                    document.getElementById('edit_keterangan').value = data.keterangan;
                    document.getElementById('editForm').action = `/tabungan/${id}`;
                    document.getElementById('editModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire('Error!', 'Gagal memuat data.', 'error');
                });
        }

        // Edit Form Submission
        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = this.action.split('/').pop();
            axios.post(`/tabungan/${id}`, formData)
                .then(response => {
                    Swal.fire('Diperbarui!', 'Data berhasil diperbarui.', 'success')
                        .then(() => location.reload());
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire('Error!', 'Gagal memperbarui data.', 'error');
                });
        });

        const deleteTabungan = async (id, tabungan) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus Metode ${tabungan} ?`);
            if (tanya) {
                await axios.post(`/tabungan/${id}`, {
                        '_method': 'DELETE',
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    })
                    .then(function(response) {
                        // Handle success
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                        Swal.fire({
                            title: 'Deleted!',
                            text: '{{ session('message_delete') }}',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    })
                    .catch(function(error) {
                        // Handle error
                        alert('Error deleting record');
                        console.log(error);
                    });
            }
        }

        // Modal Control
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
    @if (session('message_insert'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('message_inse') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    @if (session('message_update'))
        <script>
            Swal.fire({
                title: 'Updated!',
                text: '{{ session('message_update') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
</x-app-layout>
