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
    <a href="{{ route('outlet.create') }}">
        <button class="btn btn-primary" type="button">Tambah Data</button>
    </a>
    <a target="_blank" href="{{ url('print-outlet') }}">
        <button class="btn btn-success" type="button">Cetak PDF</button>
    </a>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>List Outlet</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-2">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama Outlet
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Deskripsi
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tipe
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Alamat
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Latitude
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Longitude
                                    </th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Action
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($outlet as $pgw)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->nama }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->deskripsi }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->tipe }} </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->alamat }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->latitude }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->longitude }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{ route('outlet.destroy', $pgw->id_outlet) }}" method="POST">
                                                <a href="{{ route('outlet.edit', $pgw->id_outlet) }}"
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
                {!! $outlet->links() !!}
            </div>
        </div>
    </div>
@endsection
