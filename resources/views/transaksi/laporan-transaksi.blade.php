<!DOCTYPE html>
<html>

<head>
    <title>Laporan Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        <h5 class="mb-2">Laporan Barang</h5>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Outlet</th>
                <th>Nama Barang</th>
                <th>Nama Pegawai</th>
                <th>Customer</th>
                <th>Jumlah Barang</th>
                <th>Harga Barang</th>
                <th>Ongkos Kirim</th>
                <th>Total Harga</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($transaksi as $p)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $p->nama_outlet }}</td>
                    <td>{{ $p->nama_barang }}</td>
                    <td>{{ $p->nama_pegawai }}</td>
                    <td>{{ $p->tujuan }}</td>
                    <td>{{ $p->jumlah_barang }}</td>
                    <td>{{ $p->harga }}</td>
                    <td>{{ $p->ongkos_kirim }}</td>
                    <td>{{ $p->total_harga + $p->ongkos_kirim }}</td>
                    <td>{{ tanggal_local($p->tgl_transaksi) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
