<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Stok;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StokController extends Controller
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
            $stok = Stok::join('barang', 'barang.id_barang', '=', 'stok_barang.id_barang')
                ->select('stok_barang.*', 'barang.nama as nama_barang')
                ->paginate(10);
            return view('stok/stok', compact('stok'))->with('i', (request()->input('page', 1) - 1) * 5);
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
            return view('stok/tambah-stok', $data);
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
            'jumlah_stok' => 'required',
            'satuan' => 'required',
        ]);
        if ($request->tgl_dibuat == null) {
            Stok::create([
                'id_barang'  => $request->id_barang,
                'jumlah_stok' => $request->jumlah_stok,
                'satuan' => $request->satuan,
            ]);
        } else {
            Stok::create([
                'id_barang'  => $request->id_barang,
                'jumlah_stok' => $request->jumlah_stok,
                'satuan' => $request->satuan,
                'tgl_dibuat' => $request->tgl_dibuat,
            ]);
        }

        return redirect("stok")->with("message", "Data berhasil disimpan");
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
    public function edit(Stok $stok)
    {
        if (!Session::get('logged_in_pegawai')) {
            return redirect('login')->with('info', 'Kamu harus login dulu');
        } else {
            $data["barangSaatIni"] = Barang::find($stok->id_barang);
            $data["barang"] = Barang::all();
            return view('stok/edit-stok', compact('stok'), $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stok $stok)
    {
        $request->validate([
            'id_barang' => 'required',
            'jumlah_stok' => 'required',
            'satuan' => 'required',
        ]);
        if ($request->tgl_dibuat == null) {
            $stok->update([
                'id_barang'  => $request->id_barang,
                'jumlah_stok' => $request->jumlah_stok,
                'satuan' => $request->satuan,
            ]);
        } else {
            $stok->update([
                'id_barang'  => $request->id_barang,
                'jumlah_stok' => $request->jumlah_stok,
                'satuan' => $request->satuan,
                'tgl_dibuat' => $request->tgl_dibuat,
            ]);
        }
        return redirect("stok")->with("message", "Data berhasil disimpan");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stok $stok)
    {
        $stok->delete();
        return redirect("stok")->with("message", "Data berhasil dihapus");
    }

    public function print()
    {
        $stok = Stok::join('barang', 'barang.id_barang', '=', 'stok_barang.id_barang')
            ->select('stok_barang.*', 'barang.nama as nama_barang')
            ->get();
        $pdf = Pdf::loadview('stok/laporan-stok', ['stok' => $stok])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-stok.pdf');
    }
}
