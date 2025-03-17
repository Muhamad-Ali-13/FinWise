<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('KATEGORI') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">


                <!-- Responsive Grid Container -->
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Form Section -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                        <div class="mb-5 text-lg font-medium text-gray-700 dark:text-gray-300">
                            INPUT DATA KATEGORI
                        </div>
                        <form action="{{ route('kategori.store') }}" method="post">
                            @csrf
                            <div class="mb-4">
                                <label for="nama_kategori"
                                    class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                                    Nama Kategori
                                </label>
                                <input type="text" name="nama_kategori" id="nama_kategori"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                                    dark:border-gray-500 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 p-2.5"
                                    placeholder="Masukkan nama kategori..." required>
                            </div>
                            <button type="submit"
                                class="w-full sm:w-auto text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none 
                                focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-600 dark:hover:bg-gray-700">
                                SIMPAN
                            </button>
                        </form>
                    </div>

                    <!-- Table Section -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                        <div class="mb-5 text-lg font-medium text-gray-700 dark:text-gray-300">
                            DAFTAR KATEGORI
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-600 dark:text-gray-300">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">NO</th>
                                        <th scope="col" class="px-4 py-3">NAMA KATEGORI</th>
                                        <th scope="col" class="px-4 py-3">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Kategori as $key => $k)
                                        <tr
                                            class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                            <td class="px-4 py-3">{{ $k->nama_kategori }}</td>
                                            <td class="px-4 py-3 flex flex-col gap-2 sm:flex-row">
                                                <button type="button"
                                                    class="w-full sm:w-auto bg-amber-400 p-2 rounded-lg text-white hover:bg-amber-500 transition-colors"
                                                    onclick="editSourceModal(this)" data-modal-target="sourceModal"
                                                    data-id="{{ $k->id }}"
                                                    data-nama_kategori="{{ $k->nama_kategori }}">
                                                    <i class="fi fi-sr-file-edit"></i> Edit
                                                </button>
                                                <button type="button"
                                                    class="w-full sm:w-auto bg-red-500 p-2 rounded-lg text-white hover:bg-red-600 transition-colors mt-2 sm:mt-0"
                                                    onclick="return kategoriDelete('{{ $k->id }}','{{ $k->nama_kategori }}')">
                                                    <i class="fi fi-sr-delete-document"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $Kategori->links() }}
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
            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4 border-b pb-2 dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-300">Update Kategori</h3>
                    <button type="button" onclick="sourceModalClose()"
                        class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form method="POST" id="formSourceModal" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label for="nama_kategori"
                            class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                            Nama Kategori
                        </label>
                        <input type="text" id="nama_kategori" name="nama_kategori"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 dark:text-white dark:bg-gray-600 
                            dark:border-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                            required>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="sourceModalClose()"
                            class="text-gray-600 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 
                            rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 
                            dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">
                            Batal
                        </button>
                        <button type="submit"
                            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 
                            font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk handle modal edit
        const editSourceModal = (button) => {
            const modal = document.getElementById('sourceModal');
            const form = document.getElementById('formSourceModal');
            const id = button.dataset.id;
            const nama_kategori = button.dataset.nama_kategori;

            // Set form action
            form.action = `/kategori/${id}`;

            // Isi input dengan data saat ini
            document.getElementById('nama_kategori').value = nama_kategori;

            // Tampilkan modal
            modal.classList.remove('hidden');
        };

        const sourceModalClose = (button) => {
            const modalTarget = button.dataset.modalTarget;
            let status = document.getElementById(modalTarget);
            status.classList.toggle('hidden');
        }

        const kategoriDelete = async (id, kategori) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus Metode ${kategori} ?`);
            if (tanya) {
                await axios.post(`/kategori/${id}`, {
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
    </script>

    @if (session('message_insert'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('message_insert') }}',
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
