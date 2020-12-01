<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $table = 'students';
    protected $fillable = ['id', 'nama', 'nim', 'jenis_kelamin', 'alamat', 'id_jurusan', 'id_mapel', 'created_at', 'updated_at'];

    public function mapel()
    {
        return $this->belongsTo(mapel::class, 'id_mapel');
    }

    public function jurusan()
    {
        return $this->belongsTo(jurusan::class, 'id_jurusan');
    }
}
