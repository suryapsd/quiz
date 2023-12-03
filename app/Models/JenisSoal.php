<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisSoal extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function pendidikan_instansi()
    {
        return $this->belongsTo(PendidikanInstansi::class, 'id_pendidikan_instansi');
    }

    public function soals()
    {
        return $this->hasMany(Soal::class, 'id_jenis_soal');
    }
}
