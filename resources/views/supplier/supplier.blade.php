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
    <a href="{{ route('supplier.create') }}">
        <button class="btn btn-primary" type="button">Tambah Data</button>
    </a>
    <a target="_blank" href="{{ url('print-supplier') }}">
        <button class="btn btn-success" type="button">Cetak PDF</button>
    </a>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>List Supplier</h6>
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
                                        Nama Supplier
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Alamat
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nomor Telepon
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Jumlah Barang
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Harga Supply
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tangal Supply
                                    </th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($supplier as $pgw)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->nama_barang }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->nama }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->alamat }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->no_telp }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->jumlah_barang }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $pgw->harga_supply }}</p>
                                        </td>
                                        <td>
                                            <?php if($pgw->tgl_supply != null): ?>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ tanggal_local($pgw->tgl_supply) }}
                                            </p>
                                            <?php else : ?>
                                            <p class="text-xs font-weight-bold mb-0">
                                                Kosong
                                            </p>
                                            <?php endif; ?>
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{ route('supplier.destroy', $pgw->id_supplier) }}"
                                                method="POST">
                                                <a href="{{ route('supplier.edit', $pgw->id_supplier) }}"
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
                {!! $supplier->links() !!}
            </div>
        </div>
    </div>
@endsection
