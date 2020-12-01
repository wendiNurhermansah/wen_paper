<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jurusan extends Model
{
    protected $table = 'jurusan';
    protected $fillable = ['id', 'n_jurusan', 'created_at', 'updated_at' ];
}
