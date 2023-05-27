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
                <th>Nama</th>
                <th>Kategori</th>
                <th>Gudang</th>
                <th>Harga</th>
                <th>Tanggal Masuk</th>
                <th>Tanggal Keluar</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($barang as $p)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->nama_kategori }}</td>
                    <td>{{ $p->nama_gudang }}</td>
                    <td>{{ $p->harga }}</td>
                    <td>{{ $p->tgl_masuk }}</td>
                    <td>{{ $p->tgl_keluar }}</td>
                    <td>{{ $p->deskripsi }}</td>
                    <td>{{ $p->status }}</td>
                    <td>
                        <img src="{{ storage_path('app/public/foto-barang/'.$p->foto) }}" style="width: 200px">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
