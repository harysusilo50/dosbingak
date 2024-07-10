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
        $userTotal = BimbinganAkademik::where('dosen_id',Auth::id())->where('status','!=','ditolak')->count()??0;
        $userBimbingan = BimbinganAkademik::where('dosen_id',Auth::id())->where('status','selesai')->count()??0;
        $presentasi = (100*$userBimbingan)/$userTotal;

        return view('admin.dashboard', compact('presentasi'));
    }
}
