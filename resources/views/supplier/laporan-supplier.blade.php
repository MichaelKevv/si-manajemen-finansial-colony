<!DOCTYPE html>
<html>

<head>
    <title>Laporan Supplier</title>
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
        <h5 class="mb-2">Laporan Supplier</h5>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Nama Supplier</th>
                <th>Alamat</th>
                <th>Nomor Telp</th>
                <th>Jumlah Barang</th>
                <th>Harga Supply</th>
                <th>Tanggal Supply</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($supplier as $p)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $p->nama_barang }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>{{ $p->no_telp }}</td>
                    <td>{{ $p->jumlah_barang }}</td>
                    <td>{{ $p->harga_supply }}</td>
                    <td>
                        <?php if($p->tgl_supply != null): ?>
                        <p class="text-xs font-weight-bold mb-0">
                            {{ tanggal_local($p->tgl_supply) }}
                        </p>
                        <?php else : ?>
                        <p class="text-xs font-weight-bold mb-0">
                            Kosong
                        </p>
                        <?php endif; ?>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
