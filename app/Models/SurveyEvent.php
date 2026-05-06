<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyEvent extends Model
{
    protected $fillable = [
        'judul',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}