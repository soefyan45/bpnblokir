<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Mail\MailInfo;
use App\Model\PengajuanBlokir;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AppsController extends Controller
{
    //
    public function index(PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        $totalPermohonan = $pengajuanBlokir->where('user_id',Auth::id())->count();
        $verifikasi = $pengajuanBlokir->where('user_id',Auth::id())->where('statusPengkajian','Verifikasi Dokumen')->count();
        $klarifikasi = $pengajuanBlokir->where('user_id',Auth::id())->where('statusPengkajian','Klarifikasi')->count();
        $pengkajian = $pengajuanBlokir->where('user_id',Auth::id())->where('statusPengkajian','Pengkajian Blokir')->count();
        $selesai = $pengajuanBlokir->where('user_id',Auth::id())->where('statusPengkajian','Selesai')->count();
        // return $totalPermohonan;
        return view('apps/index',[
            'total'         => $totalPermohonan,
            'verifikasi'    => $verifikasi,
            'klarifikasi'   => $klarifikasi,
            'pengkajian'    => $pengkajian,
            'selesai'       => $selesai,
        ]);
    }
    public function pengajuanBlokir()
    {
        # code...

        return view('apps.pengajuanBlokir');
    }
    public function storePengajuanBlokir(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...

        if(isset($request['fotoSHM'])){
            if($request['statusPemohon']!='Perorangan'){
                $this->validate($request,[
                    'fotoSHM'               => ['required','image','mimes:jpg,jpeg,png','max:4096'],
                ]);
            }
        }
        // return $request;
        // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

        if($request['statusPemohon']!='Perorangan'){
            $this->validate($request,[
                'statusPemohon'         => ['required','string'],
                'namaPemohon'           => ['required','string','max:100'],
                'nomorKTP'              => ['required','string','max:20'],
                'fotoKTP'               => ['required','image','mimes:jpg,jpeg,png','max:2048'],
                'fotoKK'                => ['required','image','mimes:jpg,jpeg,png','max:2048'],
                'pekerjaanPemohon'      => ['required','string','max:20'],
                'alamatPemohon'         => ['required','string','max:1024'],
                'nomorSHM'              => ['required'],
                // 'fotoSHM'               => ['required','image','mimes:jpg,jpeg,png','max:2048'],
                'kecamatan'             => ['required'],
                'desa'                  => ['required'],
                'suratKuasa'            => ['required','mimes:pdf','max:2048'],
                'suratPermohonan'       => ['required','mimes:pdf','max:2048'],
                'suratHubunganHukum'    => ['required','mimes:pdf','max:2048'],
            ]);
        }
        if($request['statusPemohon']=='Perorangan'){
            $this->validate($request,[
                'statusPemohon'         => ['required','string'],
                'namaPemohon'           => ['required','string','max:100'],
                'nomorKTP'              => ['required','string','max:20'],
                'fotoKTP'               => ['required','image','mimes:jpg,jpeg,png','max:2048'],
                'fotoKK'                => ['required','image','mimes:jpg,jpeg,png','max:2048'],
                'pekerjaanPemohon'      => ['required','string','max:20'],
                'alamatPemohon'         => ['required','string','max:1024'],
                'nomorSHM'              => ['required'],
                // 'fotoSHM'               => ['required','image','mimes:jpg,jpeg,png','max:2048'],
                'kecamatan'             => ['required'],
                'desa'                  => ['required'],
                // 'suratKuasa'            => ['required','mimes:pdf','max:2048'],
                'suratPermohonan'       => ['required','mimes:pdf','max:2048'],
                'suratHubunganHukum'    => ['required','mimes:pdf','max:2048'],
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
            // 'fotoSHM'               => $pengajuanBlokir->uploadImage($request['fotoSHM'],'shm'),
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
            if(isset($request['fotoSHM'])){
                $store->update([
                    'fotoSHM' => $pengajuanBlokir->uploadImage($request['fotoSHM'],'shm'),
                ]);
            }
            if(isset($request['lokasiSHM'])){
                $store->update([
                    'lokasi_SHM' => $request['lokasiSHM'],
                ]);
            }
            $store->update([
                'tiket' => $y.$m.$store['id']
            ]);
            $data = array(
                'name'      => 'BPN KAMPAR',
                'body'      => 'Tiket <b>pengkajian blokir online</b> baru di buat oleh pemohon dengan nomor #tiket'.$y.$m.$store['id'].' detail silahkan akses aplikasi',
                'cta_link'  => route('officer.pengkajianblokir',$store['id']),
                'cta_title' => 'Detail',
                'subject'   => 'Info Permohonan Blokir #Tiket'.$y.$m.$store['id']
            );
            Mail::to('spmppkampar18@gmail.com')->send(new MailInfo($data));
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
        $this->validate($request,[
            'fotoKTP'               => ['required','image','mimes:jpg,jpeg,png','max:2048'],
        ]);
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
        $this->validate($request,[
            'fotoKK'               => ['required','image','mimes:jpg,jpeg,png','max:2048'],
        ]);
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
        $this->validate($request,[
            'fotoSHM'               => ['required','image','mimes:jpg,jpeg,png','max:2048'],
        ]);
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
        $this->validate($request,[
            'suratKuasa'               => ['required','mimes:pdf','max:2048'],
        ]);
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
        $this->validate($request,[
            'suratPermohonan'               => ['required','mimes:pdf','max:2048'],
        ]);
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
        $this->validate($request,[
            'suratHubunganHukum'               => ['required','mimes:pdf','max:2048'],
        ]);
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
        $this->validate($request,[
            'buktiBayar'               => ['required','image','mimes:jpg,jpeg,png','max:2048'],
        ]);
        $blokir->update([
            'tiketLoket'            => $request['notiket'],
            'fotoPNPB'              => $pengajuanBlokir->uploadImage($request['buktiBayar'],'pnpb'),
            'tanggalBayarPNPB'      => $request['tanggalBayar']
        ]);
        //email
        $data = array(
            'name'      => 'BPN KAMPAR',
            'body'      => 'Pemohon sudah melakukan pendafaran ulang di <b>loket dan upload bukti pembayaran PNPB</b> #tiket'.$blokir['tiket'].'. Silahkan lakukan konfirmasi untuk melanjutkan permohoan blokir',
            'cta_link'  => route('officer.pengkajianblokir',$blokir['id']),
            'cta_title' => 'Detail',
            'subject'   => 'Bukti Tiket & PNPB #Tiket'.$blokir['tiket']
        );
        Mail::to('spmppkampar18@gmail.com')->send(new MailInfo($data));
        return redirect()->back()->with('success', 'Update PNPB & No Tiket Loket Berhasil !!!');
    }
}
