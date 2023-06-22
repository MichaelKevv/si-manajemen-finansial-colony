<!DOCTYPE html>
<html>

<head>
    <title>Laporan Konsumen</title>
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
        <h5 class="mb-2">Laporan Konsumen</h5>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Nomor HP</th>
                <th>Email</th>
                <th>Username</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($konsumen as $p)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>{{ $p->no_hp }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->username }}</td>
                    <td>
                        <img src="{{ storage_path('app/public/foto-konsumen/'.$p->foto) }}" style="width: 100px">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
