<?php

namespace App\Model;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\Storage;

class PengajuanBlokir extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [''];
    public function riwayatBlokir()
    {
        # code...
        $user = User::find(Auth::id());
        if($user->hasRole(['Petugas'])){
            return $this->get();
        }
        $user_id = Auth::id();
        return $this->where('user_id',$user_id)->get();
    }
    public function detailBlokir($id)
    {
        # code...
        $user = User::find(Auth::id());
        if($user->hasRole(['Petugas'])){
            return $this->where('id',$id)->firstOrFail();
        }
        $user_id = Auth::id();
        return $this->where('id',$id)->where('user_id',$user_id)->firstOrFail();
    }
    public function user()
    {
        # code...
        return $this->hasOne(User::class,'id','user_id');
    }
    public function noteDokumen()
    {
        # code...
        return $this->hasMany(NoteDokumenLampiran::class, 'pengajuan_blokir_id');
    }
    public function hasilKajian()
    {
        # code...
        return $this->hasMany(HasilKajianBlokir::class, 'pengajuan_blokir_id');
    }
    public function uploadImage($file,$namaBerkas)
    {
        # code...
        if($file==null){
            return null;
        }
        $pacthimage = 'assets/images';
        $slugJudul  = strtolower(str_replace(" ","-",$namaBerkas));
        $fileBerkas = $file;
        $fileberkas = 'data_blokir'.Carbon::now()->timestamp .'_'.$slugJudul. '_'. uniqid() . '.' . $fileBerkas->getClientOriginalExtension();
        Image::make($fileBerkas)->save($pacthimage . '/' . $fileberkas);
        $urlFile  = $pacthimage.'/'.$fileberkas;
        return $urlFile;
    }
    public function uploadDocument($file,$namaBerkas)
    {
        # code...
        if($file==null){
            return null;
        }
        $slugJudul  = strtolower(str_replace(" ","-",$namaBerkas));
        $fileBerkas = $file;
        $fileberkas = 'berkas_blokir'.Carbon::now()->timestamp .'_'.$slugJudul. '_'. uniqid() . '.' . $fileBerkas->getClientOriginalExtension();
        $urlBerkas = Storage::putFileAs(
            'public/berkas', $file, $fileberkas, 'public'
        );
        $urlBerkas = '/storage/'.$urlBerkas;
        return '/storage/berkas/'.$fileberkas;
    }
}
