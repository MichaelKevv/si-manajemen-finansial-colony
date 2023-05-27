<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SupplierController extends Controller
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
            $supplier = Supplier::join('barang', 'barang.id_barang', '=', 'supplier.id_barang')
                ->select('supplier.*', 'barang.nama as nama_barang')
                ->paginate(10);
            return view('supplier/supplier', compact('supplier'))->with('i', (request()->input('page', 1) - 1) * 5);
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
            return view('supplier/tambah-supplier', $data);
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
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'jumlah_barang' => 'required',
            'harga_supply' => 'required',
        ]);
        Supplier::create([
            'id_barang' => $request->id_barang,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'jumlah_barang' => $request->jumlah_barang,
            'harga_supply' => $request->harga_supply,
            'tgl_supply' => $request->tgl_supply,
        ]);
        return redirect("supplier")->with("message", "Data berhasil disimpan");
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
    public function edit(Supplier $supplier)
    {
        if (!Session::get('logged_in_pegawai')) {
            return redirect('login')->with('info', 'Kamu harus login dulu');
        } else {
            $data["barangSaatIni"] = Barang::find($supplier->id_barang);
            $data["barang"] = Barang::all();
            return view('supplier/edit-supplier', compact('supplier'), $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'id_barang' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'jumlah_barang' => 'required',
            'harga_supply' => 'required',
        ]);
        if ($request->tgl_supply != null) {
            $supplier->update([
                'id_barang' => $request->id_barang,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'jumlah_barang' => $request->jumlah_barang,
                'harga_supply' => $request->harga_supply,
                'tgl_supply' => $request->tgl_supply,
            ]);
        } else {
            $supplier->update([
                'id_barang' => $request->id_barang,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'jumlah_barang' => $request->jumlah_barang,
                'harga_supply' => $request->harga_supply,
            ]);
        }
        return redirect("supplier")->with("message", "Data berhasil disimpan");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect("supplier")->with("message", "Data berhasil dihapus");
    }

    public function print()
    {
        $supplier = Supplier::join('barang', 'barang.id_barang', '=', 'supplier.id_barang')
            ->select('supplier.*', 'barang.nama as nama_barang')->get();
        $pdf = Pdf::loadview('supplier/laporan-supplier', ['supplier' => $supplier])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-supplier.pdf');
    }
}
