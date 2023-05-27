<!DOCTYPE html>
<html lang="en">

<head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Laporan Detail Transaksi</title>
    <style>
        .invoice-title h2,
        .invoice-title h3 {
            display: inline-block;
        }

        .table>tbody>tr>.no-line {
            border-top: none;
        }

        .table>thead>tr>.no-line {
            border-bottom: none;
        }

        .table>tbody>tr>.thick-line {
            border-top: 2px solid;
        }
    </style>
</head>

<body onload="print()">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <h2>Detail Transaksi</h2>
                    <h3 class="pull-right">Order # {{ $transaksi->order_number }}</h3>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="col-6">
                            <address>
                                <strong>Asal:</strong> <br>
                                {{ $outlet->nama }} <br>
                                {{ $outlet->alamat }}
                            </address>
                        </div>
                    </div>
                    <div class="col-xs-6 text-right">
                        <address>
                            <strong>Tujuan:</strong><br>
                            {{ $pengiriman->tujuan }}<br>
                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <address>
                            <strong>Metode Pembayaran:</strong><br>
                            {{ $transaksi->metode_bayar }}
                        </address>
                    </div>
                    <div class="col-xs-6 text-right">
                        <address>
                            <strong>Tanggal Transaksi:</strong><br>
                            {{ tanggal_local($transaksi->tgl_transaksi) }}<br><br>
                        </address>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title"><strong>List Barang</strong></h5>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <td><strong>Barang</strong></td>
                                        <td class="text-center"><strong>Harga</strong></td>
                                        <td class="text-center"><strong>Jumlah</strong></td>
                                        <td class="text-right"><strong>Total</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                    <tr>
                                        <td>{{ $barang->nama }}</td>
                                        <td class="text-center">{{ $barang->harga }}</td>
                                        <td class="text-center">{{ $transaksi->jumlah_barang }}</td>
                                        <td class="text-right">{{ $transaksi->total_harga }}</td>
                                    </tr>
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong>Subtotal</strong>
                                        </td>
                                        <td class="thick-line text-right">{{ $transaksi->total_harga }}</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Ongkos Kirim</strong></td>
                                        <td class="no-line text-right">{{ $pengiriman->ongkos_kirim }}</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Total</strong></td>
                                        <td class="no-line text-right">
                                            {{ $transaksi->total_harga + $pengiriman->ongkos_kirim }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
@push('custom-scripts')
    <script>
        function print() {
            var originalContents = document.body.innerHTML;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endpush
