<?php

namespace App\Models;

use App\User;

use Illuminate\Database\Eloquent\Model;

class adminDetails extends Model
{
    
    protected $table    = 'admin_details';
    protected $fillable = ['id', 'admin_id', 'nama', 'email', 'foto', 'no_telp', 'created_at', 'updated_at'];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}


