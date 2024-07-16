<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ValidasiKrs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $selected_status = $request->status ?? '';

        $dataMahasiswa = ValidasiKrs::with('mahasiswa')->get();
        

        return view('admin.data_mahasiswa.index',compact('selected_status','dataMahasiswa'));
    }
}
