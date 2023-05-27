<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Outlet;
use App\Models\Pegawai;
use App\Models\Pengiriman;
use App\Models\Transaksi;
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
        if (!Session::get('logged_in_pegawai')) {
            return redirect('login')->with('info', 'Kamu harus login dulu');
        } else {
            $transaksi = Transaksi::join('outlet', 'outlet.id_outlet', '=', 'transaksi.id_outlet')
                ->join('pengiriman', 'pengiriman.id_pengiriman', '=', 'transaksi.id_pengiriman')
                ->join('barang', 'barang.id_barang', '=', 'transaksi.id_barang')
                ->join('pegawai', 'pegawai.id_pegawai', '=', 'transaksi.id_pegawai')
                ->select('transaksi.*', 'barang.nama as nama_barang', 'pegawai.nama as nama_pegawai', 'outlet.nama as nama_outlet', 'pengiriman.*')
                ->paginate(10);
            return view('transaksi/transaksi', compact('transaksi'))->with('i', (request()->input('page', 1) - 1) * 5);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Session::get('logged_in_pegawai')) {
            return redirect('login')->with('info', 'Kamu harus login dulu');
        } else {
            $data["barang"] = Barang::all();
            $data["outlet"] = Outlet::all();
            $data["pegawai"] = Pegawai::all();
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
        $request->validate([
            'id_barang' => 'required',
            'id_outlet' => 'required',
            'id_pegawai' => 'required',
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
            'jumlah_barang' => $request->jumlah_barang,
            'total_harga' => $total,
            'metode_bayar' => $request->metode_bayar,
            'keterangan' => $request->keterangan,
            'tgl_transaksi' => $request->tgl_transaksi,
        ]);
        return redirect("transaksi")->with("message", "Data berhasil disimpan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        if (!Session::get('logged_in_pegawai')) {
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
}
