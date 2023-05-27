<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory, HasUuids;
    protected $table = "pengiriman";
    protected $primaryKey = 'id_pengiriman';
    protected $fillable = ['id_barang', 'asal', 'tujuan', 'ongkos_kirim', 'metode_pengiriman', 'tipe_pengiriman', 'tgl_pengiriman', 'tgl_diterima', 'status'];
}
