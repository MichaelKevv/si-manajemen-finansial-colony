<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory, HasUuids;
    protected $table = "transaksi";
    protected $primaryKey = 'id_transaksi';
    protected $fillable = ['id_outlet', 'id_pengiriman', 'id_barang', 'id_pegawai', 'order_number', 'jumlah_barang', 'total_harga', 'metode_bayar', 'keterangan', 'tgl_transaksi'];
}
