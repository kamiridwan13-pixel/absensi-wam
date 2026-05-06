<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    protected $fillable = [
    'user_id',
    'tanggal',
    'durasi_jam',
    'tujuan',
    'status'
];

public function user()
{
    return $this->belongsTo(User::class);
}
}
