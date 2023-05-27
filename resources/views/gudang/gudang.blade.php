@extends('template')
@section('content')
    <?php if (Session::has("message")): ?>
    <div class="alert text-white alert-info alert-dismissible fade show" role="alert">
        {{ Session::get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif ?>
    <a href="{{ route('gudang.create') }}">
        <button class="btn btn-primary" type="button">Tambah Data</button>
    </a>
    <a target="_blank" href="{{ url('print-gudang') }}">
        <button class="btn btn-success" type="button">Cetak PDF</button>
    </a>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>List Gudang</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-2">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama Gudang
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Alamat
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Deskripsi
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kapasitas Gudang
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Status
                                    </th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Action
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gudang as $pgw)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->nama }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->alamat }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->deskripsi }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->kapasitas }} </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->status }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{ route('gudang.destroy', $pgw->id_gudang) }}" method="POST">
                                                <a href="{{ route('gudang.edit', $pgw->id_gudang) }}"
                                                    class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                    data-original-title="Edit user">
                                                    <button class="btn btn-info" type="button">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {!! $gudang->links() !!}
            </div>
        </div>
    </div>
@endsection
