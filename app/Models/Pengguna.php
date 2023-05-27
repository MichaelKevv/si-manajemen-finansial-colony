<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory, HasUuids;
    protected $table = "pengguna";
    protected $primaryKey = 'id_pengguna';
    protected $fillable = ['nama', 'role'];
}
