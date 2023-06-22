<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Kategori;
use App\Models\Outlet;
use App\Models\Pegawai;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Session::get('pegawai')) {
            return redirect('login')->with('info', 'Kamu harus login dulu');
        } else {
            $data['pegawai'] = Pegawai::count();
            $data['outlet'] = Outlet::count();
            $data['gudang'] = Gudang::count();
            $data['barang'] = Barang::count();
            $data['transaksi'] = Transaksi::join('outlet', 'outlet.id_outlet', '=', 'transaksi.id_outlet')
                ->join('pengiriman', 'pengiriman.id_pengiriman', '=', 'transaksi.id_pengiriman')
                ->join('barang', 'barang.id_barang', '=', 'transaksi.id_barang')
                ->join('pegawai', 'pegawai.id_pegawai', '=', 'transaksi.id_pegawai')
                ->select('transaksi.*', 'barang.nama as nama_barang', 'pegawai.nama as nama_pegawai', 'outlet.nama as nama_outlet', 'pengiriman.*')
                ->orderBy('transaksi.created_at', 'DESC')
                ->get();
            $data['admin'] = Pegawai::join("pengguna", "pengguna.id_pengguna", "=", "pegawai.id_pengguna")
                ->where('pengguna.nama', "=", "Admin")
                ->count();
            $data['kurir'] = Pegawai::join("pengguna", "pengguna.id_pengguna", "=", "pegawai.id_pengguna")
                ->where('pengguna.nama', "=", "Kurir")
                ->count();
            $data['kasir'] = Pegawai::join("pengguna", "pengguna.id_pengguna", "=", "pegawai.id_pengguna")
                ->where('pengguna.nama', "=", "Kasir")
                ->count();
            $trx = Transaksi::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                ->whereYear('created_at', date('Y'))
                ->groupBy(DB::raw("MONTHNAME(created_at)"))
                ->orderBy(DB::raw("MONTHNAME(created_at)"), 'DESC')
                ->pluck('count', 'month_name');
            $pegawai = Pegawai::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                ->where('created_at', "<", now())
                ->groupBy(DB::raw("MONTHNAME(created_at)"))
                ->orderBy(DB::raw("MONTHNAME(created_at)"), 'DESC')
                ->pluck('count', 'month_name');

            $label_trx = $trx->keys();
            $trxs = $trx->values();
            $label_peg = $pegawai->keys();
            $pegawais = $pegawai->values();
            return view('dashboard', compact('label_trx', 'trxs', 'label_peg', 'pegawais'), $data);
        }
    }
}
