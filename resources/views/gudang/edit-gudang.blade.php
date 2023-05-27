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
                    <h6>Edit Gudang</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form class="p-3" action="{{ route('gudang.update', $gudang->id_gudang) }}" method="post"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama" class="form-control-label">Nama</label>
                            <input class="form-control" type="text" name="nama" value="{{ $gudang->nama }}"
                                id="nama">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi" class="form-control-label">Deskripsi</label>
                            <textarea class="form-control" type="text" name="deskripsi" id="deskripsi">{{ $gudang->deskripsi }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="form-control-label">Alamat</label>
                            <input class="form-control" type="text" name="alamat" value="{{ $gudang->alamat }}"
                                id="alamat">
                        </div>
                        <div class="form-group">
                            <label for="kapasitas" class="form-control-label">Kapasitas</label>
                            <input class="form-control" type="number" name="kapasitas" value="{{ $gudang->kapasitas }}"
                                id="kapasitas">
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-control-label">Status</label>
                            <input class="form-control" type="text" value="{{ $gudang->status }}" name="status"
                                id="status">
                        </div>
                        <button class="btn btn-primary" type="submit">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
