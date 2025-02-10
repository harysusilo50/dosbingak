<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BimbinganAkademik;
use App\Models\CekSemester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role == 'dosen') {
            $presentasi = User::where('nama_dosen_pa', Auth::user()->nama)->where('role', 'user')->count();

            return view('admin.dashboard_dosen', compact('presentasi'));
        }

        $totalMahasiswa = User::where('role', 'user')->count();
        $totalDosen = User::where('role', 'dosen')->count();

        $listDosen = User::where('role', 'dosen')->get(['id', 'nama']);

        $chartBimbingan = [];
        foreach ($listDosen as $key => $item) {
            $bimbinganSelesai = BimbinganAkademik::where('dosen_id', $item->id)->where('status', 'selesai')->count();

            $chartBimbingan[$key] = [
                'nama_dosen' => $item->nama,
                'presentase' => $bimbinganSelesai,

            ];
        }

        $userBimbingan = BimbinganAkademik::where('status', 'selesai')->count();

        return view('admin.dashboard', compact('userBimbingan', 'totalMahasiswa', 'totalDosen', 'chartBimbingan'));
    }
}
