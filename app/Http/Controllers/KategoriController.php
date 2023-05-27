<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KategoriController extends Controller
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
            $kategori = Kategori::latest()->paginate(10);
            return view('kategori/kategori', compact('kategori'))->with('i', (request()->input('page', 1) - 1) * 5);
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
            return view('kategori/tambah-kategori');
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
            'deskripsi' => 'required',
            'status' => 'required',
        ]);
        Kategori::create([
            'nama'  => $request->nama,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
        ]);
        return redirect("kategori")->with("message", "Data berhasil disimpan");
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
    public function edit(Kategori $kategori)
    {
        if (!Session::get('logged_in_pegawai')) {
            return redirect('login')->with('info', 'Kamu harus login dulu');
        } else {
            return view('kategori/edit-kategori', compact('kategori'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
        ]);

        //update post without image
        $kategori->update([
            'nama'  => $request->nama,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
        ]);

        return redirect("kategori")->with("message", "Data berhasil disimpan");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect("kategori")->with("message", "Data berhasil dihapus");
    }

    public function print()
    {
        $kategori = Kategori::all();
        $pdf = Pdf::loadview('kategori/laporan-kategori', ['kategori' => $kategori])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-kategori.pdf');
    }
}
