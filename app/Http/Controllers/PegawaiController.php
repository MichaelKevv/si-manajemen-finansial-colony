<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pengguna;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
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
            // $pegawai = Pegawai::latest()->paginate(10);
            $pegawai = Pegawai::join('pengguna', 'pengguna.id_pengguna', '=', 'pegawai.id_pengguna')
                ->select('pegawai.*', 'pengguna.nama as jabatan')
                ->paginate(10);
            return view('pegawai/pegawai', compact('pegawai'))->with('i', (request()->input('page', 1) - 1) * 5);
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
            return view('pegawai/tambah-pegawai', $data);
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
        $image->storeAs('public/foto-pegawai', $image->hashName());
        Pegawai::create([
            'id_pengguna' => $request->id_pengguna,
            'nama'  => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'username' => $request->username,
            'password' => md5($request->password),
            'foto' => $image->hashName(),
        ]);
        return redirect("pegawai")->with("message", "Data berhasil disimpan");
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
    public function edit(Pegawai $pegawai)
    {
        if (!Session::get('logged_in_pegawai')) {
            return redirect('login')->with('info', 'Kamu harus login dulu');
        } else {
            $data["penggunaSaatIni"] = Pengguna::find($pegawai->id_pengguna);
            $data['pengguna'] = Pengguna::all();
            return view('pegawai/edit-pegawai', compact('pegawai'), $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
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
            $image->storeAs('public/foto-pegawai', $image->hashName());

            //delete old image
            Storage::delete('public/foto-pegawai/' . $pegawai->image);

            //update post with new image
            $pegawai->update([
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
            $pegawai->update([
                'id_pengguna' => $request->id_pengguna,
                'nama'  => $request->nama,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'username' => $request->username,
                'password' => md5($request->password),
            ]);
        }
        return redirect("pegawai")->with("message", "Data berhasil disimpan");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        return redirect("pegawai")->with("message", "Data berhasil dihapus");
    }

    public function print()
    {
        $pegawai = Pegawai::all();
        $pdf = Pdf::loadview('pegawai/laporan-pegawai', ['pegawai' => $pegawai])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-pegawai.pdf');
    }

    public function indexChangePass()
    {
        return view('change-password');
    }

    public function changePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required',
        ]);
        $pegawai = Pegawai::where("id_pegawai", $id)->first();
        $pegawai->password = md5($request->password);
        $pegawai->save();

        Session::flush();
        return redirect('login')->with('info', 'Anda baru saja ganti password, silakan login ulang');

    }
}
