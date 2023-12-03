<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PendidikanInstansi extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi');
    }
}
