<?php

namespace App\Http\Controllers\Pages\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $user  = Auth::user();
        return view('pages.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail(Auth::id());
            $user->alamat = $request->alamat;
            $user->no_hp = $request->no_hp;


            $image_parts = explode(";base64,", $request->image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            $folderPath = storage_path('app/public/profile/');
            $image_name =  Str::uuid() .  '_' . Auth::user()->nim . '' . '.' . $image_type;
            $file = $folderPath . '' . $image_name;
            file_put_contents($file, $image_base64);
            $user->profile_pic = 'storage/profile/' . $image_name;

            $user->save();

            DB::commit();
            Alert::success('Success', 'Berhasil update profile');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Failed', $th->getMessage());
            return redirect()->back();
        }
    }
}
