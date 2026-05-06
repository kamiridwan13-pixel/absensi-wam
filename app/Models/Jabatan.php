<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $fillable = ['nama', 'rate_per_jam']; // 🔥 WAJIB

    public function users()
    {
        return $this->hasMany(User::class);
    } 
}