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
                    <h6>Tambah Outlet</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form class="p-3" action="{{ route('outlet.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nama" class="form-control-label">Nama</label>
                            <input class="form-control" type="text" name="nama" id="nama">
                        </div>
                        <div class="form-group">
                            <label for="tipe" class="form-control-label">Tipe</label>
                            <input class="form-control" type="text" name="tipe" id="tipe">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi" class="form-control-label">Deskripsi</label>
                            <textarea class="form-control" type="text" name="deskripsi" id="deskripsi"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="form-control-label">Alamat</label>
                            <input class="form-control" type="text" name="alamat" id="alamat">
                        </div>
                        <div class="form-group">
                            <label for="latitude" class="form-control-label">Latitude</label>
                            <input class="form-control" type="text" name="latitude" id="latitude">
                        </div>
                        <div class="form-group">
                            <label for="longitude" class="form-control-label">Longitude</label>
                            <input class="form-control" type="text" name="longitude" id="longitude">
                        </div>
                        <button class="btn btn-primary" type="submit">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
