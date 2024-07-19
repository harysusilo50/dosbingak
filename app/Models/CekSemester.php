<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CekSemester extends Model
{
    use HasFactory;

    protected $semester;
    protected $append = ['semester', 'list_semester'];

    public function semester()
    {
        $tanggal = Carbon::now()->format('Y-m-d');

        $pecah = explode("-", $tanggal);
        $tahun = intval($pecah[0]);
        $bulan = intval($pecah[1]);

        $temp = ($tahun - 1964) * 2;
        if ($bulan >= 9) {
            $temp += 1;
        }

        $this->semester = $temp;
    }

    public function list_semester($angkatan)
    {
        $tanggal = Carbon::now()->format('Y-m-d');

        $pecah = explode("-", $tanggal);
        $tahun = intval($pecah[0]);
        $bulan = intval($pecah[1]);

        $temp = ($tahun - 1964) * 2;
        if ($bulan >= 9) {
            $temp += 1;
        }

        $temp2 = ($angkatan - 1964) * 2;
        $temp2 += 1;

        $result = [];
        for ($i= $temp2; $i <= $temp ; $i++) { 
            $result[] = $i;
        }

        $this->last_semester = $result;
    }

    public function getSemesterAttribute()
    {
        return $this->semester;
    }

    public function getListSemesterAttribute()
    {
        return $this->list_semester;
    }
}
