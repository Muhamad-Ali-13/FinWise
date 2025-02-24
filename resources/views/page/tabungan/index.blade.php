<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tabungan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="gap-5 items-start flex">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-full p-4">
                    <div class="p-4 bg-gray-100 mb-2 rounded-xl font-bold">
                        <div class="flex items-center justify-between">
                            <div class="w-full">
                                TABUNGAN
                            </div>
                            <div>
                                <a href="{{ route('tabungan.create') }}"
                                    class="bg-sky-400 p-1 text-white rounded-xl px-4">Tambah</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 bg-gray-100">NO</th>
                                        <th scope="col" class="px-6 py-3">Tujuan</th>
                                        <th scope="col" class="px-6 py-3">Jumlah</th>
                                        <th scope="col" class="px-6 py-3">Tanggal</th>
                                        <th scope="col" class="px-6 py-3">Keterangan</th>
                                        <th scope="col" class="px-6 py-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($tabungan as $t)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white bg-gray-100">
                                                {{ $no++ }}
                                            </th>
                                            <td class="px-6 py-4">{{ $t->tujuan }}</td>
                                            <td class="px-6 py-4 bg-gray-100">{{ $t->jumlah }}</td>
                                            <td class="px-6 py-4 bg-gray-100">{{ $t->tanggal }}</td>
                                            <td class="px-6 py-4 bg-gray-100">{{ $t->keterangan }}</td>
                                            <td class="px-6 py-4 bg-gray-100">
                                                <button
                                                    class="bg-red-400 p-3 w-10 h-10 rounded-xl text-white hover:bg-red-500"
                                                    onclick="return dataDelete('{{ $t->id }}','{{ $t->tujuan }}')">
                                                    <i class="fi fi-sr-delete-document"></i>
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
    </div>

    <script>
        const dataDelete = async (id, tujuan) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus tabungan dengan tujuan ${tujuan}?`);
            if (tanya) {
                try {
                    const response = await axios.post(`/tabungan/${id}`, {
                        '_method': 'DELETE',
                        '_token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    });

                    if (response.status === 200) {
                        alert('Tabungan berhasil dihapus');
                        location.reload();
                    } else {
                        alert('Gagal menghapus tabungan. Silakan coba lagi.');
                    }
                } catch (error) {
                    console.error(error);
                    alert('Terjadi kesalahan saat menghapus tabungan. Silakan cek konsol untuk detail.');
                }
            }
        };
    </script>
</x-app-layout>
