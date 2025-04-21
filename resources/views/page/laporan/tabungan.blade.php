@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Laporan Tabungan</h1>
    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Jumlah</th>
                    <th class="px-4 py-2">Tujuan</th>
                    <th class="px-4 py-2">Keterangan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($data as $item)
                    <tr>
                        <td class="px-4 py-2">{{ $item->tanggal }}</td>
                        <td class="px-4 py-2">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ $item->tujuan }}</td>
                        <td class="px-4 py-2">{{ $item->keterangan }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center py-4">Data kosong</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
