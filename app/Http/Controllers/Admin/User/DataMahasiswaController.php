<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\CekSemester;
use App\Models\User;
use App\Models\ValidasiKrs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $semesterNow = new CekSemester();
        $semesterNow->semester();
        $semesterNow->semester;

        if (Auth::user()->role == 'dosen') {

            $dataMahasiswa = DB::select("SELECT id, nama, noreg, angkatan,
            (CASE 
                WHEN (SELECT COUNT(*) FROM validasi_krs AS v 
                      WHERE v.mahasiswa_id = users.id AND v.semester = ? AND v.status = 'disetujui') > 0 
                THEN 'Sudah' 
                ELSE 'Belum' 
            END) AS validasi,
            (CASE 
                WHEN (SELECT COUNT(*) FROM bimbingan_akademiks AS bim 
                      WHERE users.id = bim.mahasiswa_id AND bim.status = 'selesai' AND bim.semester = ?) < 1 
                THEN 'Belum Pernah Bimbingan' 
                ELSE concat((SELECT COUNT(*) FROM bimbingan_akademiks AS bim 
                             WHERE users.id = bim.mahasiswa_id AND bim.status = 'selesai' AND bim.semester = ?), 'x bimbingan') 
            END) AS bimbingan
        FROM users 
        WHERE users.role = 'user' AND users.nama_dosen_pa = ?", [$semesterNow->semester, $semesterNow->semester, $semesterNow->semester, Auth::user()->nama]);
        } else {

            $dataMahasiswa = DB::select("SELECT id, nama, noreg, angkatan,
            (CASE 
                WHEN (SELECT COUNT(*) FROM validasi_krs AS v 
                      WHERE v.mahasiswa_id = users.id AND v.semester = ? AND v.status = 'disetujui') > 0 
                THEN 'Sudah' 
                ELSE 'Belum' 
            END) AS validasi,
            (CASE 
                WHEN (SELECT COUNT(*) FROM bimbingan_akademiks AS bim 
                      WHERE users.id = bim.mahasiswa_id AND bim.status = 'selesai' AND bim.semester = ?) < 1 
                THEN 'Belum Pernah Bimbingan' 
                ELSE concat((SELECT COUNT(*) FROM bimbingan_akademiks AS bim 
                             WHERE users.id = bim.mahasiswa_id AND bim.status = 'selesai' AND bim.semester = ?), 'x bimbingan') 
            END) AS bimbingan
        FROM users 
        WHERE users.role = 'user'", [$semesterNow->semester, $semesterNow->semester, $semesterNow->semester]);
        }


        return view('admin.data_mahasiswa.index', compact('dataMahasiswa'));
    }
}
