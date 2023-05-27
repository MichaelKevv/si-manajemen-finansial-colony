<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory, HasUuids;
    protected $table = "supplier";
    protected $primaryKey = 'id_supplier';
    protected $fillable = ['id_barang', 'nama', 'alamat', 'no_telp', 'jumlah_barang', 'tgl_supply', 'harga_supply'];
}
