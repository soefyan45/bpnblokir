<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Model\PengajuanBlokir;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppsController extends Controller
{
    //
    public function index()
    {
        # code...
        return view('apps/index');
    }
    public function pengajuanBlokir()
    {
        # code...
        return view('apps.pengajuanBlokir');
    }
    public function storePengajuanBlokir(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

        if($request['statusPemohon']!='Perorangan'){
            $this->validate($request,[
                'statusPemohon'         => ['required','string'],
                'namaPemohon'           => ['required','string','max:100'],
                'nomorKTP'              => ['required','string','max:20'],
                'fotoKTP'               => ['required','image','mimes:jpg,jpeg,png','max:4096'],
                'fotoKK'                => ['required','image','mimes:jpg,jpeg,png','max:4096'],
                'pekerjaanPemohon'      => ['required','string','max:20'],
                'alamatPemohon'         => ['required','string','max:1024'],
                'nomorSHM'              => ['required'],
                'fotoSHM'               => ['required','image','mimes:jpg,jpeg,png','max:4096'],
                'kecamatan'             => ['required'],
                'desa'                  => ['required'],
                'suratKuasa'            => ['required','mimes:pdf','max:4096'],
                'suratPermohonan'       => ['required','mimes:pdf','max:4096'],
                'suratHubunganHukum'    => ['required','mimes:pdf','max:4096'],
            ]);
        }
        if($request['statusPemohon']=='Perorangan'){
            $this->validate($request,[
                'statusPemohon'         => ['required','string'],
                'namaPemohon'           => ['required','string','max:100'],
                'nomorKTP'              => ['required','string','max:20'],
                'fotoKTP'               => ['required','image','mimes:jpg,jpeg,png','max:4096'],
                'fotoKK'                => ['required','image','mimes:jpg,jpeg,png','max:4096'],
                'pekerjaanPemohon'      => ['required','string','max:20'],
                'alamatPemohon'         => ['required','string','max:1024'],
                'nomorSHM'              => ['required'],
                'fotoSHM'               => ['required','image','mimes:jpg,jpeg,png','max:4096'],
                'kecamatan'             => ['required'],
                'desa'                  => ['required'],
                // 'suratKuasa'            => ['required','mimes:pdf','max:4096'],
                'suratPermohonan'       => ['required','mimes:pdf','max:4096'],
                'suratHubunganHukum'    => ['required','mimes:pdf','max:4096'],
            ]);
        }

        $store = $pengajuanBlokir->create([
            'user_id'               => Auth::id(),
            'statusPemohon'         => $request['statusPemohon'],
            'namaPemohon'           => $request['namaPemohon'],
            'nomorKTP'              => $request['nomorKTP'],
            'fotoKTP'               => $pengajuanBlokir->uploadImage($request['fotoKTP'],'ktp'),
            'pekerjaanPemohon'      => $request['pekerjaanPemohon'],
            'alamatPemohon'         => $request['alamatPemohon'],
            'fotoKK'                => $pengajuanBlokir->uploadImage($request['fotoKK'],'kk'),
            'nomorSHM'              => $request['nomorSHM'],
            'fotoSHM'               => $pengajuanBlokir->uploadImage($request['fotoSHM'],'shm'),
            'kecamatan'             => $request['kecamatan'],
            'desa'                  => $request['desa'],
            'suratKuasa'            => $pengajuanBlokir->uploadDocument($request['suratKuasa'],'suratkuasa'),
            'suratPermohonan'       => $pengajuanBlokir->uploadDocument($request['suratPermohonan'],'suratpemohon'),
            'suratHubunganHukum'    => $pengajuanBlokir->uploadDocument($request['suratHubunganHukum'],'hubunganhukum'),
        ]);
        if($store){
            date_default_timezone_set("Asia/Jakarta");
            $y      = Carbon::now()->isoFormat('YY');
            $m      = Carbon::now()->isoFormat('MM');
            $store->update([
                'tiket' => $y.$m.$store['id']
            ]);
            return redirect()->route('apps.riwayatblokir')->with('success', 'Pengajuan Kajian Blokir Berhasil di Buat !!!');
        }
    }
    public function riwayatBlokir(PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        $riwayatBlokir = $pengajuanBlokir->riwayatBlokir();
        // return $riwayatBlokir;
        return view('apps.riwayatBlokir',['Riwayat'=>$riwayatBlokir]);
    }
    public function riwayatDetailBlokir($pengajuan_blokir_id,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        $blokir = $pengajuanBlokir->detailBlokir($pengajuan_blokir_id);
        return view('apps.detailBlokir',['blokir'=>$blokir]);
    }
    public function updateKTP(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        $blokir = $pengajuanBlokir->find($request['id_blokir']);
        $blokir->update([
            'fotoKTP'       => $pengajuanBlokir->uploadImage($request['photoKTP'],'editktp'),
            'nomorKTP'      => $request['nomorKTP'],
        ]);
        return redirect()->back()->with('success', 'Data KTP Berhasil Di Edit !!!');
    }
    public function updateKK(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        $blokir = $pengajuanBlokir->find($request['id_blokir']);
        $blokir->update([
            'fotoKK'       => $pengajuanBlokir->uploadImage($request['photoKK'],'editkk'),
        ]);
        return redirect()->back()->with('success', 'Data KK Berhasil Di Edit !!!');
    }
    public function updateSHM(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        $blokir = $pengajuanBlokir->find($request['id_blokir']);
        $blokir->update([
            'fotoSHM'       => $pengajuanBlokir->uploadImage($request['photoSHM'],'editshm'),
        ]);
        return redirect()->back()->with('success', 'Data SHM Berhasil Di Edit !!!');
    }
    public function updateSuratKuasa(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        $blokir = $pengajuanBlokir->find($request['id_blokir']);
        $blokir->update([
            'suratKuasa'            => $pengajuanBlokir->uploadDocument($request['suratKuasa'],'editsuratkuasa'),
        ]);
        return redirect()->back()->with('success', 'Data Surat Kuasa Berhasil Di Edit !!!');
    }
    public function updateSuratPermohonan(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        $blokir = $pengajuanBlokir->find($request['id_blokir']);
        $blokir->update([
            'suratPermohonan'            => $pengajuanBlokir->uploadDocument($request['suratPermohonan'],'editsuratkuasa'),
        ]);
        return redirect()->back()->with('success', 'Data Surat Permohonan Berhasil Di Edit !!!');
    }
    public function updateHubunganHukum(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        $blokir = $pengajuanBlokir->find($request['id_blokir']);
        $blokir->update([
            'suratHubunganHukum'            => $pengajuanBlokir->uploadDocument($request['suratHubunganHukum'],'editsurathubunganhukum'),
        ]);
        return redirect()->back()->with('success', 'Data Surat Hubungan Hukum Berhasil Di Edit !!!');
    }
    public function editDetailBlokir($pengajuan_blokir_id)
    {
        # code...
        return $pengajuan_blokir_id;
    }
    public function nomerTiketLoket(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        $blokir = $pengajuanBlokir->find($request['id_blokir']);
        // return $blokir;
        $blokir->update([
            'tiketLoket'            => $request['notiket'],
            'fotoPNPB'              => $pengajuanBlokir->uploadImage($request['buktiBayar'],'pnpb'),
            'tanggalBayarPNPB'      => $request['tanggalBayar']
        ]);
        return redirect()->back()->with('success', 'Update PNPB & No Tiket Loket Berhasil !!!');
    }
}
