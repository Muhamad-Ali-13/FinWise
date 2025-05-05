<x-app-layout>
    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-2">
            <div class="bg-gray-800 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Header Section -->
                <div class="p-2 sm:p-5 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900 text-white">DATA PENGELUARAN</h3>
                    <button type="button" onclick="openAddModal()"
                        class="text-white bg-gray-900 hover:bg-gray-800 focus:ring-4 focus:outline-none 
                        focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-600 dark:hover:bg-gray-700">
                        TAMBAH
                    </button>
                </div>
                <!-- Table Section -->
                <div class="bg-gray-800 text-white dark:bg-gray-500 p-4 rounded-lg shadow">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left text-white dark:text-gray-400">
                            <thead class="text-xs text-white uppercase bg-gray-900 dark:bg-gray-600 dark:text-gray-300">
                                <tr>
                                    <th scope="col" class="px-4 py-3">NO</th>
                                    <th scope="col" class="px-4 py-3">USER</th>
                                    <th scope="col" class="px-4 py-3">KATEGORI</th>
                                    <th scope="col" class="px-4 py-3">JUMLAH</th>
                                    <th scope="col" class="px-4 py-3">METODE PEMBAYARAN</th>
                                    <th scope="col" class="px-4 py-3">TANGGAL</th>
                                    <th scope="col" class="px-4 py-3">KETERANGAN</th>
                                    @can('role-A')
                                    <th scope="col" class="px-4 py-3">ACTION</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($pengeluaran as $key => $P)
                                    <tr class="border-b dark:border-gray-700 hover:bg-gray-600 dark:hover:bg-gray-700">
                                        <td class="px-4 py-2 sm:py-3">
                                            {{ $pengeluaran->perPage() * ($pengeluaran->currentPage() - 1) + $key + 1 }}
                                        </td>
                                        <td class="px-4 py-3">{{ $P->user->name }}</td>
                                        <td class="px-4 py-3">{{ $P->kategori->nama_kategori }}</td>
                                        <td class="px-4 py-3">{{ number_format($P->jumlah, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3">{{ $P->metodePembayaran->metode_pembayaran }}</td>
                                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($P->tanggal)->format('d/m/Y') }}
                                        </td>
                                        <td class="px-4 py-3">{{ $P->keterangan ?? '-' }}</td>
                                        @can('role-A')
                                        <td class="px-4 py-3 flex flex-col gap-2 sm:flex-row">
                                            <button type="button"
                                                class="w-full sm:w-auto bg-amber-400 p-2 rounded-lg text-white hover:bg-amber-500 transition-colors"
                                                onclick="editSourceModal(this)" data-modal-target="editModal"
                                                data-id="{{ $P->id }}" data-user_id="{{ $P->user_id }}"
                                                data-kategori_id="{{ $P->kategori_id }}"
                                                data-jumlah="{{ $P->jumlah }}"
                                                data-metode_pembayaran_id="{{ $P->metode_pembayaran_id }}"
                                                data-tanggal="{{ $P->tanggal }}"
                                                data-keterangan="{{ $P->keterangan }}">
                                                <i class="fi fi-sr-file-edit"></i> Edit
                                            </button>
                                            <button type="button"
                                                class="w-full sm:w-auto bg-red-500 p-2 rounded-lg text-white hover:bg-red-600 transition-colors mt-2 sm:mt-0"
                                                onclick="return pengeluaranDelete('{{ $P->id }}','{{ $P->kategori->nama_kategori }}')">
                                                <i class="fi fi-sr-delete-document"></i> Hapus
                                            </button>
                                        </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 flex justify-end">
                        {{ $pengeluaran->links() }}
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
                        Tambah Pengeluaran
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
                        <label for="kategori_id"
                            class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Kategori
                        </label>
                        <select id="kategori_id" name="kategori_id"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
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
                        <label for="metode_pembayaran_id"
                            class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Metode Pembayaran
                        </label>
                        <select id="metode_pembayaran_id" name="metode_pembayaran_id"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            required>
                            <option value="" disabled selected>Pilih Metode Pembayaran</option>
                            @foreach ($metode_pembayaran as $m)
                                <option value="{{ $m->id }}">{{ $m->metode_pembayaran }}</option>
                            @endforeach
                        </select>
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
                        <label for="keterangan"
                            class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
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
            <div class="bg-white dark:bg-gray-700 rounded-2xl shadow-xl p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-4 border-b pb-2 dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-200">
                        Update Pemasukan
                    </h3>
                    <button type="button" onclick="closeEditModal()"
                        class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>

                <!-- Form -->
                <form id="editForm" class="space-y-4">
                    @csrf
                    <input type="hidden" name="edit_user_id" id="edit_user_id" value="{{ Auth::id() }}">

                    <!-- Kategori -->
                    <div>
                        <label for="edit_kategori_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Kategori
                        </label>
                        <select id="edit_kategori_id" name="kategori_id"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                        dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jumlah -->
                    <div>
                        <label for="edit_jumlah"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Jumlah
                        </label>
                        <input type="number" id="edit_jumlah" name="jumlah"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                        dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            required>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div>
                        <label for="edit_metode_pembayaran_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Metode Pembayaran
                        </label>
                        <select id="edit_metode_pembayaran_id" name="metode_pembayaran_id"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                        dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            required>
                            <option value="" disabled selected>Pilih Metode Pembayaran</option>
                            @foreach ($metode_pembayaran as $m)
                                <option value="{{ $m->id }}">{{ $m->metode_pembayaran }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label for="edit_tanggal"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Tanggal
                        </label>
                        <input type="date" id="edit_tanggal" name="tanggal"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                        dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            required>
                    </div>

                    <!-- Keterangan -->
                    <div>
                        <label for="edit_keterangan"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Keterangan
                        </label>
                        <textarea id="edit_keterangan" name="keterangan"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                        dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                            rows="3" placeholder="Masukkan keterangan..."></textarea>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-3 pt-2">
                        <button type="button" onclick="closeEditModal()"
                            class="text-gray-600 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 
                        rounded-lg border border-gray-300 text-sm font-medium px-4 py-2 dark:bg-gray-700 dark:text-gray-300 
                        dark:border-gray-500 dark:hover:bg-gray-600 dark:hover:text-white">
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
        // Open Edit Modal
        function editSourceModal(button) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');

            const id = button.dataset.id;
            const kategori_id = button.dataset.kategori_id;
            const jumlah = button.dataset.jumlah;
            const metode_pembayaran_id = button.dataset.metode_pembayaran_id;
            const tanggal = button.dataset.tanggal;
            const keterangan = button.dataset.keterangan;

            form.action = `/pengeluaran/${id}`;
            document.getElementById('edit_kategori_id').value = kategori_id;
            document.getElementById('edit_jumlah').value = jumlah;
            document.getElementById('edit_metode_pembayaran_id').value = metode_pembayaran_id;
            document.getElementById('edit_tanggal').value = tanggal;
            document.getElementById('edit_keterangan').value = keterangan;

            modal.classList.remove('hidden');
        }
        // Close Edit Modal
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
        // Handle Add Form Submission
        document.getElementById('addForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            try {
                const response = await axios.post('{{ route('pengeluaran.store') }}', formData);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Pengeluaran berhasil ditambahkan!',
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
        // Handle Edit Form Submission
        document.getElementById('editForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = this.action.split('/').pop();

            // Tambahkan method PATCH ke formData
            formData.append('_method', 'PATCH');

            try {
                const response = await axios.post(`/pengeluaran/${id}`, formData, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Pengeluaran berhasil diperbarui!',
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
        function pengeluaranDelete(id, nama_kategori) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Anda akan menghapus pengeluaran "${nama_kategori}".`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(`/pengeluaran/${id}`, {
                        '_method': 'DELETE',
                        '_token': '{{ csrf_token() }}'
                    }).then(() => {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Pengeluaran berhasil dihapus!',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true,
                        }).then(() => location.reload());
                    }).catch((error) => {
                        console.error(error);
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Gagal menghapus pengeluaran.',
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
