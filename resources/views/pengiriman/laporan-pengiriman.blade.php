<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pengiriman</title>
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
        <h5 class="mb-2">Laporan Pengiriman</h5>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Asal</th>
                <th>Tujuan</th>
                <th>Ongkos Kirim</th>
                <th>Metode Pengiriman</th>
                <th>Tipe Pengiriman</th>
                <th>Tanggal Pengiriman</th>
                <th>Tanggal Diterima</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($pengiriman as $p)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $p->nama_barang }}</td>
                    <td>{{ $p->asal }}</td>
                    <td>{{ $p->tujuan }}</td>
                    <td>{{ $p->ongkos_kirim }}</td>
                    <td>{{ $p->metode_pengiriman }}</td>
                    <td>{{ $p->tipe_pengiriman }}</td>
                    <td>
                        <?php if($p->tgl_pengiriman != null): ?>
                        <p class="text-xs font-weight-bold mb-0">
                            {{ tanggal_local($p->tgl_pengiriman) }}
                        </p>
                        <?php else : ?>
                        <p class="text-xs font-weight-bold mb-0">
                            Kosong
                        </p>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($p->tgl_diterima != null): ?>
                        <p class="text-xs font-weight-bold mb-0">
                            {{ tanggal_local($p->tgl_diterima) }}
                        </p>
                        <?php else : ?>
                        <p class="text-xs font-weight-bold mb-0">
                            Kosong
                        </p>
                        <?php endif; ?>
                    </td>
                    <td>{{ $p->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
