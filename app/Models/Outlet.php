<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory, HasUuids;
    protected $table = "outlet";
    protected $primaryKey = 'id_outlet';
    protected $fillable = ['nama', 'deskripsi', 'tipe', 'alamat', 'latitude', 'longitude'];
}
