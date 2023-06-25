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
    <a href="{{ route('barang.create') }}">
        <button class="btn btn-primary" type="button">Tambah Data</button>
    </a>
    <a target="_blank" href="{{ url('print-barang') }}">
        <button class="btn btn-success" type="button">Cetak PDF</button>
    </a>
    <?php endif; ?>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>List Barang</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-2">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kategori
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Gudang
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Stok
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Harga
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Masuk
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Keluar
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Status
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Foto
                                    </th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barang as $pgw)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->nama }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->nama_kategori }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->nama_gudang }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->jumlah_stok }}
                                                {{ $pgw->satuan }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->harga }}</p>
                                        </td>
                                        <td>
                                            <?php if($pgw->tgl_masuk != null): ?>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ date('d F Y', strtotime($pgw->tgl_masuk)) }}
                                            </p>
                                            <?php else: ?>
                                            <p class="text-xs font-weight-bold mb-0">
                                                Kosong
                                            </p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($pgw->tgl_keluar != null): ?>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ date('d F Y', strtotime($pgw->tgl_keluar)) }}
                                            </p>
                                            <?php else: ?>
                                            <p class="text-xs font-weight-bold mb-0">
                                                Kosong
                                            </p>
                                            <?php endif; ?>

                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->status }}</p>
                                        </td>
                                        <td>
                                            <div>
                                                <img src="{{ url('storage/foto-barang/' . $pgw->foto) }}" class="me-3"
                                                    width="100px">
                                            </div>
                                        </td>
                                        <?php if (Session::get('pegawai')->role == 1 || Session::get('pegawai')->role == 2 || Session::get('pegawai')->role == 3): ?>
                                        <td class="align-middle">
                                            <form action="{{ route('barang.destroy', $pgw->id_barang) }}" method="POST">
                                                <a href="{{ route('barang.edit', $pgw->id_barang) }}"
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
                                        <?php endif;?>
                                        <?php if (Session::get('pegawai')->role == 4): ?>
                                        <td class="align-middle">
                                            <a href="{{ route('transaksi.transaksiuser', $pgw->id_barang) }}"
                                                class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                data-original-title="Edit user">
                                                <button class="btn btn-info" type="button">
                                                    {{-- <i class="fas fa-plus"></i> --}} Beli
                                                </button>
                                            </a>
                                        </td>
                                        <?php endif;?>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {!! $barang->links() !!}
            </div>
        </div>
    </div>
@endsection
