<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = [
    'user_id',
    'tanggal',
    'tipe',
    'status',
    'jam_masuk',
    'jam_pulang',
    'jam_kerja',
    'status_hadir',
    'alasan'
];
public function user()
{
    return $this->belongsTo(User::class);
}
}
