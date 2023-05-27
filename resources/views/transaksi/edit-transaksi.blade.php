@extends('template')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-white">{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Transaksi</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form class="p-3" action="{{ route('transaksi.update', $transaksi->id_transaksi) }}" method="post"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="form-group">
                            <label for="id_barang" class="form-control-label">Nama Barang</label>
                            <select class="form-control" name="id_barang" id="id_barang" required>
                                @foreach ($barang as $b)
                                    <option value="{{ $b->id_barang }}">
                                        {{ $b->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_outlet" class="form-control-label">Nama Outlet</label>
                            <select class="form-control" id="id_outlet" name="id_outlet">
                                @foreach ($outlet as $o)
                                    <option {{ $o->id_outlet == $outletSaatIni->id_outlet ? 'selected' : '' }}
                                        value="{{ $o->id_outlet }}">
                                        {{ $o->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_pegawai" class="form-control-label">Nama Pegawai</label>
                            <select class="form-control" name="id_pegawai" id="id_pegawai" required>
                                @foreach ($pegawai as $k)
                                    <option {{ $k->id_pegawai == Session::get('pegawai')->id_pegawai ? 'selected' : '' }}
                                        value="{{ $k->id_pegawai }}">
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tujuan" class="form-control-label">Customer</label>
                            <input class="form-control" type="text" value="{{ $pengiriman->tujuan }}" name="tujuan"
                                id="tujuan">
                        </div>
                        <div class="form-group">
                            <label for="jumlah_barang" class="form-control-label">Jumlah Barang</label>
                            <input class="form-control" type="number" value="{{ $transaksi->jumlah_barang }}"
                                name="jumlah_barang" id="jumlah_barang">
                        </div>
                        <div class="form-group">
                            <label for="ongkos_kirim" class="form-control-label">Ongkos Kirim</label>
                            <input class="form-control" type="number" value="{{ $pengiriman->ongkos_kirim }}"
                                name="ongkos_kirim" id="ongkos_kirim">
                        </div>
                        <div class="form-group">
                            <label for="metode_bayar" class="form-control-label">Metode Bayar</label>
                            <input class="form-control" type="text" value="{{ $transaksi->metode_bayar }}"
                                name="metode_bayar" id="metode_bayar">
                        </div>
                        <div class="form-group">
                            <label for="metode_pengiriman" class="form-control-label">Metode Pengiriman</label>
                            <input class="form-control" type="text" value="{{ $pengiriman->metode_pengiriman }}"
                                name="metode_pengiriman" id="metode_pengiriman">
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="form-control-label">Keterangan</label>
                            <textarea class="form-control" type="text" name="keterangan" id="keterangan">{{ $transaksi->keterangan }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="tgl_transaksi" class="form-control-label">Tanggal Transaksi</label>
                            <input class="form-control" type="date" name="tgl_transaksi" id="tgl_transaksi">
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-control-label">Status</label>
                            <input class="form-control" type="text" value="{{ $pengiriman->status }}" name="status" id="status">
                        </div>
                        <button class="btn btn-primary" type="submit">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
