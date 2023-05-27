<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OutletController extends Controller
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
            $outlet = Outlet::latest()->paginate(10);
            return view('outlet/outlet', compact('outlet'))->with('i', (request()->input('page', 1) - 1) * 5);
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
            return view('outlet/tambah-outlet');
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
            'tipe' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        Outlet::create([
            'nama'  => $request->nama,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'tipe' => $request->tipe,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        return redirect("outlet")->with("message", "Data berhasil disimpan");
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
    public function edit(Outlet $outlet)
    {
        if (!Session::get('logged_in_pegawai')) {
            return redirect('login')->with('info', 'Kamu harus login dulu');
        } else {
            return view('outlet/edit-outlet', compact('outlet'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outlet $outlet)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'deskripsi' => 'required',
            'tipe' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        $outlet->update([
            'nama'  => $request->nama,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'tipe' => $request->tipe,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        return redirect("outlet")->with("message", "Data berhasil disimpan");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outlet $outlet)
    {
        $outlet->delete();
        return redirect("outlet")->with("message", "Data berhasil dihapus");
    }

    public function print()
    {
        $outlet = Outlet::all();
        $pdf = Pdf::loadview('outlet/laporan-outlet', ['outlet' => $outlet])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-outlet.pdf');
    }
}
