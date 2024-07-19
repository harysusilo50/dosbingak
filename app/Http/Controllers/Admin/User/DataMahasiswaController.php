<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\CekSemester;
use App\Models\User;
use App\Models\ValidasiKrs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataMahasiswaController extends Controller
{
    public function index(Request $request)
    {

        $selected_persetujuan_krs = $request->persetujuan_krs ?? '';

        if ($selected_persetujuan_krs == 'selesai') {
            $persetujuan_krs = 'disetujui';
        } else {
            $persetujuan_krs = 'belum';
        }

        $selected_bimbingan = $request->jumlah_bimbingan_akademik ?? '';


        $selected_angkatan = $request->angkatan ?? '';


        $dataMahasiswa = User::with('validasi_krs')
            ->where('role', 'user')
            ->when(Auth::user()->role == 'dosen', function($query){
                $query->where('nama_dosen_pa',Auth::user()->nama);
            })
            ->when($selected_angkatan, function ($query) use ($selected_angkatan) {
                $query->where('angkatan', $selected_angkatan);
            })
            ->when($selected_persetujuan_krs, function ($query) use ($persetujuan_krs) {
                $query->whereHas('validasi_krs', function ($query) use ($persetujuan_krs) {
                    if ($persetujuan_krs == 'disetujui') {
                        $query->where('status', $persetujuan_krs);
                    } else {
                        $query->where('status', '!=', 'disetujui');
                    }
                });
            })
            ->distinct()
            ->get();


        $angkatan = User::whereNotNull('angkatan')
            ->where('angkatan', '!=', '')
            ->distinct()
            ->pluck('angkatan');

        $semesterNow = new CekSemester();
        $semesterNow->semester();
        $semesterNow->semester;



        return view('admin.data_mahasiswa.index', compact('selected_persetujuan_krs', 'dataMahasiswa', 'selected_angkatan', 'angkatan'));
    }
}
