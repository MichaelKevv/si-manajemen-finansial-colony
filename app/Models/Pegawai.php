<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory, HasUuids;
    protected $table = "pegawai";
    protected $primaryKey = 'id_pegawai';
    protected $fillable = ['id_pengguna', 'nama', 'email', 'alamat', 'no_hp', 'username', 'password', 'foto'];
}
