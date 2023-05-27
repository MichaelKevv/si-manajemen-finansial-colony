<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory, HasUuids;
    protected $table = "mutasi_stok";
    protected $primaryKey = 'id_mutasi';
    protected $fillable = ['id_barang', 'id_pengiriman', 'jumlah_mutasi', 'keterangan', 'status', 'tgl_mutasi'];
}
