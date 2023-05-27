<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GudangController extends Controller
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
            $gudang = Gudang::latest()->paginate(10);
            return view('gudang/gudang', compact('gudang'))->with('i', (request()->input('page', 1) - 1) * 5);
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
            return view('gudang/tambah-gudang');
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
            'nama' => 'required',
            'alamat' => 'required',
            'deskripsi' => 'required',
            'kapasitas' => 'required',
            'status' => 'required',
        ]);
        Gudang::create([
            'nama'  => $request->nama,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'kapasitas' => $request->kapasitas,
            'status' => $request->status,
        ]);
        return redirect("gudang")->with("message", "Data berhasil disimpan");
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
    public function edit(Gudang $gudang)
    {
        if (!Session::get('logged_in_pegawai')) {
            return redirect('login')->with('info', 'Kamu harus login dulu');
        } else {
            return view('gudang/edit-gudang', compact('gudang'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gudang $gudang)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'deskripsi' => 'required',
            'kapasitas' => 'required',
            'status' => 'required',
        ]);

        $gudang->update([
            'nama'  => $request->nama,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'kapasitas' => $request->kapasitas,
            'status' => $request->status,
        ]);

        return redirect("gudang")->with("message", "Data berhasil disimpan");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gudang $gudang)
    {
        $gudang->delete();
        return redirect("gudang")->with("message", "Data berhasil dihapus");
    }

    public function print()
    {
        $gudang = Gudang::all();
        $pdf = Pdf::loadview('gudang/laporan-gudang', ['gudang' => $gudang])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-gudang.pdf');
    }
}
