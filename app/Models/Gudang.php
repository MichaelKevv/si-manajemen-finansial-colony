<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory, HasUuids;
    protected $table = "gudang";
    protected $primaryKey = 'id_gudang';
    protected $fillable = ['nama', 'deskripsi', 'alamat', 'kapasitas', 'tgl_barang_masuk', 'tgl_barang_keluar', 'status'];
}
