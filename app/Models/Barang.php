<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory, HasUuids;
    protected $table = "barang";
    protected $primaryKey = 'id_barang';
    protected $fillable = ['id_barang', 'id_kategori_barang', 'id_stok_barang', 'id_gudang', 'nama', 'harga', 'tgl_masuk', 'tgl_keluar', 'deskripsi', 'status', 'foto'];
}
