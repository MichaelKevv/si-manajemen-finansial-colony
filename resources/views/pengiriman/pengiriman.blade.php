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
    <a href="{{ route('pengiriman.create') }}">
        <button class="btn btn-primary" type="button">Tambah Data</button>
    </a>
    <a target="_blank" href="{{ url('print-pengiriman') }}">
        <button class="btn btn-success" type="button">Cetak PDF</button>
    </a>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>List Pengiriman</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-2">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama Barang
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Asal
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tujuan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Ongkos Kirim
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Metode Pengiriman
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tipe Pengiriman
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Pengiriman
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Diterima
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
                                @foreach ($pengiriman as $pgw)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->nama_barang }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->asal }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->tujuan }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->ongkos_kirim }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->metode_pengiriman }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->tipe_pengiriman }}</p>
                                        </td>
                                        <td>
                                            <?php if($pgw->tgl_pengiriman != null): ?>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ tanggal_local($pgw->tgl_pengiriman) }}
                                            </p>
                                            <?php else : ?>
                                            <p class="text-xs font-weight-bold mb-0">
                                                Kosong
                                            </p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($pgw->tgl_diterima != null): ?>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ tanggal_local($pgw->tgl_diterima) }}
                                            </p>
                                            <?php else : ?>
                                            <p class="text-xs font-weight-bold mb-0">
                                                Kosong
                                            </p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->status }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{ route('pengiriman.destroy', $pgw->id_pengiriman) }}"
                                                method="POST">
                                                <a href="{{ route('pengiriman.edit', $pgw->id_pengiriman) }}"
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
                {!! $pengiriman->links() !!}
            </div>
        </div>
    </div>
@endsection
