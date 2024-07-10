<?php

namespace App\Http\Controllers\Pages\KonsultasiBimbinganAkademik;

use App\Http\Controllers\Controller;
use App\Models\BimbinganAkademik;
use App\Models\KonsultasiBimbinganAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class KonsultasiBimbinganAkademikController extends Controller
{
    public function index(Request $request)
    {
        $konsultasi = BimbinganAkademik::with('konsultasi_bimbingan_akademik', 'mahasiswa')->findOrFail($request->bimbingan_id);
        return view('pages.konsultasi_bimbingan_akademik.index', compact('konsultasi'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $konsultasi = new KonsultasiBimbinganAkademik();
            $konsultasi->bimbingan_akademik_id = $request->bimbingan_id;
            $konsultasi->user_id = Auth::id();
            $konsultasi->pesan = $request->pesan ?? '';
            $konsultasi->save();

            DB::commit();
            Alert::success('Success', 'Pesan berhasil terkirim');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Failed', $th->getMessage());
            return redirect()->back();
        }
    }
}
