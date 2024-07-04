<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalBimbingan extends Model
{
    use HasFactory;
    
    protected $append = ['format_tanggal','format_start_at','format_end_at'];

    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id','id');
    }

    public function getFormatTanggalAttribute()
    {
        Carbon::setLocale('id');
        return Carbon::parse($this->attributes['tanggal'])->isoFormat('D MMMM Y');
    }

    public function getFormatStartAtAttribute()
    {
        Carbon::setLocale('id');
        return Carbon::parse($this->attributes['start_at'])->isoFormat('HH:mm');
    }

    public function getFormatEndAtAttribute()
    {
        Carbon::setLocale('id');
        return Carbon::parse($this->attributes['end_at'])->isoFormat('HH:mm');
    }
}
