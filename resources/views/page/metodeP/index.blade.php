<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('METODE PEMBAYARAN') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex gap-5">
                    {{-- FORM ADD --}}
                    <div class="w-full bg-gray-100 p-4 rounded-xl">
                        <div class="mb-5">
                            INPUT DATA METODE PEMBAYARAN
                        </div>
                        <form action="{{ route('metode_pembayaran.store') }}" method="post">
                            @csrf
                            <div class="mb-5">
                                <label for="base-input"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Metode
                                    Pembayaran</label>
                                <input name="metode_pembayaran" type="text" id="base-input"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500"
                                    placeholder="Masukan Nama Metode Pembayaran disini...">
                            </div>
                            <button type="submit"
                                class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">SIMPAN</button>
                        </form>
                    </div>
                    {{-- TABLE KONSINYASI PRODUK --}}
                    <div class="w-full">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            NO
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            METODE PEMBAYARAN
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            ACTION
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($metode as $key => $M)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $metode->perPage() * ($metode->currentPage() - 1) + $key + 1 }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $M->metode_pembayaran }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <button type="button" type="button"
                                                    class="w-full sm:w-auto bg-amber-400 p-2 rounded-lg text-white hover:bg-amber-500 transition-colors"
                                                    onclick="editSourceModal(this)" data-modal-target="sourceModal"
                                                    data-id="{{ $M->id }}"
                                                    data-metode_pembayaran="{{ $M->metode_pembayaran }}">
                                                    <i class="fi fi-sr-file-edit"></i> Edit
                                                </button>

                                                <button
                                                     type="button"
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
                        <div class="mt-4">
                            {{ $metode->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="sourceModal">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="w-full md:w-1/2 relative bg-white rounded-lg shadow mx-5">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900" id="title_source">
                        Update Sumber Database
                    </h3>
                    <button type="button" onclick="sourceModalClose(this)" data-modal-target="sourceModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                        data-modal-hide="defaultModal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form method="POST" id="formSourceModal">
                    @csrf
                    @method('PATCH')
                    <div class="flex flex-col  p-4 space-y-6">
                        <div class="mb-5">
                            <label for="metode_pembayaran" class="block mb-2 text-sm font-medium text-gray-900">Metode
                                Pembayaran</label>
                            <input type="text" id="metode_pembayaran" name="metode_pembayaran"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukan Metode Pembayaran disini...">
                        </div>
                    </div>
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit" id="formSourceButton"
                            class="bg-green-400 m-2 w-40 h-10 rounded-xl hover:bg-green-500">Simpan</button>
                        <button type="button" data-modal-target="sourceModal" onclick="sourceModalClose(this)"
                            class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:shadow-lg hover:bg-red-600">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    const editSourceModal = (button) => {
        const formModal = document.getElementById('formSourceModal');
        const modal = document.getElementById('sourceModal');

        const id = button.dataset.id;
        const metode_pembayaran = button.dataset.metode_pembayaran;

        // Perbaiki URL aksi form
        let url = "{{ route('metode_pembayaran.update', ':id') }}".replace(':id', id);
        formModal.setAttribute('action', url);

        // Perbaiki input
        document.getElementById('metode_pembayaran').value = metode_pembayaran;

        // Pastikan tidak ada duplikasi input _method
        let existingMethodInput = document.querySelector('[name="_method"]');
        if (!existingMethodInput) {
            let methodInput = document.createElement('input');
            methodInput.setAttribute('type', 'hidden');
            methodInput.setAttribute('name', '_method');
            methodInput.setAttribute('value', 'PATCH');
            formModal.appendChild(methodInput);
        }

        // Tampilkan modal
        modal.classList.remove('hidden');
    };


    const sourceModalClose = (button) => {
        const modalTarget = button.dataset.modalTarget;
        let status = document.getElementById(modalTarget);
        status.classList.toggle('hidden');
    }

    const paketDelete = async (id, metode_pembayaran) => {
        let tanya = confirm(`Apakah anda yakin untuk menghapus Metode ${metode_pembayaran} ?`);
        if (tanya) {
            await axios.post(`/metode_pembayaran/${id}`, {
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
