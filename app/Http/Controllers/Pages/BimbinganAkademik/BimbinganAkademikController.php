<?php

namespace App\Http\Controllers\Pages\BimbinganAkademik;

use App\Http\Controllers\Controller;
use App\Models\BimbinganAkademik;
use App\Models\CekSemester;
use App\Models\KonsultasiBimbinganAkademik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class BimbinganAkademikController extends Controller
{
    public function index()
    {
        $semesterNow = $this->cekSemester();
        $checkBimbinganSemester = BimbinganAkademik::where(['semester' => $semesterNow, 'mahasiswa_id' => Auth::id()])->first();
        $bimbinganAkedmik = BimbinganAkademik::where('mahasiswa_id', Auth::id())->get();
        return view('pages.bimbingan_akademik.index', compact('checkBimbinganSemester', 'semesterNow', 'bimbinganAkedmik'));
    }

    public function create()
    {
        $semesterNow = $this->cekSemester();
        $user = User::findOrFail(Auth::id());

        return view('pages.bimbingan_akademik.create', compact('semesterNow', 'user'));
    }

    public function store(Request $request)
    {
        try {
            $dosen_id = User::where('nama', 'LIKE', '%' . Auth::user()->nama_dosen_pa . '%')->value('id');
            DB::beginTransaction();
            $bimbingan = new BimbinganAkademik();
            $bimbingan->mahasiswa_id = Auth::id();
            $bimbingan->dosen_id = $dosen_id;
            $bimbingan->semester = $this->cekSemester();
            $bimbingan->topik = $request->topik;
            $bimbingan->tgl_konsultasi = $request->tgl_konsultasi;
            $bimbingan->status = 'menunggu';
            $bimbingan->save();

            $konsultasi = new KonsultasiBimbinganAkademik();
            $konsultasi->bimbingan_akademik_id = $bimbingan->id;
            $konsultasi->user_id = Auth::id();
            $konsultasi->pesan = $request->pesan ?? '';
            $konsultasi->save();

            DB::commit();
            Alert::success('Success', 'Berhasil membuat pengajuan konsultasi');
            return redirect()->route('bimbingan-akademik.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Failed', $th->getMessage());
            return redirect()->back();
        }
    }

    private function cekSemester()
    {
        $cekSemester = new CekSemester();
        $cekSemester->semester();
        return $cekSemester->semester;
    }
}
