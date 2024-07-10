<?php

namespace App\Http\Controllers\Admin\BimbinganAkademik;

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
    public function index(Request $request)
    {
        $semesterNow = $this->cekSemester();
        if (Auth::user()->role == 'dosen') {
            $selected_dosen = Auth::id();
        } else {
            $selected_dosen = $request->nama_dosen_pa ?? '';
        }

        $selected_status = $request->status ?? '';
        $dosen = User::where('role', 'dosen')->get();

        $bimbinganAkedmik = BimbinganAkademik::with('dosen')
            ->when($selected_dosen, function ($query) use ($selected_dosen) {
                return $query->where('dosen_id', $selected_dosen);
            })
            ->when($selected_status, function ($query) use ($selected_status) {
                return $query->where('status', $selected_status);
            })
            ->get();


        return view('admin.bimbingan_akademik.index', compact('semesterNow', 'bimbinganAkedmik', 'selected_dosen', 'selected_status', 'dosen'));
    }

    public function setujui_konsultasi_bimbingan(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = BimbinganAkademik::findOrFail($request->bimbingan_id);
            $data->status = 'disetujui';
            $data->save();

            DB::commit();
            Alert::success('Success', 'Konsultasi Bimbingan Akademik Berhasil Disetujui');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Failed', $th->getMessage());
            return redirect()->back();
        }
    }

    public function tolak_konsultasi_bimbingan(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = BimbinganAkademik::findOrFail($request->bimbingan_id);
            $data->status = 'ditolak';
            $data->keterangan = $request->keterangan;
            $data->save();

            DB::commit();
            Alert::success('Success', 'Konsultasi Bimbingan Akademik Berhasil Ditolak');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Failed', $th->getMessage());
            return redirect()->back();
        }
    }

    public function selesaikan_konsultasi_bimbingan($bimbingan_id)
    {
        try {
            DB::beginTransaction();
            $data = BimbinganAkademik::findOrFail($bimbingan_id);
            $data->status = 'selesai';
            $data->save();
            
            DB::commit();
            Alert::success('Success', 'Konsultasi Bimbingan Akademik Berhasil diselesaikan');
            return redirect()->route('admin.bimbingan-akademik.index');

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
