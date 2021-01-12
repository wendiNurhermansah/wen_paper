<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class gallery extends Model
{
    protected $table = 'gallery';
    protected $fillable = ['id', 'n_gallery', 'gambar', 'created_at', 'updated_at'];
}
