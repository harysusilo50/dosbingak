<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonsultasiBimbinganAkademik extends Model
{
    use HasFactory;

    public function bimbingan_akademik()
    {
        return $this->belongsTo(BimbinganAkademik::class, 'bimbingan_akademik_id','id');
    }
}
