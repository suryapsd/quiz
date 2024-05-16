<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalTesAwal extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi');
    }
}
