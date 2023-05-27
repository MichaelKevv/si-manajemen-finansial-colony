<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        if (Session::get('logged_in_pegawai')) {
            return redirect('dashboard');
        } else {
            return view('login');
        }
    }

    public function checkLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $data = Pegawai::join('pengguna', 'pengguna.id_pengguna', 'pegawai.id_pengguna')
            ->select('pegawai.*', 'pengguna.*', 'pengguna.nama as nama_role')
            ->where("username", $username)->where("password", md5($password));
        if ($data->count() > 0) {
            Session::put("logged_in_pegawai", true);
            Session::put("pegawai", $data->first());
            // echo $data->first();
            return redirect("dashboard");
        } else {
            return redirect("login")->with("message", "Username/Password tidak cocok!");
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('login');
    }
}
