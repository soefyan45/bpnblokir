<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Image;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password','nowa','fullname','pemohon','email_verified_at','nama_hukum','surat_hukum','status_pemohon'
    // ];
    protected $guarded = [''];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function uploadFoto($file,$namaBerkas)
    {
        # code...
        if($file==null){
            return null;
        }
        $pacthimage = 'assets/images/foto';
        $slugJudul  = strtolower(str_replace(" ","-",$namaBerkas));
        $fileBerkas = $file;
        $fileberkas = 'data_blokir'.Carbon::now()->timestamp .'_'.$slugJudul. '_'. uniqid() . '.' . $fileBerkas->getClientOriginalExtension();
        Image::make($fileBerkas)->save($pacthimage . '/' . $fileberkas);
        $urlFile  = $pacthimage.'/'.$fileberkas;
        return $urlFile;
    }
    public function uploadDokumen($file,$namaBerkas)
    {
        # code...
        if($file==null){
            return null;
        }
        $slugJudul  = strtolower(str_replace(" ","-",$namaBerkas));
        $fileBerkas = $file;
        $fileberkas = 'berkasHukum'.Carbon::now()->timestamp .'_'.$slugJudul. '_'. uniqid() . '.' . $fileBerkas->getClientOriginalExtension();
        $urlBerkas = Storage::putFileAs(
            'public/dokumenHukum', $file, $fileberkas, 'public'
        );
        $urlBerkas = '/storage/'.$urlBerkas;
        return '/storage/dokumenHukum/'.$fileberkas;
    }
}
