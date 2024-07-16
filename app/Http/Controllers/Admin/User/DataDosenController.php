<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DataDosenController extends Controller
{
    public function index(Request $request)
    {
        $dataDosen = User::where('role','dosen')->get();


        return view('admin.data_dosen.index', compact('dataDosen'));
    }
}
