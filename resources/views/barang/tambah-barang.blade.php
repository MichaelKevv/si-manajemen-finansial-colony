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
                    <h6>Tambah Barang</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form class="p-3" action="{{ route('barang.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="id_kategori_barang" class="form-control-label">Kategori Barang</label>
                            <select class="form-control" name="id_kategori_barang" id="id_kategori_barang" required>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id_kategori_barang }}">
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_gudang" class="form-control-label">Gudang</label>
                            <select class="form-control" name="id_gudang" id="id_gudang" required>
                                @foreach ($gudang as $g)
                                    <option value="{{ $g->id_gudang }}">
                                        {{ $g->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="form-control-label">Nama</label>
                            <input class="form-control" type="text" name="nama" id="nama">
                        </div>
                        <div class="form-group">
                            <label for="harga" class="form-control-label">Harga</label>
                            <input class="form-control" type="number" name="harga" id="harga">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi" class="form-control-label">Deskripsi</label>
                            <textarea class="form-control" type="text" name="deskripsi" id="deskripsi"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tgl_masuk" class="form-control-label">Tanggal Barang Masuk</label>
                            <input class="form-control" type="date" name="tgl_masuk" id="tgl_masuk">
                        </div>
                        <div class="form-group">
                            <label for="tgl_keluar" class="form-control-label">Tanggal Barang Keluar</label>
                            <input class="form-control" type="date" name="tgl_keluar" id="tgl_keluar">
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-control-label">Status</label>
                            <input class="form-control" type="text" name="status" id="status">
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-control-label">Foto Barang</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*" />
                        </div>
                        <button class="btn btn-primary" type="submit">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
