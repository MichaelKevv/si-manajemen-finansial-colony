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
                    <h6>Edit Stok Barang</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form class="p-3" action="{{ route('stok.update', $stok->id_stok_barang) }}" method="post"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="form-group">
                            <label for="id_barang" class="form-control-label">Nama Barang</label>
                            <select class="form-control" name="id_barang" id="id_barang" required>
                                @foreach ($barang as $g)
                                    <option {{ $g->id_barang == $barangSaatIni->id_barang ? 'selected' : '' }}
                                        value="{{ $g->id_barang }}">
                                        {{ $g->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_stok" class="form-control-label">Jumlah Stok</label>
                            <input class="form-control" type="number" name="jumlah_stok" value="{{ $stok->jumlah_stok }}"
                                id="jumlah_stok">
                        </div>
                        <div class="form-group">
                            <label for="satuan" class="form-control-label">Satuan</label>
                            <input class="form-control" type="text" name="satuan" value="{{ $stok->satuan }}"
                                id="satuan">
                        </div>
                        <div class="form-group">
                            <label for="tgl_dibuat" class="form-control-label">Tanggal</label>
                            <input class="form-control" type="date" name="tgl_dibuat" id="tgl_dibuat"
                                value="{{ $stok->tgl_dibuat }}">
                        </div>
                        <button class="btn btn-primary" type="submit">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
