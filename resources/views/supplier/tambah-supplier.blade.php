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
                    <h6>Tambah Supplier</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form class="p-3" action="{{ route('supplier.store') }}" method="post"
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
                            <label for="nama" class="form-control-label">Nama Supplier</label>
                            <input class="form-control" type="text" name="nama" id="nama">
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="form-control-label">Alamat</label>
                            <input class="form-control" type="text" name="alamat" id="alamat">
                        </div>
                        <div class="form-group">
                            <label for="no_telp" class="form-control-label">Nomor Telp</label>
                            <input class="form-control" type="text" name="no_telp" id="no_telp">
                        </div>
                        <div class="form-group">
                            <label for="jumlah_barang" class="form-control-label">Jumlah Barang</label>
                            <input class="form-control" type="number" name="jumlah_barang" id="jumlah_barang">
                        </div>
                        <div class="form-group">
                            <label for="harga_supply" class="form-control-label">Harga Supply</label>
                            <input class="form-control" type="number" name="harga_supply" id="harga_supply">
                        </div>
                        <div class="form-group">
                            <label for="tgl_supply" class="form-control-label">Tanggal Supply</label>
                            <input class="form-control" type="date" name="tgl_supply" id="tgl_supply">
                        </div>

                        <button class="btn btn-primary" type="submit">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
