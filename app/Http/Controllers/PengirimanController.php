<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Outlet;
use App\Models\Pengiriman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PengirimanController extends Controller
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
            $pengiriman = Pengiriman::join('barang', 'barang.id_barang', '=', 'pengiriman.id_barang')
                ->select('pengiriman.*', 'barang.nama as nama_barang')
                ->paginate(10);
            return view('pengiriman/pengiriman', compact('pengiriman'))->with('i', (request()->input('page', 1) - 1) * 5);
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
            return view('pengiriman/tambah-pengiriman', $data);
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
            'asal' => 'required',
            'tujuan' => 'required',
            'ongkos_kirim' => 'required',
            'metode_pengiriman' => 'required',
            'status' => 'required',
        ]);
        Pengiriman::create([
            'id_barang' => $request->id_barang,
            'asal' => $request->asal,
            'tujuan' => $request->tujuan,
            'ongkos_kirim' => $request->ongkos_kirim,
            'metode_pengiriman' => $request->metode_pengiriman,
            'status' => $request->status,
            'tgl_pengiriman' => $request->tgl_pengiriman,
            'tgl_diterima' => $request->tgl_diterima,
            'tipe_pengiriman' => "Pengiriman Barang ke Customer",
        ]);
        return redirect("pengiriman")->with("message", "Data berhasil disimpan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengiriman $pengiriman)
    {
        if (!Session::get('logged_in_pegawai')) {
            return redirect('login')->with('info', 'Kamu harus login dulu');
        } else {
            $data["barangSaatIni"] = Barang::find($pengiriman->id_barang);
            $data["barang"] = Barang::all();
            $data["outlet"] = Outlet::all();
            return view('pengiriman/edit-pengiriman', compact('pengiriman'), $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengiriman $pengiriman)
    {
        $request->validate([
            'id_barang' => 'required',
            'asal' => 'required',
            'tujuan' => 'required',
            'ongkos_kirim' => 'required',
            'metode_pengiriman' => 'required',
            'status' => 'required',
        ]);
        if ($request->tgl_pengiriman == null && $request->tgl_diterima != null) {
            $pengiriman->update([
                'id_barang' => $request->id_barang,
                'asal' => $request->asal,
                'tujuan' => $request->tujuan,
                'ongkos_kirim' => $request->ongkos_kirim,
                'metode_pengiriman' => $request->metode_pengiriman,
                'status' => $request->status,
                'tgl_diterima' => $request->tgl_diterima,
                'tipe_pengiriman' => "Pengiriman Barang ke Customer",
            ]);
        } else if ($request->tgl_diterima == null && $request->tgl_pengiriman != null) {
            $pengiriman->update([
                'id_barang' => $request->id_barang,
                'asal' => $request->asal,
                'tujuan' => $request->tujuan,
                'ongkos_kirim' => $request->ongkos_kirim,
                'metode_pengiriman' => $request->metode_pengiriman,
                'status' => $request->status,
                'tgl_pengiriman' => $request->tgl_pengiriman,
                'tipe_pengiriman' => "Pengiriman Barang ke Customer",
            ]);
        } else if ($request->tgl_pengiriman == null && $request->tgl_diterima == null) {
            $pengiriman->update([
                'id_barang' => $request->id_barang,
                'asal' => $request->asal,
                'tujuan' => $request->tujuan,
                'ongkos_kirim' => $request->ongkos_kirim,
                'metode_pengiriman' => $request->metode_pengiriman,
                'status' => $request->status,
                'tipe_pengiriman' => "Pengiriman Barang ke Customer",
            ]);
        } else {
            $pengiriman->update([
                'id_barang' => $request->id_barang,
                'asal' => $request->asal,
                'tujuan' => $request->tujuan,
                'ongkos_kirim' => $request->ongkos_kirim,
                'metode_pengiriman' => $request->metode_pengiriman,
                'status' => $request->status,
                'tgl_pengiriman' => $request->tgl_pengiriman,
                'tgl_diterima' => $request->tgl_diterima,
                'tipe_pengiriman' => "Pengiriman Barang ke Customer",
            ]);
        }

        return redirect("pengiriman")->with("message", "Data berhasil disimpan");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengiriman $pengiriman)
    {
        $pengiriman->delete();
        return redirect("peng$pengiriman")->with("message", "Data berhasil dihapus");
    }

    public function print()
    {
        $pengiriman = Pengiriman::join('barang', 'barang.id_barang', '=', 'pengiriman.id_barang')
                ->select('pengiriman.*', 'barang.nama as nama_barang')->get();
        $pdf = Pdf::loadview('pengiriman/laporan-pengiriman', ['pengiriman' => $pengiriman])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-pengiriman.pdf');
    }
}
