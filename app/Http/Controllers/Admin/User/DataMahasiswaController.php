<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\CekSemester;
use App\Models\User;
use App\Models\ValidasiKrs;
use Barryvdh\DomPDF\Facade\Pdf;
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

        $selected_dosen = $request->nama_dosen_pa ?? '';
        $find_dosen = User::find($request->nama_dosen_pa);

        if (Auth::user()->role == 'dosen') {
            $dosen = User::where('id', Auth::id())->get();
            $selected_dosen =  Auth::id();
            $dataMahasiswa = DB::select(
                "SELECT id, nama, noreg, angkatan,
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
        WHERE users.role = 'user' AND users.nama_dosen_pa = ?",
                [$semesterNow->semester, $semesterNow->semester, $semesterNow->semester, Auth::user()->nama],
            );
        } else {
            $dosen = User::where('role', 'dosen')->get();
            $query_dosen = empty($find_dosen) ? '' : DB::raw('AND users.nama_dosen_pa = ?', [$find_dosen->nama]);
            $query = "SELECT id, nama, noreg, angkatan,
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
                ELSE CONCAT((SELECT COUNT(*) FROM bimbingan_akademiks AS bim
                             WHERE users.id = bim.mahasiswa_id AND bim.status = 'selesai' AND bim.semester = ?), 'x bimbingan')
            END) AS bimbingan
        FROM users
        WHERE users.role = 'user'";

            $bindings = [$semesterNow->semester, $semesterNow->semester, $semesterNow->semester];

            // Tambahkan filter berdasarkan nama dosen PA jika ada
            if (!empty($find_dosen)) {
                $query .= ' AND users.nama_dosen_pa = ?';
                $bindings[] = $find_dosen->nama;
            }

            $dataMahasiswa = DB::select($query, $bindings);
        }

        return view('admin.data_mahasiswa.index', compact('dataMahasiswa', 'selected_dosen', 'dosen'));
    }

    public function report_pdf(Request $request)
    {
        if (Auth::user()->role == 'dosen') {
            $selected_dosen = Auth::id();
            $dataMahasiswa = User::where(['role' => 'user', 'nama_dosen_pa' => Auth::user()->nama])->get();
        } else {
            $selected_dosen = $request->nama_dosen_pa ?? '';
            $find_dosen = User::find($request->nama_dosen_pa);
            if($find_dosen){
                $dataMahasiswa = User::where(['role' => 'user', 'nama_dosen_pa' => $find_dosen->nama])->get();
            }else{
                $dataMahasiswa = User::where('role','user')->get();
            }
        }

        $pdf = Pdf::loadview('admin.data_mahasiswa.report', ['dataMahasiswa' => $dataMahasiswa, 'selected_dosen' => $selected_dosen])->setPaper('a4', 'potrait');
        return $pdf->stream('data-mahasiswa-bimbingan' . now() . '.pdf');
    }
}
