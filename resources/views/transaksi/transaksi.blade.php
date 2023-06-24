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
    <?php if (Session::get('pegawai')->role == 1 || Session::get('pegawai')->role == 2 || Session::get('pegawai')->role == 3): ?>
    <a href="{{ route('transaksi.create') }}">
        <button class="btn btn-primary" type="button">Tambah Data</button>
    </a>
    <a target="_blank" href="{{ url('print-transaksi') }}">
        <button class="btn btn-success" type="button">Cetak PDF</button>
    </a>
    <?php endif; ?>

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
                                        ID Transaksi
                                    </th>
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
                                        Nama Konsumen - Alamat
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Jumlah Barang
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Total
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Ongkos Kirim
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Total Harga
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Status Transaksi
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Status Pengiriman
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
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->id_transaksi }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->nama_outlet }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->nama_barang }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->nama_pegawai }}</p>
                                        </td>
                                        <?php if(Session::get('pegawai')->role == 4): ?>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ Session::get('pegawai')->nama }} -
                                                {{ $pgw->tujuan }}</p>
                                        </td>
                                        <?php else: ?>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->nama_konsumen }} - {{ $pgw->tujuan }}</p>
                                        </td>
                                        <?php endif; ?>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->jumlah_barang }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->total_harga }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->ongkos_kirim }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $pgw->total_harga + $pgw->ongkos_kirim }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->status_transaksi }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->status }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ tanggal_local($pgw->tgl_transaksi) }}</p>
                                        </td>
                                        <?php if (Session::get('pegawai')->role == 1 || Session::get('pegawai')->role == 2 || Session::get('pegawai')->role == 3): ?>
                                        <td class="align-middle">
                                            <form action="{{ route('transaksi.destroy', $pgw->id_transaksi) }}"
                                                method="POST">
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#modal-view-{{ $pgw->id_transaksi }}">
                                                    Lihat Bukti Bayar
                                                </button>
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
                                        <?php else: ?>
                                        <td class="align-middle">
                                            <a href="{{ route('transaksi.show', $pgw->id_transaksi) }}"
                                                class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                data-original-title="Edit user">
                                                <button class="btn btn-info" type="button">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </a>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                    <div class="modal fade" id="modal-view-{{ $pgw->id_transaksi }}" tabIndex="-1">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <form action="{{ url('validasi-bukti/' . $pgw->id_transaksi) }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Foto Bukti Bayar</h5>
                                                        <button type="button" class="btn-close text-dark"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php if($pgw->bukti_bayar != null): ?>
                                                        <img src="{{ url('storage/foto-bukti-bayar/' . $pgw->bukti_bayar) }}"
                                                            class="img-fluid border-radius-lg" alt="user1">
                                                        <?php else: ?>
                                                        <p>Bukti Pembayaran Belum Diupload</p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <?php if($pgw->status_code == 1): ?>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <?php else: ?>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"
                                                            class="btn bg-gradient-primary">Validasi</button>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
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
