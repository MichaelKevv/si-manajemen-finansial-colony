<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class BarangController extends Controller
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
            // $barang = Barang::latest()->paginate(10);
            $barang = Barang::join('gudang', 'gudang.id_gudang', '=', 'barang.id_gudang')
                ->join('kategori_barang', 'kategori_barang.id_kategori_barang', '=', 'barang.id_kategori_barang')
                ->select('barang.*', 'gudang.nama as nama_gudang', 'kategori_barang.nama as nama_kategori')
                ->paginate(10);
            return view('barang/barang', compact('barang'))->with('i', (request()->input('page', 1) - 1) * 5);
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
            $data["kategori"] = Kategori::all();
            $data["gudang"] = Gudang::all();
            return view('barang/tambah-barang', $data);
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
            'id_kategori_barang' => 'required',
            'id_gudang' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'tgl_masuk' => 'required',
            'tgl_keluar' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $image = $request->file('image');
        $image->storeAs('public/foto-barang', $image->hashName());
        Barang::create([
            'id_kategori_barang' => $request->id_kategori_barang,
            'id_gudang' => $request->id_gudang,
            'nama'  => $request->nama,
            'harga' => $request->harga,
            'tgl_masuk' => $request->tgl_masuk,
            'tgl_keluar' => $request->tgl_keluar,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
            'foto' => $image->hashName(),
        ]);
        return redirect("barang")->with("message", "Data berhasil disimpan");
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
    public function edit(Barang $barang)
    {
        if (!Session::get('logged_in_pegawai')) {
            return redirect('login')->with('info', 'Kamu harus login dulu');
        } else {
            $data["kategoriSaatIni"] = Kategori::find($barang->id_kategori_barang);
            $data["gudangSaatIni"] = Gudang::find($barang->id_gudang);
            $data["kategori"] = Kategori::all();
            $data["gudang"] = Gudang::all();
            return view('barang/edit-barang', compact('barang'), $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'id_kategori_barang' => 'required',
            'id_gudang' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $image->storeAs('public/foto-barang', $image->hashName());
            Storage::delete('public/foto-barang/' . $barang->image);

            if ($request->tgl_keluar == null && $request->tgl_masuk != null) {
                $barang->update([
                    'id_kategori_barang' => $request->id_kategori_barang,
                    'id_gudang' => $request->id_gudang,
                    'nama'  => $request->nama,
                    'harga' => $request->harga,
                    'tgl_masuk' => $request->tgl_masuk,
                    'deskripsi' => $request->deskripsi,
                    'status' => $request->status,
                    'foto' => $image->hashName(),
                ]);
            } else if ($request->tgl_masuk == null && $request->tgl_keluar != null) {
                $barang->update([
                    'id_kategori_barang' => $request->id_kategori_barang,
                    'id_gudang' => $request->id_gudang,
                    'nama'  => $request->nama,
                    'harga' => $request->harga,
                    'tgl_keluar' => $request->tgl_keluar,
                    'deskripsi' => $request->deskripsi,
                    'status' => $request->status,
                    'foto' => $image->hashName(),
                ]);
            } else if ($request->tgl_masuk && $request->tgl_keluar != null) {
                $barang->update([
                    'id_kategori_barang' => $request->id_kategori_barang,
                    'id_gudang' => $request->id_gudang,
                    'nama'  => $request->nama,
                    'harga' => $request->harga,
                    'tgl_masuk' => $request->tgl_masuk,
                    'tgl_keluar' => $request->tgl_keluar,
                    'deskripsi' => $request->deskripsi,
                    'status' => $request->status,
                    'foto' => $image->hashName(),
                ]);
            } else {
                $barang->update([
                    'id_kategori_barang' => $request->id_kategori_barang,
                    'id_gudang' => $request->id_gudang,
                    'nama'  => $request->nama,
                    'harga' => $request->harga,
                    'deskripsi' => $request->deskripsi,
                    'status' => $request->status,
                    'foto' => $image->hashName(),
                ]);
            }
        } else {
            if ($request->tgl_keluar == null && $request->tgl_masuk != null) {
                $barang->update([
                    'id_kategori_barang' => $request->id_kategori_barang,
                    'id_gudang' => $request->id_gudang,
                    'nama'  => $request->nama,
                    'harga' => $request->harga,
                    'tgl_masuk' => $request->tgl_masuk,
                    'deskripsi' => $request->deskripsi,
                    'status' => $request->status,
                ]);
            } else if ($request->tgl_masuk == null && $request->tgl_keluar != null) {
                $barang->update([
                    'id_kategori_barang' => $request->id_kategori_barang,
                    'id_gudang' => $request->id_gudang,
                    'nama'  => $request->nama,
                    'harga' => $request->harga,
                    'tgl_keluar' => $request->tgl_keluar,
                    'deskripsi' => $request->deskripsi,
                    'status' => $request->status,
                ]);
            } else if ($request->tgl_masuk && $request->tgl_keluar != null) {
                $barang->update([
                    'id_kategori_barang' => $request->id_kategori_barang,
                    'id_gudang' => $request->id_gudang,
                    'nama'  => $request->nama,
                    'harga' => $request->harga,
                    'tgl_masuk' => $request->tgl_masuk,
                    'tgl_keluar' => $request->tgl_keluar,
                    'deskripsi' => $request->deskripsi,
                    'status' => $request->status,
                ]);
            } else {
                $barang->update([
                    'id_kategori_barang' => $request->id_kategori_barang,
                    'id_gudang' => $request->id_gudang,
                    'nama'  => $request->nama,
                    'harga' => $request->harga,
                    'deskripsi' => $request->deskripsi,
                    'status' => $request->status,
                ]);
            }
        }
        // echo  $barang;
        return redirect("barang")->with("message", "Data berhasil disimpan");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect("barang")->with("message", "Data berhasil dihapus");
    }

    public function print()
    {
        $barang = Barang::join('gudang', 'gudang.id_gudang', '=', 'barang.id_gudang')
            ->join('kategori_barang', 'kategori_barang.id_kategori_barang', '=', 'barang.id_kategori_barang')
            ->select('barang.*', 'gudang.nama as nama_gudang', 'kategori_barang.nama as nama_kategori')->get();
        $pdf = Pdf::loadview('barang/laporan-barang', ['barang' => $barang])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-barang.pdf');
    }
}
