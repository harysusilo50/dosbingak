<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataMahasiswaController extends Controller
{
    public function index(Request $request){
        
        return view('admin.data_mahasiswa.index');
    }
}
