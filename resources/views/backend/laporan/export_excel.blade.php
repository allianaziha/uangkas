<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kas</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan - {{ ucfirst($jenis) }}</h2>
    <br>
    @if($jenis == 'pengeluaran' || $jenis == 'pemasukkan')
        <table border="1" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ ucfirst($data->jenis) }}</td>
                    <td>Rp. {{ number_format($data->jumlah,0,',','.') }}</td>
                    <td>{{ $data->keterangan }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d M Y') }}</td>
                </tr>
                @endforeach
                <tr>
                    <th>Saldo Kas : </th>
                    <td colspan="4" style="text-align: center">Rp. {{ number_format($saldoKas,0,',','.') }}</td>
                </tr>
            </tbody>
        </table>
    @elseif($jenis == 'kas')
        <table border="1" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Minggu Ke</th>
                    <th>Bulan</th>
                    <th>Jumlah</th>
                    <th>Tanggal Bayar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->user->name ?? '-' }}</td>
                    <td>{{ ucfirst($data->status) }}</td>
                    <td>{{ $data->minggu_ke }}</td>
                    <td>{{ \Carbon\Carbon::create()->month($data->bulan)->translatedFormat('F') }}</td>
                    <td>Rp. {{ number_format($data->jumlah,0,',','.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal_bayar)->translatedFormat('d M Y') }}</td>
                </tr>
                @endforeach
                <tr>
                    <th>Saldo Kas : </th>
                    <td colspan="6" style="text-align: center">Rp. {{ number_format($saldoKas,0,',','.') }}</td>
                </tr>
                <tr>
                    <th>Saldo Tunggakan :</th>
                    <td colspan="6" style="text-align: center">Rp. {{ number_format($saldoNunggak,0,',','.') }}</td>
                </tr>
            </tbody>
        </table>
    @endif
</body>
</html>
