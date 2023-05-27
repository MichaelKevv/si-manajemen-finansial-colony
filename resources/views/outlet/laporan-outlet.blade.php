<!DOCTYPE html>
<html>

<head>
    <title>Laporan Outlet</title>
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
        <h5 class="mb-2">Laporan Outlet</h5>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tipe</th>
                <th>Deskripsi</th>
                <th>Alamat</th>
                <th>Latitude</th>
                <th>Longitude</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($outlet as $p)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->tipe }}</td>
                    <td>{{ $p->deskripsi }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>{{ $p->latitude }}</td>
                    <td>{{ $p->longitude }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
