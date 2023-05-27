<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory, HasUuids;
    protected $table = "stok_barang";
    protected $primaryKey = 'id_stok_barang';
    protected $fillable = ['id_barang', 'jumlah_stok', 'satuan', 'tgl_dibuat'];
}
