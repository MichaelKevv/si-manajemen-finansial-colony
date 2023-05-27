@extends('template')
@section('content')
    <a target="_blank" href="{{ url('print-detail', $transaksi->id_transaksi) }}">
        <button class="btn btn-success" type="button">Cetak PDF</button>
    </a>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1 mb-3">
                    Detail Transaksi <span style="float: right"> #{{ $transaksi->order_number }}</span>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body" id="invoice-body">
                    <div class="row">
                        <div class="col-6">
                            <address>
                                <strong>Asal:</strong> <br>
                                {{ $outlet->nama }} <br>
                                {{ $outlet->alamat }}
                            </address>
                        </div>
                        <div class="col-6 text-right" style="text-align: right">
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
            </div>
        </div>
    @endsection
