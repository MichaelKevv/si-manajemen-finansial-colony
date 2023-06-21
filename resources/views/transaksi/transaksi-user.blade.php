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
                    <h6>Tambah Transaksi</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form class="p-3" action="{{ route('transaksi.store') }}" method="post"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{-- <div class="form-group">
                            <label for="id_barang" class="form-control-label">Nama Barang</label>
                            <select class="form-control" name="id_barang" id="id_barang" required>
                                @foreach ($barang as $b)
                                    <option value="{{ $b->id_barang }}">
                                        {{ $b->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}

                        <div class="form-group">
                            <label for="id_pegawai" class="form-control-label">Nama Pegawai</label>
                            <select class="form-control" name="id_pegawai" id="id_pegawai" required>
                                @foreach ($pegawai as $k)
                                    <option value="{{ $k->id_pegawai }}">
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="id_barang" id="id_barang" value="{{ $barang->id_barang }}">
                        <div class="form-group">
                            <label for="tujuan" class="form-control-label">Nama Barang</label>
                            <input class="form-control" type="text" name="nama_barang" value="{{ $barang->nama }}"
                                id="nama_barang" readonly>
                        </div>
                        <div class="form-group">
                            <label for="id_outlet" class="form-control-label">Nama Outlet</label>
                            <select class="form-control" id="id_outlet" name="id_outlet">
                                @foreach ($outlet as $o)
                                    <option value="{{ $o->id_outlet }}">
                                        {{ $o->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tujuan" class="form-control-label">Tujuan</label>
                            <input class="form-control" type="text" name="tujuan" id="tujuan">
                        </div>
                        <div class="form-group">
                            <label for="jumlah_barang" class="form-control-label">Jumlah Barang</label>
                            <input class="form-control" type="number" name="jumlah_barang" id="jumlah_barang">
                        </div>
                        <div class="form-group">
                            <label for="metode_bayar" class="form-control-label">Metode Bayar</label>
                            <select class="form-control" id="metode_bayar" name="metode_bayar">
                                <option value="" selected>
                                    Pilih Metode Pembayaran
                                </option>
                                <option value="Cash">
                                    Cash
                                </option>
                                <option value="Transfer Bank">
                                    Transfer Bank
                                </option>
                                <option value="Gopay">
                                    Gopay
                                </option>
                                <option value="Shopeepay">
                                    Shopeepay
                                </option>
                                <option value="OVO">
                                    OVO
                                </option>
                            </select>
                            {{-- <input class="form-control" type="text" name="metode_bayar" id="metode_bayar"> --}}
                        </div>
                        <div class="form-group">
                            <label for="metode_pengiriman" class="form-control-label">Metode Pengiriman</label>
                            <select class="form-control" id="metode_pengiriman" name="metode_pengiriman">
                                <option value="" selected>
                                    Pilih Metode Pengiriman
                                </option>
                                <option value="Instant">
                                    Instant
                                </option>
                                <option value="Reguler">
                                    Reguler
                                </option>
                            </select>
                            {{-- <input class="form-control" type="text" name="metode_pengiriman" id="metode_pengiriman"> --}}
                        </div>
                        <div class="form-group">
                            <label for="ongkos_kirim" class="form-control-label">Ongkos Kirim</label>
                            <input class="form-control" type="number" name="ongkos_kirim" id="ongkos_kirim" readonly>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="form-control-label">Keterangan</label>
                            <textarea class="form-control" type="text" name="keterangan" id="keterangan"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tgl_transaksi" class="form-control-label">Tanggal Transaksi</label>
                            <input class="form-control" type="date" name="tgl_transaksi" value="<?php echo date('Y-m-d'); ?>" id="tgl_transaksi">
                        </div>
                        <button class="btn btn-primary" type="submit">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
    <script type="text/javascript">
        $('#metode_pengiriman').change(function() {
            if ($(this).val() == 'Instant') {
                $('#ongkos_kirim').val(15000);
            } else {
                $('#ongkos_kirim').val(10000);
            }
        });
    </script>
@endpush
