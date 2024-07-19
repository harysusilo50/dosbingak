<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $append = ['format_nama_chat', 'jumlah_mahasiswa_bimbingan', 'validasi_krs_semester'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'alamat',
        'no_hp',
        'noreg',
        'angkatan',
        'nama_dosen_pa',
        'fakultas',
        'prodi',
        'jenjang',
        'email_verified_at',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function jadwal_bimbingan()
    {
        return $this->hasMany(JadwalBimbingan::class);
    }

    public function verificationUser()
    {
        return $this->hasOne(VerificationUser::class);
    }

    public function validasi_krs()
    {
        return $this->hasMany(ValidasiKrs::class, 'mahasiswa_id', 'id');
    }

    public function bimbingan_akademik()
    {
        return $this->hasMany(BimbinganAkademik::class, 'mahasiswa_id', 'id');
    }

    public function getFormatNamaChatAttribute()
    {
        if (strlen($this->attributes['nama']) > 8) {
            return substr($this->attributes['nama'], 0, 8) . '...';
        }
        return $this->attributes['nama'];
    }

    public function getJumlahMahasiswaBimbinganAttribute()
    {
        return User::where('nama_dosen_pa', $this->attributes['nama'])->count();
    }

    public function getValidasiKrsSemesterAttribute()
    {
        $semesterNow = new CekSemester();
        $semesterNow->semester();

        return ValidasiKrs::where(['mahasiswa_id' => $this->attributes['id'], 'semester' => $semesterNow->semester, 'status' => 'disetujui'])->count();
    }

    public function getJumlahBimbinganAttribute()
    {
        $semesterNow = new CekSemester();
        $semesterNow->semester();
        return BimbinganAkademik::where('mahasiswa_id', $this->attributes['id'])->where('status', 'selesai')->where('semester', $semesterNow->semester)->count();
    }
}
