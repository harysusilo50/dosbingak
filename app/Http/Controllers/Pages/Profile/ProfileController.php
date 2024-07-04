<?php

namespace App\Http\Controllers\Pages\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index()
    {
        $user  = Auth::user();
        return view('pages.profile.index', compact('user'));
    }

    public function update(Request $request){
        DB::beginTransaction();
        try {
            $user = User::findOrFail(Auth::id());
            $user->alamat = $request->alamat;
            $user->no_hp = $request->no_hp;
            $user->save();

            DB::commit();
            Alert::success('Success','Berhasil update profile');
            return redirect()->back();
            
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Failed', $th->getMessage());
            return redirect()->back();
        }
    }
}
