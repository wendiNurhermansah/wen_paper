<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class student extends Model
{
    
    protected $fillable = ['id', 'nama', 'nim', 'jenis_kelamin', 'alamat', 'id_jurusan', 'm_pelajaran_id', 'created_at', 'updated_at'];

    

    public function jurusan()
    {
        return $this->belongsTo(jurusan::class, 'id_jurusan');
    }

    public function m_pelajaran(){
        return $this->belongsTo(m_pelajaran::class, 'm_pelajaran_id');
    }
    
    public function jurusan_pelajaran(){
        return $this->belongsTo(jurusan_pelajaran::class, 'm_pelajaran_id');
    }

    public function m_pelajaran_id()
    {
        return $this->belongsTo(m_pelajaran_id::class, 'id');
    }

}
