<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BimbinganAkademik extends Model
{
    use HasFactory;

    protected $append = ['format_tgl_konsultasi'];

    public function getFormatTglKonsultasiAttribute()
    {
        Carbon::setLocale('id');
        return Carbon::parse($this->attributes['tgl_konsultasi'])->isoFormat('D MMMM Y');
    }

    
    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id','id');
    }

    
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id','id');
    }

    public function konsultasi_bimbingan_akademik()
    {
        return $this->hasMany(KonsultasiBimbinganAkademik::class);
    }
}
