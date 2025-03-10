<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pemasukan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="gap-5 items-start flex">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-full p-4">
                    <div class="p-4 bg-gray-100 mb-2 rounded-xl font-bold">
                        <div class="flex items-center justify-between">
                            <div class="w-full">
                                PEMASUKAN
                            </div>
                            <div>
                                <a href="{{ route('pemasukan.create') }}"
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
                                        <th scope="col" class="px-6 py-3">Nama</th>
                                        <th scope="col" class="px-6 py-3">Kategori</th>
                                        <th scope="col" class="px-6 py-3">Jumlah</th>
                                        <th scope="col" class="px-6 py-3">Tanggal</th>
                                        <th scope="col" class="px-6 py-3">Metode Pembayaran</th>
                                        <th scope="col" class="px-6 py-3">Keterangan</th>
                                        <th scope="col" class="px-6 py-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($pemasukan as $p)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white bg-gray-100">
                                                {{ $no++ }}
                                            </th>
                                            <td class="px-6 py-4">{{ $p->users->name }}</td>
                                            <td class="px-6 py-4">{{ $p->kategori->nama_kategori }}</td>
                                            <td class="px-6 py-4 bg-gray-100">{{ $p->jumlah }}</td>
                                            <td class="px-6 py-4 bg-gray-100">{{ $p->tanggal }}</td>
                                            <td class="px-6 py-4 bg-gray-100">{{ $p->metode_pembayaran->nama_metode }}
                                            </td>
                                            <td class="px-6 py-4 bg-gray-100">{{ $p->keterangan }}</td>
                                            <td class="px-6 py-4 bg-gray-100">
                                                <button
                                                    class="bg-red-400 p-3 w-10 h-10 rounded-xl text-white hover:bg-red-500"
                                                    onclick="return dataDelete('{{ $p->id }}','{{ $p->kategori->nama_kategori }}')">
                                                    <i class="fi fi-sr-delete-document"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $pemasukan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const dataDelete = async (id, nama_kategori) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus pemasukan kategori ${nama_kategori}?`);
            if (tanya) {
                try {
                    const response = await axios.post(`/pemasukan/${id}`, {
                        '_method': 'DELETE',
                        '_token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    });

                    if (response.status === 200) {
                        alert('Pemasukan berhasil dihapus');
                        location.reload();
                    } else {
                        alert('Gagal menghapus pemasukan. Silakan coba lagi.');
                    }
                } catch (error) {
                    console.error(error);
                    alert('Terjadi kesalahan saat menghapus pemasukan. Silakan cek konsol untuk detail.');
                }
            }
        };
    </script>
</x-app-layout>
