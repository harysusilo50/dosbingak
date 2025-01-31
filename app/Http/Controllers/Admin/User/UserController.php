<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index');
    }

    public function create()
    {
        $user = User::where('role', 'dosen')->get('nama');
        return view('admin.user.create', compact('user'));
    }

    public function store(Request $request)
    {
        try {
            User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'noreg' => $request->noreg,
                'angkatan' => $request->angkatan,
                'nama_dosen_pa' => $request->nama_dosen_pa,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'email_verified_at' => now(),
            ]);
            Alert::success('Success', 'Berhasil menambah pengguna!');
            return redirect()->route('user.all');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Failed', $th->getMessage());
            return redirect()->back();
        }
    }

    public function show($id) {}

    public function edit($id)
    {
        $data = User::findOrFail($id);
        $user = User::where('role', 'dosen')->get('nama');
        return view('admin.user.edit', compact('user', 'data'));
    }

    public function update_user(Request $request, $id)
    {
        try {
            $data = User::findOrFail($id);
            $data->nama = $request->nama;
            $data->email = $request->email;
            $data->noreg = $request->noreg;
            $data->angkatan = $request->angkatan;
            $data->nama_dosen_pa = $request->nama_dosen_pa;
            $data->password = Hash::make($request->password);
            $data->email_verified_at = now();
            $data->save();
            Alert::success('Success', 'Berhasil mengubah data pengguna!');
            return redirect()->route('user.all');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Failed', $th->getMessage());
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
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
            $user = User::findOrFail($id);
            $user->delete();

            DB::commit();
            Alert::success('Success', 'User berhasil dihapus!');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Failed', $th->getMessage());
            return redirect()->back();
        }
    }

    public function list_verify()
    {
        $data = VerificationUser::whereIn('status', ['pending', 'reject'])
            ->with('user')
            ->paginate(10);
        return view('admin.user.list-verify', compact('data'));
    }

    public function all()
    {
        $user = User::paginate()->withQueryString();
        return view('admin.user.user-all', compact('user'));
    }

    public function datatable_user_all()
    {
        $data = User::where('id', '!=', Auth::id())->get();
        return DataTables::of($data)->make(true);
    }

    public function verify_user(Request $request)
    {
        $id = $request->id;
        $user_id = $request->user_id;
        try {
            DB::beginTransaction();
            $verif = VerificationUser::findOrFail($id);
            $verif->status = 'accept';
            $verif->save();

            $user = User::findOrFail($user_id);
            $user->email_verified_at = now();
            $user->save();

            DB::commit();
            Alert::success('Success', 'Berhasil Verifikasi User!');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            Alert::error('Failed', $th->getMessage());
            return redirect()->back();
        }
    }
    public function reject_user(Request $request)
    {
        $id = $request->id;
        try {
            DB::beginTransaction();
            $verif = VerificationUser::findOrFail($id);
            $verif->status = 'reject';
            $verif->description = $request->description;
            $verif->save();

            DB::commit();
            Alert::success('Success', 'Berhasil Reject Verifikasi User!');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            Alert::error('Failed', $th->getMessage());
            return redirect()->back();
        }
    }
}
