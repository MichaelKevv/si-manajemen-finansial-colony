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
                    <h6>Edit Pegawai</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form class="p-3" action="{{ route('pegawai.update', $pegawai->id_pegawai) }}" method="post"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="form-group">
                            <label for="id_pengguna" class="form-control-label">Jabatan</label>
                            <select class="form-control" name="id_pengguna" id="id_pengguna" required>
                                @foreach ($pengguna as $p)
                                    <option
                                        {{ $p->id_pengguna == $penggunaSaatIni->id_pengguna ? 'selected' : '' }}
                                        value="{{ $p->id_pengguna }}">
                                        {{ $p->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="form-control-label">Nama</label>
                            <input class="form-control" type="text" value="{{ $pegawai->nama }}" name="nama"
                                id="nama">
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="form-control-label">Alamat</label>
                            <input class="form-control" type="text" value="{{ $pegawai->alamat }}" name="alamat"
                                id="alamat">
                        </div>
                        <div class="form-group">
                            <label for="no_hp" class="form-control-label">Nomor HP</label>
                            <input class="form-control" type="text" value="{{ $pegawai->no_hp }}" name="no_hp"
                                id="no_hp">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-control-label">Email</label>
                            <input class="form-control" type="email" value="{{ $pegawai->email }}" name="email"
                                id="email">
                        </div>
                        <div class="form-group">
                            <label for="username" class="form-control-label">Username</label>
                            <input class="form-control" type="text" value="{{ $pegawai->username }}" name="username"
                                id="username">
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-control-label">Password</label>
                            <input class="form-control" type="password" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-control-label">Foto Pegawai</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*" />
                        </div>
                        <button class="btn btn-primary" type="submit">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
