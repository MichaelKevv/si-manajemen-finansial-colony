<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Mutasi;
use App\Models\Outlet;
use App\Models\Pengiriman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MutasiController extends Controller
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
            $mutasi = Mutasi::join('barang', 'barang.id_barang', '=', 'mutasi_stok.id_barang')
                ->join('pengiriman', 'pengiriman.id_pengiriman', '=', 'mutasi_stok.id_pengiriman')
                ->select('mutasi_stok.*', 'barang.nama as nama_barang', 'pengiriman.*')
                ->paginate(10);
            return view('mutasi/mutasi', compact('mutasi'))->with('i', (request()->input('page', 1) - 1) * 5);
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
            $data["gudang"] = Gudang::all();
            $data["outlet"] = Outlet::all();
            return view('mutasi/tambah-mutasi', $data);
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
            'jumlah_mutasi' => 'required',
            'keterangan' => 'required',
            'status' => 'required',
        ]);
        $pengiriman = Pengiriman::create([
            'id_barang' => $request->id_barang,
            'asal' => $request->asal,
            'tujuan' => $request->tujuan,
            'ongkos_kirim' => $request->ongkos_kirim,
            'metode_pengiriman' => $request->metode_pengiriman,
            'status' => $request->status,
            'tgl_pengiriman' => $request->tgl_mutasi,
            'tipe_pengiriman' => "Mutasi Stok",
        ]);
        Mutasi::create([
            'id_barang'  => $request->id_barang,
            'id_pengiriman' => $pengiriman->id_pengiriman,
            'jumlah_mutasi' => $request->jumlah_mutasi,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'tgl_mutasi' => $request->tgl_mutasi,
        ]);
        return redirect("mutasi")->with("message", "Data berhasil disimpan");
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
    public function edit(Mutasi $mutasi)
    {
        if (!Session::get('logged_in_pegawai')) {
            return redirect('login')->with('info', 'Kamu harus login dulu');
        } else {
            $data["barangSaatIni"] = Barang::find($mutasi->id_barang);
            $data['pengiriman'] = Pengiriman::find($mutasi->id_pengiriman);
            $data["barang"] = Barang::all();
            $data["gudang"] = Gudang::all();
            $data["outlet"] = Outlet::all();
            return view('mutasi/edit-mutasi', compact('mutasi'), $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mutasi $mutasi)
    {
        $request->validate([
            'id_barang' => 'required',
            'ongkos_kirim' => 'required',
            'metode_pengiriman' => 'required',
            'jumlah_mutasi' => 'required',
            'keterangan' => 'required',
            'status' => 'required',
        ]);
        $pengiriman = Pengiriman::where('id_pengiriman', $mutasi->id_pengiriman)->first();

        if ($request->asal == null && $request->tujuan != null) {
            if ($request->tgl_mutasi == null) {
                $pengiriman->update([
                    'id_barang' => $request->id_barang,
                    'tujuan' => $request->tujuan,
                    'ongkos_kirim' => $request->ongkos_kirim,
                    'metode_pengiriman' => $request->metode_pengiriman,
                    'status' => $request->status,
                    'tipe_pengiriman' => "Mutasi Stok",
                ]);
            } else {
                $pengiriman->update([
                    'id_barang' => $request->id_barang,
                    'tujuan' => $request->tujuan,
                    'ongkos_kirim' => $request->ongkos_kirim,
                    'metode_pengiriman' => $request->metode_pengiriman,
                    'status' => $request->status,
                    'tgl_pengiriman' => $request->tgl_mutasi,
                    'tipe_pengiriman' => "Mutasi Stok",
                ]);
            }
        } else if ($request->tujuan == null && $request->asal != null) {
            if ($request->tgl_mutasi == null) {
                $pengiriman->update([
                    'id_barang' => $request->id_barang,
                    'asal' => $request->asal,
                    'ongkos_kirim' => $request->ongkos_kirim,
                    'metode_pengiriman' => $request->metode_pengiriman,
                    'status' => $request->status,
                    'tipe_pengiriman' => "Mutasi Stok",
                ]);
            } else {
                $pengiriman->update([
                    'id_barang' => $request->id_barang,
                    'asal' => $request->asal,
                    'ongkos_kirim' => $request->ongkos_kirim,
                    'metode_pengiriman' => $request->metode_pengiriman,
                    'status' => $request->status,
                    'tgl_pengiriman' => $request->tgl_mutasi,
                    'tipe_pengiriman' => "Mutasi Stok",
                ]);
            }
        } else if ($request->asal && $request->tujuan != null) {
            if ($request->tgl_mutasi == null) {
                $pengiriman->update([
                    'id_barang' => $request->id_barang,
                    'asal' => $request->asal,
                    'tujuan' => $request->tujuan,
                    'ongkos_kirim' => $request->ongkos_kirim,
                    'metode_pengiriman' => $request->metode_pengiriman,
                    'status' => $request->status,
                    'tipe_pengiriman' => "Mutasi Stok",
                ]);
            } else {
                $pengiriman->update([
                    'id_barang' => $request->id_barang,
                    'asal' => $request->asal,
                    'tujuan' => $request->tujuan,
                    'ongkos_kirim' => $request->ongkos_kirim,
                    'metode_pengiriman' => $request->metode_pengiriman,
                    'status' => $request->status,
                    'tgl_pengiriman' => $request->tgl_mutasi,
                    'tipe_pengiriman' => "Mutasi Stok",
                ]);
            }
        } else {
            if ($request->tgl_mutasi == null) {
                $pengiriman->update([
                    'id_barang' => $request->id_barang,
                    'ongkos_kirim' => $request->ongkos_kirim,
                    'metode_pengiriman' => $request->metode_pengiriman,
                    'status' => $request->status,
                    'tipe_pengiriman' => "Mutasi Stok",
                ]);
            } else {
                $pengiriman->update([
                    'id_barang' => $request->id_barang,
                    'ongkos_kirim' => $request->ongkos_kirim,
                    'metode_pengiriman' => $request->metode_pengiriman,
                    'status' => $request->status,
                    'tgl_pengiriman' => $request->tgl_mutasi,
                    'tipe_pengiriman' => "Mutasi Stok",
                ]);
            }
        }

        if ($request->tgl_mutasi != null) {
            $mutasi->update([
                'id_barang'  => $request->id_barang,
                'id_pengiriman' => $pengiriman->id_pengiriman,
                'jumlah_mutasi' => $request->jumlah_mutasi,
                'keterangan' => $request->keterangan,
                'status' => $request->status,
                'tgl_mutasi' => $request->tgl_mutasi,
            ]);
        } else {
            $mutasi->update([
                'id_barang'  => $request->id_barang,
                'id_pengiriman' => $pengiriman->id_pengiriman,
                'jumlah_mutasi' => $request->jumlah_mutasi,
                'keterangan' => $request->keterangan,
                'status' => $request->status,
            ]);
        }


        return redirect("mutasi")->with("message", "Data berhasil disimpan");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mutasi $mutasi)
    {
        $mutasi->delete();
        return redirect("mutasi")->with("message", "Data berhasil dihapus");
    }

    public function print()
    {
        $mutasi = Mutasi::join('barang', 'barang.id_barang', '=', 'mutasi_stok.id_barang')
            ->join('pengiriman', 'pengiriman.id_pengiriman', '=', 'mutasi_stok.id_pengiriman')
            ->select('mutasi_stok.*', 'barang.nama as nama_barang', 'pengiriman.*')->get();
        $pdf = Pdf::loadview('mutasi/laporan-mutasi', ['mutasi' => $mutasi])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-mutasi.pdf');
    }
}
