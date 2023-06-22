<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    use HasFactory, HasUuids;
    protected $table = "konsumen";
    protected $primaryKey = 'id_konsumen';
    protected $fillable = ['id_pengguna', 'nama', 'email', 'alamat', 'no_hp', 'username', 'password', 'foto'];
}
