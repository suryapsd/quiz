<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Soal extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function jenis_soal()
    {
        return $this->belongsTo(JenisSoal::class, 'id_jenis_soal');
    }
}
