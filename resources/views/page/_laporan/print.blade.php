<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengeluaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page {
            size: A4 portrait;
            margin: 20mm;
        }

        body {
            background: #1f2937;
            /* gray-800 */
            margin: 0;
            font-family: 'Tahoma', sans-serif;
            color: #1f2937;
        }

        .page {
            background: white;
            width: 210mm;
            min-height: 297mm;
            margin: 20px auto;
            padding: 20mm;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .kop {
            text-align: center;
            margin-bottom: 20px;
        }

        .kop h1 {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
            /* gray-800 */
            margin-bottom: 4px;
        }

        .periode {
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            /* gray-500 */
            margin-top: 2px;
        }

        .divider {
            border-top: 2px solid #1f2937;
            /* gray-800 */
            margin: 15px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-top: 20px;
        }

        th {
            background-color: #1f2937;
            /* gray-800 */
            color: white;
            padding: 8px;
            text-align: center;
            border: 1px solid #d1d5db;
            /* gray-300 */
        }

        td {
            padding: 8px;
            border: 1px solid #d1d5db;
            /* gray-300 */
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f9fafb;
            /* gray-50 */
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .signature {
            width: 100%;
            margin-top: 60px;
            text-align: right;
            padding-right: 40px;
            font-size: 14px;
            color: #1f2937;
            /* gray-800 */
        }

        .signature p {
            margin-bottom: 80px;
        }
    </style>
</head>

<body>

    <div class="page">
        <!-- Kop Surat -->
        <div class="kop">
            <div></div>
            <!-- Logo -->
            <div class="flex items-center">
                <img src="{{ asset('image/FinWise.png') }}" alt="FinWise" width="100" height="100">
            </div>
            <div class="flex items-center justify-between mb-4">
                <!-- Judul -->
                <div class="flex-1 text-center">
                    <h1 class="text-2xl font-bold text-gray-800">LAPORAN TABUNGAN</h1>
                </div>
            </div>

            <!-- Periode -->
            <div class="periode text-center text-gray-600">
                {{ \Carbon\Carbon::parse($dari)->format('d-m-Y') }}
                &nbsp; s/d &nbsp;
                {{ \Carbon\Carbon::parse($sampai)->format('d-m-Y') }}
            </div>
        </div>


        <div class="divider"></div>

        <!-- Tabel Pengeluaran -->
        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA</th>
                    <th>JUMLAH</th>
                    <th>TUJUAN</th>
                    <th>TANGGAL</th>
                    <th>KETERANGAN</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $d)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $d->user->name }}</td>
                        <td>Rp {{ number_format($d->jumlah, 0, ',', '.') }}</td>
                        <td>{{ $d->tujuan }}</td>
                        <td>{{ \Carbon\Carbon::parse($d->tanggal)->format('d-m-Y') }}</td>
                        <td>{{ $d->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tanda Tangan -->
        <div class="signature">
            <p>Mengetahui,</p>
            <p><strong>{{ auth()->user()->name }}</strong></p>
        </div>
    </div>

</body>

</html>
