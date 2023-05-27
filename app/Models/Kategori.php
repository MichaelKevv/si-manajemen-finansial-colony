<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory, HasUuids;
    protected $table = "kategori_barang";
    protected $primaryKey = 'id_kategori_barang';
    protected $fillable = ['id_kategori_barang', 'nama', 'deskripsi'];
}
