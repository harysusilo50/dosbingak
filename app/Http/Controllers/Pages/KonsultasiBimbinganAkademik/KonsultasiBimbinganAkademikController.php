<?php

namespace App\Http\Controllers\Pages\KonsultasiBimbinganAkademik;

use App\Http\Controllers\Controller;
use App\Models\BimbinganAkademik;
use App\Models\KonsultasiBimbinganAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
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

    public function get_latest_chat(Request $request)
    {
        $latestChat = KonsultasiBimbinganAkademik::where('bimbingan_akademik_id', $request->bimbingan_id)->latest()->first();
        $user = User::findOrFail($latestChat->user_id);
        Carbon::setLocale('id');
        $latestChat['format_jam_chat'] = Carbon::parse($latestChat->created_at)->isoFormat('HH:mm');
        $latestChat['format_tgl_chat'] = Carbon::parse($latestChat->created_at)->isoFormat('D MMMM Y');
        $latestChat['role'] = $user->role;
        $latestChat['nama'] = $user->nama ?? "";

        return response()->json($latestChat);
    }
}
