<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class visi_misi extends Model
{
    protected $table = 'visi_misi';
    protected $fillable = ['id', 'visi_m', 'gambar', 'created_at', 'updated_at'];
}
