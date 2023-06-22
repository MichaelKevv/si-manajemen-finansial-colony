<?php

namespace App\Http\Controllers;

use App\Models\Konsumen;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginKonsumenController extends Controller
{
    public function index()
    {
        if (Session::get('logged_in_konsumen')) {
            return redirect('dashboard');
        } else {
            return view('login-konsumen');
        }
    }
    public function indexRegister()
    {
        return view('register-konsumen');
    }

    public function register(Request $request)
    {
        $request->validate([
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
        $pengguna = Pengguna::where('nama', '=', 'Konsumen')->first();
        Konsumen::create([
            'id_pengguna' => $pengguna->id_pengguna,
            'nama'  => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'username' => $request->username,
            'password' => md5($request->password),
            'foto' => $image->hashName(),
        ]);
        return redirect("login-konsumen")->with("info", "Data telah tersimpan. Silakan Login!");
    }

    public function checkLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $data = Konsumen::join('pengguna', 'pengguna.id_pengguna', 'konsumen.id_pengguna')
            ->select('konsumen.*', 'pengguna.role', 'pengguna.nama as nama_role')
            ->where("username", $username)->where("password", md5($password));
        if ($data->count() > 0) {
            Session::put("logged_in_konsumen", true);
            Session::put("pegawai", $data->first());
            return redirect("dashboard");
        } else {
            return redirect("login-konsumen")->with("message", "Username/Password tidak cocok!");
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('login-konsumen');
    }
}
