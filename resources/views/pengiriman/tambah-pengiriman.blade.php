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
                    <h6>Tambah Pengiriman</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form class="p-3" action="{{ route('pengiriman.store') }}" method="post"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
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
                            <label for="asal" class="form-control-label">Asal</label>
                            <select class="form-control" id="asal_outlet" name="asal">
                                @foreach ($outlet as $o)
                                    <option value="{{ $o->nama }}">
                                        {{ $o->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tujuan" class="form-control-label">Tujuan</label>
                            <input class="form-control" type="text" name="tujuan" id="tujuan">
                        </div>
                        <div class="form-group">
                            <label for="ongkos_kirim" class="form-control-label">Ongkos Kirim</label>
                            <input class="form-control" type="number" name="ongkos_kirim" id="ongkos_kirim">
                        </div>
                        <div class="form-group">
                            <label for="metode_pengiriman" class="form-control-label">Metode Pengiriman</label>
                            <input class="form-control" type="text" name="metode_pengiriman" id="metode_pengiriman">
                        </div>
                        <div class="form-group">
                            <label for="tgl_pengiriman" class="form-control-label">Tanggal Pengiriman</label>
                            <input class="form-control" type="date" name="tgl_pengiriman" id="tgl_pengiriman">
                        </div>
                        <div class="form-group">
                            <label for="tgl_diterima" class="form-control-label">Tanggal Diterima</label>
                            <input class="form-control" type="date" name="tgl_diterima" id="tgl_diterima">
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-control-label">Status</label>
                            <input class="form-control" type="text" name="status" id="status">
                        </div>
                        <button class="btn btn-primary" type="submit">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
