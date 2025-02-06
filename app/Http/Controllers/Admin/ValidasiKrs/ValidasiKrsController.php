<?php

namespace App\Http\Controllers\Admin\ValidasiKrs;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ValidasiKrs;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ValidasiKrsController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role == 'dosen') {
            $selected_dosen = Auth::id();
        } else {
            $selected_dosen = $request->nama_dosen_pa ?? '';
        }

        $selected_status = $request->status ?? '';
        $dosen = User::where('role', 'dosen')->get();

        $validasiKrs = ValidasiKrs::with('dosen', 'mahasiswa')
            ->when($selected_dosen, function ($query) use ($selected_dosen) {
                return $query->where('dosen_id', $selected_dosen);
            })
            ->when($selected_status, function ($query) use ($selected_status) {
                return $query->where('status', $selected_status);
            })
            ->get();

        return view('admin.validasi_krs.index', compact('validasiKrs', 'selected_dosen', 'selected_status', 'dosen'));
    }

    public function setujui_krs_bimbingan(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = ValidasiKrs::findOrFail($request->validasiKrs_id);
            $data->status = 'disetujui';
            $data->save();

            DB::commit();
            Alert::success('Success', 'Permohonan Persetujuan KRS Akademik Berhasil Disetujui');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Failed', $th->getMessage());
            return redirect()->back();
        }
    }

    public function tolak_krs_bimbingan(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = ValidasiKrs::findOrFail($request->validasiKrs_id);
            $data->status = 'ditolak';
            $data->keterangan = $request->keterangan;
            $data->save();

            DB::commit();
            Alert::success('Success', 'Permohonan Persetujuan KRS Akademik Berhasil Ditolak');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Failed', $th->getMessage());
            return redirect()->back();
        }
    }

    public function report_pdf(Request $request)
    {
        if (Auth::user()->role == 'dosen') {
            $selected_dosen = Auth::id();
        } else {
            $selected_dosen = $request->selected_dosen ?? '';
        }

        $selected_status = $request->status ?? '';

        $validasiKrs = ValidasiKrs::with('dosen', 'mahasiswa')
            ->when($selected_dosen, function ($query) use ($selected_dosen) {
                return $query->where('dosen_id', $selected_dosen);
            })
            ->when($selected_status, function ($query) use ($selected_status) {
                return $query->where('status', $selected_status);
            })
            ->get();

        $pdf = Pdf::loadview('admin.validasi_krs.report', ['validasiKrs' => $validasiKrs, 'selected_dosen' => $selected_dosen])->setPaper('a4', 'potrait');
        return $pdf->stream('validasi-krs-report' . now() . '.pdf');
    }
}
