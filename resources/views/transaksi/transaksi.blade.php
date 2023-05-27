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
    <a href="{{ route('transaksi.create') }}">
        <button class="btn btn-primary" type="button">Tambah Data</button>
    </a>
    <a target="_blank" href="{{ url('print-transaksi') }}">
        <button class="btn btn-success" type="button">Cetak PDF</button>
    </a>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>List Transaksi</h6>
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
                                        Nama Barang
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama Pegawai
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Customer
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Jumlah Barang
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Total Harga
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Transaksi
                                    </th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Action
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $pgw)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->nama_outlet }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->nama_barang }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->nama_pegawai }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->tujuan }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->jumlah_barang }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->total_harga + $pgw->ongkos_kirim }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ tanggal_local($pgw->tgl_transaksi) }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{ route('transaksi.destroy', $pgw->id_transaksi) }}" method="POST">
                                                <a href="{{ route('transaksi.show', $pgw->id_transaksi) }}"
                                                    class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                    data-original-title="Edit user">
                                                    <button class="btn btn-info" type="button">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('transaksi.edit', $pgw->id_transaksi) }}"
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
                {!! $transaksi->links() !!}
            </div>
        </div>
    </div>
@endsection
