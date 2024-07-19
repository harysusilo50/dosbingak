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
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
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
        $data = VerificationUser::whereIn('status', ['pending', 'reject'])->with('user')->paginate(10);
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
