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
                    <h6>Edit Mutasi</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form class="p-3" action="{{ route('mutasi.update', $mutasi->id_mutasi) }}" method="post"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="form-group">
                            <label for="id_barang" class="form-control-label">Nama Barang</label>
                            <select class="form-control" name="id_barang" id="id_barang" required>
                                @foreach ($barang as $k)
                                    <option {{ $k->id_barang == $barangSaatIni->id_barang ? 'selected' : '' }}
                                        value="{{ $k->id_barang }}">
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="asal" class="form-control-label">Asal</label>
                            <div class="form-check">
                                <input class="form-check-input radio_asal" type="radio" value="Gudang" name="asal_1"
                                    id="customRadio1">
                                <label class="custom-control-label" for="customRadio1">Gudang</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_asal" type="radio" value="Outlet" name="asal_1"
                                    id="customRadio2">
                                <label class="custom-control-label" for="customRadio2">Outlet</label>
                            </div>
                            <select class="form-control" id="asal_gudang" style="display: none;">
                                @foreach ($gudang as $g)
                                    <option value="{{ $g->nama }}">
                                        {{ $g->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <select class="form-control" id="asal_outlet" style="display: none;">
                                @foreach ($outlet as $o)
                                    <option value="{{ $o->nama }}">
                                        {{ $o->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="asal" id="asal">
                        </div>
                        <div class="form-group">
                            <label for="asal" class="form-control-label">Tujuan</label>
                            <div class="form-check">
                                <input class="form-check-input radio_tujuan" type="radio" value="Gudang" name="tujuan_1"
                                    id="customRadio3">
                                <label class="custom-control-label" for="customRadio3">Gudang</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio_tujuan" type="radio" value="Outlet" name="tujuan_1"
                                    id="customRadio4">
                                <label class="custom-control-label" for="customRadio4">Outlet</label>
                            </div>
                            <select class="form-control" id="tujuan_gudang" style="display: none;">
                                @foreach ($gudang as $g)
                                    <option value="{{ $g->nama }}">
                                        {{ $g->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <select class="form-control" id="tujuan_outlet" style="display: none;">
                                @foreach ($outlet as $o)
                                    <option value="{{ $o->nama }}">
                                        {{ $o->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="tujuan" id="tujuan">
                        </div>
                        <div class="form-group">
                            <label for="ongkos_kirim" class="form-control-label">Ongkos Kirim</label>
                            <input class="form-control" type="number" name="ongkos_kirim"
                                value="{{ $pengiriman->ongkos_kirim }}" id="ongkos_kirim">
                        </div>
                        <div class="form-group">
                            <label for="metode_pengiriman" class="form-control-label">Metode Pengiriman</label>
                            <input class="form-control" type="text" name="metode_pengiriman"
                                value="{{ $pengiriman->metode_pengiriman }}" id="metode_pengiriman">
                        </div>
                        <div class="form-group">
                            <label for="jumlah_mutasi" class="form-control-label">Jumlah Mutasi</label>
                            <input class="form-control" type="number" name="jumlah_mutasi"
                                value="{{ $mutasi->jumlah_mutasi }}" id="jumlah_mutasi">
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="form-control-label">Keterangan</label>
                            <textarea class="form-control" type="text" name="keterangan" id="keterangan">{{ $mutasi->keterangan }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-control-label">Status</label>
                            <input class="form-control" type="text" name="status" value="{{ $mutasi->status }}"
                                id="status">
                        </div>
                        <div class="form-group">
                            <label for="tgl_mutasi" class="form-control-label">Tanggal Mutasi</label>
                            <input class="form-control" type="date" name="tgl_mutasi" id="tgl_mutasi">
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
        $('.radio_asal').change(function() {
            if ($(this).val() == 'Gudang') {
                $('#asal_gudang').show();
                $('#asal_outlet').hide();
                let value = $("#asal_gudang option:selected").text();
                $('#asal').val(value)
            } else {
                $('#asal_gudang').hide();
                $('#asal_outlet').show();
                let value = $("#asal_outlet option:selected").text();
                $('#asal').val(value)
            }
        });
        $('.radio_tujuan').change(function() {
            if ($(this).val() == 'Gudang') {
                $('#tujuan_gudang').show();
                $('#tujuan_outlet').hide();
                let value = $("#tujuan_gudang option:selected").text();
                $('#tujuan').val(value)
            } else {
                $('#tujuan_gudang').hide();
                $('#tujuan_outlet').show();
                let value = $("#tujuan_outlet option:selected").text();
                $('#tujuan').val(value)
            }
        });
    </script>
@endpush
