<?php

namespace App\Http\Controllers\Pages\ValidasiKrs;

use App\Http\Controllers\Controller;
use App\Models\CekSemester;
use App\Models\User;
use App\Models\ValidasiKrs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ValidasiKrsController extends Controller
{
    public function index()
    {
        $semesterNow = $this->cekSemester();
        $validasiKrs = ValidasiKrs::where('mahasiswa_id', Auth::id())->get();
        return view('pages.validasi_krs.index', compact('semesterNow', 'validasiKrs'));
    }

    public function create()
    {
        $semesterNow = $this->cekSemester();
        $user = User::findOrFail(Auth::id());

        return view('pages.validasi_krs.create', compact('semesterNow', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_krs' => 'required|max:2048|mimetypes:application/pdf,pdf',
        ], [
            'file_krs.mimetypes' => 'Format salah! hanya PDF yang diizinkan.',
            'file_krs.mimes' => 'Format salah! Hanya PDF yang diizinkan.',
            'file_krs.max' => 'Ukuran file tidak boleh melebihi 2 MB.'
        ]);

        try {
            $dosen_id = User::where('nama', 'LIKE', '%' . Auth::user()->nama_dosen_pa . '%')->value('id');
            DB::beginTransaction();
            $validasi_krs = new ValidasiKrs();
            $validasi_krs->mahasiswa_id = Auth::id();
            $validasi_krs->dosen_id = $dosen_id;
            $validasi_krs->semester = $request->semester;
            $validasi_krs->status = 'menunggu';

            $krsFile = $request->file('file_krs');
            $folderPath = storage_path('app/public/krs/');
            $filename = uniqid() . '_' . $krsFile->getClientOriginalName();
            $krsFile->move($folderPath, $filename);

            $validasi_krs->file_krs = 'storage/krs/' . $filename;

            $validasi_krs->save();

            DB::commit();
            Alert::success('Success','Berhasil membuat pengajuan persetujuan KRS');
            return redirect()->route('validasi-krs.index');
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
