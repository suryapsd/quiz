<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalTesLanjutan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pendidikanInstansi()
    {
        return $this->belongsTo(PendidikanInstansi::class, 'id_pendidikan_instansi');
    }
}
