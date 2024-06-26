<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
   

    protected $fillable = [
        'npm',
        'dospem_1',
        'dospem_2',
        'nama_dospem1',
        'nama_dospem2',
        'updated_at',
        'created_at'
    ];
    protected $primaryKey = 'id';
}
