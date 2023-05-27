<!DOCTYPE html>
<html>

<head>
    <title>Laporan Mutasi</title>
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
        <h5 class="mb-2">Laporan Mutasi</h5>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Asal</th>
                <th>Tujuan</th>
                <th>Jumlah Mutasi</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Tanggal Mutasi</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($mutasi as $p)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $p->nama_barang }}</td>
                    <td>{{ $p->asal }}</td>
                    <td>{{ $p->tujuan }}</td>
                    <td>{{ $p->jumlah_mutasi }}</td>
                    <td>{{ $p->keterangan }}</td>
                    <td>{{ $p->status }}</td>
                    <td>{{ tanggal_local($p->tgl_mutasi) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
