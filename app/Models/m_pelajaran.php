<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class m_pelajaran extends Model
{
    protected $table = 'm_pelajaran';
    protected $fillable = ['id', 'nama', 'created_at', 'updated_at'];
}
