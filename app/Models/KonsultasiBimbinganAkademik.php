<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonsultasiBimbinganAkademik extends Model
{
    use HasFactory;

    protected $append = ['format_jam_chat', 'format_tgl_chat'];

    public function bimbingan_akademik()
    {
        return $this->belongsTo(BimbinganAkademik::class, 'bimbingan_akademik_id', 'id');
    }

    public function getFormatJamChatAttribute()
    {
        Carbon::setLocale('id');
        return Carbon::parse($this->attributes['created_at'])->isoFormat('HH:mm');
    }

    public function getFormatTglChatAttribute()
    {
        Carbon::setLocale('id');
        return Carbon::parse($this->attributes['created_at'])->isoFormat('D MMMM Y');
    }
}
