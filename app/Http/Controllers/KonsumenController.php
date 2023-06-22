<?php

namespace App\Http\Controllers;

use App\Models\Konsumen;
use App\Models\Pengguna;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class KonsumenController extends Controller
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
            // $konsumen = Konsumen::latest()->paginate(10);
            $konsumen = Konsumen::join('pengguna', 'pengguna.id_pengguna', '=', 'konsumen.id_pengguna')
                ->select('konsumen.*', 'pengguna.nama as jabatan')
                ->paginate(10);
            return view('konsumen/konsumen', compact('konsumen'))->with('i', (request()->input('page', 1) - 1) * 5);
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
            $data["pengguna"] = Pengguna::all();
            return view('konsumen/tambah-konsumen', $data);
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
            'id_pengguna' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        $image = $request->file('image');
        $image->storeAs('public/foto-konsumen', $image->hashName());
        Konsumen::create([
            'id_pengguna' => $request->id_pengguna,
            'nama'  => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'username' => $request->username,
            'password' => md5($request->password),
            'foto' => $image->hashName(),
        ]);
        return redirect("konsumen")->with("message", "Data berhasil disimpan");
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
    public function edit(Konsumen $konsuman)
    {
        if (!Session::get('logged_in_pegawai')) {
            return redirect('login')->with('info', 'Kamu harus login dulu');
        } else {
            $data["penggunaSaatIni"] = Pengguna::find($konsuman->id_pengguna);
            $data['pengguna'] = Pengguna::all();
            return view('konsumen/edit-konsumen', compact('konsuman'), $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Konsumen $konsumen)
    {
        $request->validate([
            'id_pengguna' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $image->storeAs('public/foto-konsumen', $image->hashName());

            //delete old image
            Storage::delete('public/foto-konsumen/' . $konsumen->image);

            //update post with new image
            $konsumen->update([
                'id_pengguna' => $request->id_pengguna,
                'nama'  => $request->nama,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'username' => $request->username,
                'password' => md5($request->password),
                'foto' => $image->hashName(),
            ]);
        } else {
            $konsumen->update([
                'id_pengguna' => $request->id_pengguna,
                'nama'  => $request->nama,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'username' => $request->username,
                'password' => md5($request->password),
            ]);
        }
        return redirect("konsumen")->with("message", "Data berhasil disimpan");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Konsumen $konsuman)
    {
        $konsuman->delete();
        return redirect("konsumen")->with("message", "Data berhasil dihapus");
    }

    public function print()
    {
        $konsumen = Konsumen::all();
        $pdf = Pdf::loadview('konsumen/laporan-konsumen', ['konsumen' => $konsumen])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-konsumen.pdf');
    }

    public function indexChangePass()
    {
        return view('change-password-konsumen');
    }

    public function changePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required',
        ]);
        $konsumen = Konsumen::where("id_konsumen", $id)->first();
        $konsumen->password = md5($request->password);
        $konsumen->save();

        Session::flush();
        return redirect('login-konsumen')->with('info', 'Anda baru saja ganti password, silakan login ulang');
    }
}
