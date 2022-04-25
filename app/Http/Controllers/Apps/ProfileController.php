<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function index()
    {
        # code...
        // return 'index profile';
        return view('apps.profile');
    }
    public function updateProfile(Request $request,User $user)
    {
        # code...
        // return $request;
        $user = $user->find(Auth::id());
        if($request['tipePemohon']!='Perorangan'){
            $user->update([
                'fullname'          => $request['name'],
                'status_pemohon'    => $request['tipePemohon'],
                'nama_hukum'        => $request['nama_hukum'],
                'surat_hukum'       => $user->uploadDokumen($request['surat_hukum'],'SuratHukum'),
            ]);
            return redirect()->back()->with('success', 'Update Profile Berhasil !!!');
        }
        $user->update([
            'fullname'          => $request['name'],
            'status_pemohon'    => $request['tipePemohon'],
        ]);
        return redirect()->back()->with('success', 'Update Profile Berhasil !!!');
    }
    public function updatePassword(Request $request, User $user)
    {
        # code...
        // return $request;
        $user->find(Auth::id())->update([
            'password' => Hash::make($request['password'])
        ]);
        return redirect()->back()->with('success', 'Update Password Berhasil !!!');
    }
}
