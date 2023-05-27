<!DOCTYPE html>
<html>

<head>
    <title>Laporan Stok Barang</title>
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
        <h5 class="mb-2">Laporan Stok Barang</h5>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah Stok</th>
                <th>Satuan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($stok as $p)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $p->nama_barang }}</td>
                    <td>{{ $p->jumlah_stok }}</td>
                    <td>{{ $p->satuan }}</td>
                    <td>{{ $p->tgl_dibuat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
