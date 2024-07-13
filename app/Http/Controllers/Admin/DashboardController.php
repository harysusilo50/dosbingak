<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BimbinganAkademik;
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
            $userTotal = BimbinganAkademik::where('dosen_id', Auth::id())->where('status', '!=', 'ditolak')->count();
            $userBimbingan = BimbinganAkademik::where('dosen_id', Auth::id())->where('status', 'selesai')->count();
            if (empty($userTotal)) {
                $presentasi = 0;
            } else {
                $presentasi = (100 * $userBimbingan) / $userTotal;
            }

            return view('admin.dashboard_dosen', compact('presentasi'));
        }

        $totalMahasiswa = User::where('role','user')->count();
        $totalDosen = User::where('role','dosen')->count();

        $userTotal = BimbinganAkademik::where('status', '!=', 'ditolak')->count();
        $userBimbingan = BimbinganAkademik::where('status', 'selesai')->count();
        if (empty($userTotal)) {
            $presentasi = 0;
        } else {
            $presentasi = (100 * $userBimbingan) / $userTotal;
        }

        return view('admin.dashboard', compact('presentasi','totalMahasiswa','totalDosen'));
    }
}
