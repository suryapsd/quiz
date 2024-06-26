<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instansi extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function pendidikans()
    {
        return $this->hasMany(PendidikanInstansi::class, 'id_instansi', 'id');
    }

    public function soalTesAwals()
    {
        return $this->hasMany(SoalTesAwal::class, 'id_instansi', 'id');
    }

}
