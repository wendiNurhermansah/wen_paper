<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jurusan_pelajaran extends Model
{
    protected $table = 'jurusan_pelajaran';
    protected $fillable = ['id', 'jurusan_id', 'm_pelajaran_id', 'created_at', 'updated_at'];

    public function jurusan(){
        return $this->belongsTo(jurusan::class, 'jurusan_id');
    }
    public function m_pelajaran(){
        return $this->belongsTo(m_pelajaran::class, 'm_pelajaran_id');
    }
}
