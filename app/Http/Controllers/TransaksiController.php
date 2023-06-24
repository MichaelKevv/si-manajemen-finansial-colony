<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Outlet;
use App\Models\Pegawai;
use App\Models\Pengiriman;
use App\Models\Stok;
use App\Models\Transaksi;
use App\Models\Konsumen;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Session::get('pegawai')) {
            return redirect('login')->with('info', 'Kamu harus login dulu');
        } else {
            if (Session::get('pegawai')->role == 4) {
                $transaksi = Transaksi::join('outlet', 'outlet.id_outlet', '=', 'transaksi.id_outlet')
                    ->join('pengiriman', 'pengiriman.id_pengiriman', '=', 'transaksi.id_pengiriman')
                    ->join('barang', 'barang.id_barang', '=', 'transaksi.id_barang')
                    ->join('pegawai', 'pegawai.id_pegawai', '=', 'transaksi.id_pegawai')
                    ->select('transaksi.*', 'transaksi.status as status_transaksi', 'barang.nama as nama_barang', 'pegawai.nama as nama_pegawai', 'outlet.nama as nama_outlet', 'pengiriman.*')
                    ->where('id_konsumen', Session::get('pegawai')->id_konsumen)
                    ->paginate(10);
                return view('transaksi/transaksi', compact('transaksi'))->with('i', (request()->input('page', 1) - 1) * 5);
            } else {
                $transaksi = Transaksi::join('outlet', 'outlet.id_outlet', '=', 'transaksi.id_outlet')
                    ->join('pengiriman', 'pengiriman.id_pengiriman', '=', 'transaksi.id_pengiriman')
                    ->join('barang', 'barang.id_barang', '=', 'transaksi.id_barang')
                    ->join('pegawai', 'pegawai.id_pegawai', '=', 'transaksi.id_pegawai')
                    ->join('konsumen', 'konsumen.id_konsumen', '=', 'transaksi.id_konsumen')
                    ->select('transaksi.*', 'konsumen.nama as nama_konsumen', 'transaksi.status as status_transaksi', 'barang.nama as nama_barang', 'pegawai.nama as nama_pegawai', 'outlet.nama as nama_outlet', 'pengiriman.*')
                    ->paginate(10);
                return view('transaksi/transaksi', compact('transaksi'))->with('i', (request()->input('page', 1) - 1) * 5);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Session::get('pegawai')) {
            return redirect('login')->with('info', 'Kamu harus login dulu');
        } else {
            $data["barang"] = Barang::all();
            $data["outlet"] = Outlet::all();
            $data["pegawai"] = Pegawai::all();
            $data["konsumen"] = Konsumen::all();
            return view('transaksi/tambah-transaksi', $data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->status == null) {
            $request->validate([
                'id_barang' => 'required',
                'id_outlet' => 'required',
                'id_pegawai' => 'required',
                'id_konsumen' => 'required',
                'tujuan' => 'required',
                'jumlah_barang' => 'required',
                'ongkos_kirim' => 'required',
                'metode_bayar' => 'required',
                'metode_pengiriman' => 'required',
            ]);
        } else {
            $request->validate([
                'id_barang' => 'required',
                'id_outlet' => 'required',
                'id_pegawai' => 'required',
                'id_konsumen' => 'required',
                'tujuan' => 'required',
                'jumlah_barang' => 'required',
                'ongkos_kirim' => 'required',
                'metode_bayar' => 'required',
                'metode_pengiriman' => 'required',
                'status' => 'required',
            ]);
        }

        if (Session::get('pegawai')->role == 4) {
            $barang = Barang::where('id_barang', '=', $request->id_barang)->first();
            $outlet = Outlet::where('id_outlet', '=', $request->id_outlet)->first();
            $total = ($barang->harga * $request->jumlah_barang);
            $pengiriman = Pengiriman::create([
                'id_barang' => $request->id_barang,
                'asal' => $outlet->nama,
                'tujuan' => $request->tujuan,
                'ongkos_kirim' => $request->ongkos_kirim,
                'metode_pengiriman' => $request->metode_pengiriman,
                'status' => '-',
                'tgl_pengiriman' => $request->tgl_transaksi,
                'tipe_pengiriman' => "Pengiriman Barang ke Customer",
            ]);
            $transaksi = Transaksi::create([
                'id_barang' => $request->id_barang,
                'id_outlet' => $request->id_outlet,
                'id_pengiriman' => $pengiriman->id_pengiriman,
                'id_pegawai' => $request->id_pegawai,
                'id_konsumen' => $request->id_konsumen,
                'jumlah_barang' => $request->jumlah_barang,
                'total_harga' => $total,
                'metode_bayar' => $request->metode_bayar,
                'keterangan' => $request->keterangan,
                'tgl_transaksi' => $request->tgl_transaksi,
                'status' => 'Menunggu Bukti Bayar',
            ]);
            $stok = Stok::where('id_barang', $request->id_barang)->first();
            $stok->update([
                "jumlah_stok" => $stok->jumlah_stok - $request->jumlah_barang,
            ]);
            return redirect("transaksi/upload-bukti/" . $transaksi->id_transaksi);
        } else {
            $barang = Barang::where('id_barang', '=', $request->id_barang)->first();
            $outlet = Outlet::where('id_outlet', '=', $request->id_outlet)->first();
            $total = ($barang->harga * $request->jumlah_barang);
            $pengiriman = Pengiriman::create([
                'id_barang' => $request->id_barang,
                'asal' => $outlet->nama,
                'tujuan' => $request->tujuan,
                'ongkos_kirim' => $request->ongkos_kirim,
                'metode_pengiriman' => $request->metode_pengiriman,
                'status' => $request->status,
                'tgl_pengiriman' => $request->tgl_transaksi,
                'tipe_pengiriman' => "Pengiriman Barang ke Customer",
            ]);
            Transaksi::create([
                'id_barang' => $request->id_barang,
                'id_outlet' => $request->id_outlet,
                'id_pengiriman' => $pengiriman->id_pengiriman,
                'id_pegawai' => $request->id_pegawai,
                'id_konsumen' => $request->id_konsumen,
                'jumlah_barang' => $request->jumlah_barang,
                'total_harga' => $total,
                'metode_bayar' => $request->metode_bayar,
                'keterangan' => $request->keterangan,
                'tgl_transaksi' => $request->tgl_transaksi,
            ]);
            $stok = Stok::where('id_barang', $request->id_barang)->first();
            $stok->update([
                "jumlah_stok" => $stok->jumlah_stok - $request->jumlah_barang,
            ]);
            return redirect("transaksi")->with("message", "Data berhasil disimpan");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        if (!Session::get('pegawai')) {
            return redirect('login')->with('info', 'Kamu harus login dulu');
        } else {
            $data['transaksi'] = $transaksi;
            $data['barang'] = Barang::where('id_barang', '=', $transaksi->id_barang)->first();
            $data['pengiriman'] = Pengiriman::where('id_pengiriman', '=', $transaksi->id_pengiriman)->first();
            $data['outlet'] = Outlet::where('id_outlet', '=', $transaksi->id_outlet)->first();
            return view('transaksi/detail-transaksi', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        if (!Session::get('logged_in_pegawai')) {
            return redirect('login')->with('info', 'Kamu harus login dulu');
        } else {
            $data["barangSaatIni"] = Barang::find($transaksi->id_barang);
            $data["barang"] = Barang::all();
            $data["outletSaatIni"] = Outlet::find($transaksi->id_outlet);
            $data["outlet"] = Outlet::all();
            $data["pegawaiSaatIni"] = Pegawai::find($transaksi->id_pegawai);
            $data["pegawai"] = Pegawai::all();
            $data['pengiriman'] = Pengiriman::where('id_pengiriman', '=', $transaksi->id_pengiriman)->first();
            $data["konsumen"] = Konsumen::all();
            return view('transaksi/edit-transaksi', compact('transaksi'), $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'id_barang' => 'required',
            'id_outlet' => 'required',
            'id_pegawai' => 'required',
            'id_konsumen' => 'required',
            'tujuan' => 'required',
            'jumlah_barang' => 'required',
            'ongkos_kirim' => 'required',
            'metode_bayar' => 'required',
            'metode_pengiriman' => 'required',
            'keterangan' => 'required',
            'status' => 'required',
        ]);
        $barang = Barang::where('id_barang', '=', $request->id_barang)->first();
        $outlet = Outlet::where('id_outlet', '=', $request->id_outlet)->first();
        $total = ($barang->harga * $request->jumlah_barang);
        $pengiriman = Pengiriman::where('id_pengiriman', $transaksi->id_pengiriman)->first();
        if ($request->tgl_transaksi == null) {
            $pengiriman->update([
                'id_barang' => $request->id_barang,
                'asal' => $outlet->nama,
                'tujuan' => $request->tujuan,
                'ongkos_kirim' => $request->ongkos_kirim,
                'metode_pengiriman' => $request->metode_pengiriman,
                'status' => $request->status,
                'tipe_pengiriman' => "Pengiriman Barang ke Customer",
            ]);
            $transaksi->update([
                'id_barang' => $request->id_barang,
                'id_outlet' => $request->id_outlet,
                'id_pengiriman' => $pengiriman->id_pengiriman,
                'id_pegawai' => $request->id_pegawai,
                'id_konsumen' => $request->id_konsumen,
                'jumlah_barang' => $request->jumlah_barang,
                'total_harga' => $total,
                'metode_bayar' => $request->metode_bayar,
                'keterangan' => $request->keterangan,
            ]);
        } else {
            $pengiriman->update([
                'id_barang' => $request->id_barang,
                'asal' => $outlet->nama,
                'tujuan' => $request->tujuan,
                'ongkos_kirim' => $request->ongkos_kirim,
                'metode_pengiriman' => $request->metode_pengiriman,
                'status' => $request->status,
                'tgl_pengiriman' => $request->tgl_transaksi,
                'tipe_pengiriman' => "Pengiriman Barang ke Customer",
            ]);
            $transaksi->update([
                'id_barang' => $request->id_barang,
                'id_outlet' => $request->id_outlet,
                'id_pengiriman' => $pengiriman->id_pengiriman,
                'id_pegawai' => $request->id_pegawai,
                'id_konsumen' => $request->id_konsumen,
                'jumlah_barang' => $request->jumlah_barang,
                'total_harga' => $total,
                'metode_bayar' => $request->metode_bayar,
                'keterangan' => $request->keterangan,
            ]);
        }

        return redirect("transaksi")->with("message", "Data berhasil disimpan");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect("transaksi")->with("message", "Data berhasil dihapus");
    }

    public function print()
    {
        $transaksi = Transaksi::join('outlet', 'outlet.id_outlet', '=', 'transaksi.id_outlet')
            ->join('pengiriman', 'pengiriman.id_pengiriman', '=', 'transaksi.id_pengiriman')
            ->join('barang', 'barang.id_barang', '=', 'transaksi.id_barang')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'transaksi.id_pegawai')
            ->select('transaksi.*', 'barang.*', 'barang.nama as nama_barang', 'pegawai.nama as nama_pegawai', 'outlet.nama as nama_outlet', 'pengiriman.*')->get();
        $pdf = Pdf::loadview('transaksi/laporan-transaksi', ['transaksi' => $transaksi])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-transaksi.pdf');
    }

    public function printDetail($id)
    {
        $transaksi = Transaksi::find($id);
        $data['transaksi'] = $transaksi;
        $data['barang'] = Barang::where('id_barang', '=', $transaksi->id_barang)->first();
        $data['pengiriman'] = Pengiriman::where('id_pengiriman', '=', $transaksi->id_pengiriman)->first();
        $data['outlet'] = Outlet::where('id_outlet', '=', $transaksi->id_outlet)->first();
        return view('transaksi/laporan-detail', $data);
        // $pdf = Pdf::loadview('transaksi/laporan-detail', $data)->setPaper('a4', 'landscape');
        // return $pdf->download('laporan-detail-transaksi.pdf');
    }

    public function transaksiUser($id)
    {
        $barang = Barang::find($id);
        $outlet = Outlet::all();
        $order = Transaksi::latest()->select('transaksi.order_number')->first();
        $pegawai = Pegawai::join('pengguna', 'pengguna.id_pengguna', '=', 'pegawai.id_pengguna')
            ->where('role', '!=', 4)
            ->select('pegawai.*', 'pengguna.role', 'pengguna.nama as nama_role')
            ->get();
        // echo $barang; die;
        return view('transaksi.transaksi-user', compact('barang', 'pegawai', 'outlet', 'order'));
    }

    public function upBukti()
    {
        return view('transaksi.view-up-bukti');
    }

    public function cariTrx(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required',
        ]);
        $transaksi = Transaksi::where('id_transaksi', $request->id_transaksi)->first();
        // echo $transaksi; die;
        if ($transaksi->status_code == 1) {
            return redirect('upbukti')->with('message', 'Bukti Bayar untuk ID ini telah Divalidasi');
        } else {
            return redirect('transaksi/upload-bukti/' . $request->id_transaksi);
        }
        // echo $transaksi; die;
    }

    public function uploadBukti($id)
    {

        $transaksi = Transaksi::where('id_transaksi', $id)->first();
        // echo $transaksi; die;
        return view('transaksi.transfer-bukti', compact('transaksi'));
    }

    public function storeBukti(Request $request, $id)
    {
        $transaksi = Transaksi::where('id_transaksi', $id)->first();
        $image = $request->file('image');
        $image->storeAs('public/foto-bukti-bayar', $image->hashName());
        $transaksi->update([
            'bukti_bayar' => $image->hashName(),
            'status' => 'Bukti Bayar telah Diupload',
        ]);

        return redirect("transaksi")->with("message", "Upload Bukti Bayar Berhasil");
    }

    public function validasiBukti($id)
    {
        $transaksi = Transaksi::where('id_transaksi', $id)->first();
        $pengiriman = Pengiriman::where('id_pengiriman', $transaksi->id_pengiriman)->first();
        $transaksi->update([
            'status' => 'Bukti Bayar Tervalidasi',
            'status_code' => 1,
        ]);

        $pengiriman->update([
            'status' => 'Diproses',
        ]);

        return redirect("transaksi")->with("message", "Bukti Bayar Tervalidasi");
    }
}
