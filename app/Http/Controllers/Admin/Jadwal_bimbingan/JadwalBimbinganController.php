<?php

namespace App\Http\Controllers\Admin\Jadwal_bimbingan;

use App\Http\Controllers\Controller;
use App\Models\JadwalBimbingan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class JadwalBimbinganController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role == 'dosen') {
            $selected_dosen = Auth::id();
        } elseif (Auth::user()->role = 'user') {
            $qDosen = User::where(['role' => 'dosen', 'nama' => Auth::user()->nama_dosen_pa])->first() ?? '';
            $selected_dosen = $qDosen ? $qDosen->id : '';
        } else {
            $selected_dosen = $request->nama_dosen_pa ?? '';
        }
        $dosen = User::where('role', 'dosen')->get();
        $jadwal = JadwalBimbingan::with('dosen')
            ->when($selected_dosen, function ($query) use ($selected_dosen) {
                return $query->where('dosen_id', $selected_dosen);
            })
            ->get();

        $result = [];
        foreach ($jadwal as $key => $value) {
            $temp = [
                'title' => $value->dosen->nama,
                'start' => $value->tanggal . 'T' . $value->start_at,
                'end' => $value->tanggal . 'T' . $value->end_at,
                'allDay' => false,
            ];
            $result[] = $temp;
        }

        return view('admin.jadwal_bimbingan.index', compact('dosen', 'selected_dosen', 'result'));
    }

    public function create(Request $request)
    {
        if (Auth::user()->role == 'dosen') {
            $selected_dosen = Auth::id();
        } else {
            $selected_dosen = $request->id_dosen ?? '';
        }
        $dosen = User::where('role', 'dosen')->get();

        $jadwal = JadwalBimbingan::with('dosen')
            ->when($selected_dosen, function ($query) use ($selected_dosen) {
                return $query->where('dosen_id', $selected_dosen);
            })
            ->latest()
            ->paginate(30)
            ->withQueryString();
        return view('admin.jadwal_bimbingan.create', compact('jadwal', 'dosen', 'selected_dosen'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = new JadwalBimbingan();
            $data->dosen_id = $request->nama_dosen_pa;
            $data->tanggal = $request->tanggal;
            $data->start_at = $request->start_at;
            $data->end_at = $request->end_at;
            $data->save();
            DB::commit();
            Alert::success('Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Failed', $th->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = JadwalBimbingan::findOrFail($id);
            $data->delete();

            DB::commit();
            Alert::success('Success', 'jadwal bimbingan berhasil dihapus!');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Failed', $th->getMessage());
            return redirect()->back();
        }
    }
}
