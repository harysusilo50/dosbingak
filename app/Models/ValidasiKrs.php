<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidasiKrs extends Model
{
    use HasFactory;

    protected $append = ['jumlah_bimbingan'];

    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id','id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id','id');
    }

    public function getJumlahBimbinganAttribute(){
        return BimbinganAkademik::where('mahasiswa_id',$this->attributes['mahasiswa_id'])->where('status','selesai')->where('semester',$this->attributes['semester'])->count();
    }
}
