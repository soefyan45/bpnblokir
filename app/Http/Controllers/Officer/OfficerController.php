<?php

namespace App\Http\Controllers\Officer;

use App\Exports\BlokirReportExport;
use App\Http\Controllers\Controller;
use App\Model\HasilKajianBlokir;
use App\Model\NoteDokumenLampiran;
use App\Model\PengajuanBlokir;
use App\Model\PenjabatBlokir;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Exception;
use Illuminate\Support\Facades\Hash;

class OfficerController extends Controller
{
    //
    public function index(PengajuanBlokir $pengajuanBlokir,User $user)
    {
        # code...
        // return 'index';
        $user = $user->where('pemohon',true)->count();
        $pengajuan = $pengajuanBlokir->count();
        $verifikasiDokumen = $pengajuanBlokir->where('statusPengkajian','Verifikasi Dokumen')->count();
        $dokumenDiTolak = $pengajuanBlokir->where('statusPengkajian','Dokumen di Tolak')->count();
        $Klarifikasi = $pengajuanBlokir->where('statusPengkajian','Klarifikasi')->count();
        $pengkajianBlokir = $pengajuanBlokir->where('statusPengkajian','Pengkajian Blokir')->count();
        $selesai = $pengajuanBlokir->where('statusPengkajian','Selesai')->count();
        return view('officers.officerIndex',[
            'Blokir'=>$pengajuanBlokir->get(),
            'User'=>$user,
            'Pengajuan'=>$pengajuan,
            'Verifikasi'=>$verifikasiDokumen,
            'Ditolak'=>$dokumenDiTolak,
            'Klarifikasi'=>$Klarifikasi,
            'pengkajianBlokir'=>$pengkajianBlokir,
            'Selesai'=>$selesai,
        ]);
    }
    public function riwayatBlokir(PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        $riwayatBlokir = $pengajuanBlokir->riwayatBlokir();
        return view('officers.officerRiwayatBlokir',['Riwayat'=>$riwayatBlokir]);
    }
    public function pengkajianBlokir($pengajuan_blokir_id,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        $blokir = $pengajuanBlokir->detailBlokir($pengajuan_blokir_id);
        // return $blokir;
        return view('officers.officerDetailBlokir',['blokir'=>$blokir]);
    }
    public function berkasKTP(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        $blokir = $pengajuanBlokir->find($request['id_blokir']);
        // return $blokir;
        $blokir->update([
            'keterangan_KTP'    => $request['keterangan'],
            'status_KTP'        => $request['statusKTP'],
        ]);
        return redirect()->back()->with('success', 'Update Status Berkas KTP Berhasil !!!');
    }
    public function berkasKK(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        $blokir = $pengajuanBlokir->find($request['id_blokir']);
        $blokir->update([
            'keterangan_KK' => $request['keterangan'],
            'status_KK'     => $request['statusKK']
        ]);
        return redirect()->back()->with('success', 'Update Status Berkas KK Berhasil !!!');
    }
    public function berkasSHM(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        $blokir = $pengajuanBlokir->find($request['id_blokir']);
        $blokir->update([
            'keterangan_SHM' => $request['keterangan'],
            'status_SHM'     => $request['statusSHM']
        ]);
        return redirect()->back()->with('success', 'Update Status Berkas SHM Berhasil !!!');
    }
    public function berkasSuratKuasa(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        $blokir = $pengajuanBlokir->find($request['id_blokir']);
        $blokir->update([
            'keterangan_suratKuasa' => $request['keterangan'],
            'status_suratKuasa'     => $request['statusSuratKuasa']
        ]);
        return redirect()->back()->with('success', 'Update Status Berkas Surat Kuasa Berhasil !!!');
    }
    public function berkasSuratPermohonan(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        $blokir = $pengajuanBlokir->find($request['id_blokir']);
        $blokir->update([
            'keterangan_suratPermohonan' => $request['keterangan'],
            'status_suratPermohonan'     => $request['statusSuratPermohonan']
        ]);
        return redirect()->back()->with('success', 'Update Status Berkas Surat Permohonan Berhasil !!!');
    }
    public function berkasSuratHubunganHukum(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        $blokir = $pengajuanBlokir->find($request['id_blokir']);
        $blokir->update([
            'keterangan_suratHubunganHukum' => $request['keterangan'],
            'status_suratHubunganHukum'     => $request['statusSuratHubunganHukum']
        ]);
        return redirect()->back()->with('success', 'Update Status Berkas Surat Permohonan Berhasil !!!');
    }
    public function klarifikasiDokumen(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        $blokir = $pengajuanBlokir->find($request['id_blokir']);
        $blokir->update([
            'statusPengkajian'  => $request['statusPengajuan'],
            'anSHM'             => $request['anSHM'],
            'tanggalSHM'        => $request['tanggalSHM'],
            'luasSHM'           => $request['luasSHM'],
            'SUnomor'           => $request['suNomor'],
        ]);
        return redirect()->back()->with('success', 'Update Status Berkas Surat Permohonan Berhasil !!!');
    }
    public function dokumenTidakValid(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        $blokir = $pengajuanBlokir->find($request['id_blokir']);
        $blokir->update([
            'statusPengkajian'  => 'Dokumen di Tolak'
        ]);
        return redirect()->back()->with('success', 'Dokument Di Tolak');
    }
    public function cekPNPB(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        if($request['konfirmasiPNPB']=='Tidak Valid'){
            $blokir = $pengajuanBlokir->find($request['id_blokir']);
            $blokir->update([
                'statusPNPB'        => $request['konfirmasiPNPB'],
            ]);
            return redirect()->back()->with('success', 'Konfirmasi PNPB Berhasil !!!');
        }
        $blokir = $pengajuanBlokir->find($request['id_blokir']);
        $blokir->update([
            'statusPNPB'        => $request['konfirmasiPNPB'],
            'statusPengkajian'  => 'Pengkajian Blokir'
        ]);
        return redirect()->back()->with('success', 'Konfirmasi PNPB Berhasil !!!');
    }
    public function storeKeteranganDokumen(Request $request,NoteDokumenLampiran $noteDokumenLampiran)
    {
        # code...
        // return $request;
        $noteDokumenLampiran->create([
            'pengajuan_blokir_id'   => $request['id_blokir'],
            'user_id'               => Auth::id(),
            'detail_dokumen'           => $request['keteranganDokumen']
        ]);
        return redirect()->back()->with('success', 'Menambahkan Keterangan Dokumen Berhasil !!!');
    }
    public function storeHasilKajian(Request $request,HasilKajianBlokir $hasilKajianBlokir)
    {
        # code...
        // return $request;
        $hasilKajianBlokir->create([
            'pengajuan_blokir_id'   => $request['id_blokir'],
            'user_id'               => Auth::id(),
            'pointKajian'           => $request['pointHasilKajian'],
            'keterangan'            => $request['deskripsiHasilKajian']
        ]);
        return redirect()->back()->with('success', 'Menambahkan Hasil Kajian Berhasil !!!');
    }
    public function generateHasilKajian(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        $blokir = $pengajuanBlokir->find($request['id_blokir']);
        $blokir->update([
            'nomor_notaDinas'       => $request['nomor_notaDinas'],
            'tanggal_notaDinas'     => $request['tanggal_notaDinas'],
            'statusPengkajian'      => 'Selesai'
        ]);
        return redirect()->back()->with('success', 'Berhasil Membuat Surat Hasil Kajian !!!');
    }
    public function printHasilKajian($pengajuan_blokir_id,PengajuanBlokir $pengajuanBlokir,PenjabatBlokir $penjabatBlokir)
    {
        # code...
        // return $request;
        $blokir = $pengajuanBlokir->detailBlokir($pengajuan_blokir_id);
        $penjabat = $penjabatBlokir->find(1);
        return view('officers.suratHasilKajian',['blokir'=>$blokir,'penjabat'=>$penjabat]);
    }
    public function uploadHasilKajian(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        $blokir = $pengajuanBlokir->find($request['id_blokir']);
        $blokir->update([
            'suratHasilKajian' => $pengajuanBlokir->uploadDocument($request['suratKajian'],'surathasil_kajian')
        ]);
        return redirect()->back()->with('success', 'Berhasil Upload Surat Hasil Kajian !!!');
    }
    public function cariSHMDataBlokir(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        $riwayatBlokir = $pengajuanBlokir->where('nomorSHM','like','%'.$request['nomorSHM'].'%')->get();
        // return $blokir;
        return view('officers.officerRiwayatBlokir',['Riwayat'=>$riwayatBlokir]);
    }
    public function reportBlokir()
    {
        # code...
        // return $pengajuanBlokir->get();
        return view('officers.officerReport',['Generate'=>false]);
    }
    public function generateReportBlokir(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        $start              = Carbon::parse($request['startDate'])->addSeconds(01)->toDateTimeString();
        $end                = Carbon::parse($request['endDate'])->addHours(23)->addMinutes(59)->addSeconds(59)->toDateTimeString();
        $blokir             = $pengajuanBlokir->whereBetween('created_at',[$start,$end])->get();
        //data
        $dataBlokir         = $pengajuanBlokir->whereBetween('created_at',[$start,$end]);
        $verifikasiDokumen  = $pengajuanBlokir->where('statusPengkajian','Verifikasi Dokumen')->whereBetween('created_at',[$start,$end])->count();
        $dokumenDiTolak     = $pengajuanBlokir->where('statusPengkajian','Dokumen di Tolak')->whereBetween('created_at',[$start,$end])->count();
        $Klarifikasi        = $pengajuanBlokir->where('statusPengkajian','Klarifikasi')->whereBetween('created_at',[$start,$end])->count();
        $pengkajianBlokir   = $pengajuanBlokir->where('statusPengkajian','Pengkajian Blokir')->whereBetween('created_at',[$start,$end])->count();
        $selesai            = $pengajuanBlokir->where('statusPengkajian','Selesai')->whereBetween('created_at',[$start,$end])->count();
        // return $dokumenDiTolak;
        // return $Klarifikasi;
        return view('officers.officerReport',[
            'Generate'          => true,
            'start'             => $request['startDate'],
            'end'               => $request['endDate'],
            'Blokir'            => $blokir,
            'Verifikasi'        => $verifikasiDokumen,
            'Ditolak'           => $dokumenDiTolak,
            'Klarifikasi'       => $Klarifikasi,
            'pengkajianBlokir'  => $pengkajianBlokir,
            'Selesai'           => $selesai,
        ]);
    }
    public function downloadReport(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        $start              = Carbon::parse($request['startDate'])->addSeconds(01)->toDateTimeString();
        $end                = Carbon::parse($request['endDate'])->addHours(23)->addMinutes(59)->addSeconds(59)->toDateTimeString();
        $blokir             = $pengajuanBlokir->whereBetween('created_at',[$start,$end])->get();
        # code...
        return Excel::download(new BlokirReportExport, 'blokirReport.xlsx');

    }
    public function settingPetugas(User $user)
    {
        # code...
        // return 'petugas';
        $user = $user->where('pemohon','false')->get();
        return view('officers.officerSettingPetugas',['User'=>$user]);
    }
    public function storePetugas(Request $request,User $user)
    {
        # code...
        // return $request;
        $this->validate($request,[
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nowa'      => ['required', 'string', 'max:13', 'unique:users'],
            'password'  => ['required', 'string', 'min:8'],
        ]);
        $dataName = explode(" ", $request['name']);
        // return Carbon::now()->toDateTimeString();
        $user->create([
            'name'              => $dataName[0],
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'pemohon'           => 'false',
            'fullname'          => $request['name'],
            'email'             => $request['email'],
            'nowa'              => $request['nowa'],
            'password'          => Hash::make($request['password']),
        ])->assignRole('Petugas');
        return redirect()->back()->with('success', 'Menambahkan Petugas Berhasil !!!');
    }
    public function updatePetugas(Request $request,User $user)
    {
        # code...
        // return $request;
        if($request['password'] == '' || $request['password']==null){
            $uUser = $user->find($request['idPetugas'])->update([
                'name' => $request['name'],
            ]);
            if($uUser){
                return redirect()->back()->with('success', 'Update Petugas Berhasil !!!');
            }
            return $uUser;
        }
        $uUser = $user->find($request['idPetugas'])->update([
            'name'      => $request['name'],
            'password'  => Hash::make($request['password']),
        ]);
        if($uUser){
            return redirect()->back()->with('success', 'Update Petugas Berhasil !!!');
        }
        return $uUser;
    }
    public function settingPemohon(User $user)
    {
        # code...
        // return 'pemohon';
        $user = $user->where('pemohon',true)->get();
        return view('officers.officerSettingPemohon',['User'=>$user]);
    }
    public function updatevalidhukum(Request $request,User $user)
    {
        # code...
        // return $request;
        $pemohon = $user->find($request['idPemohon']);
        $pemohon->update([
            'valid_nama_hukum' => $request['status_hukum']
        ]);
        return redirect()->back()->with('success', 'Update Pemohon Berhasil !!!');
    }
    public function settingPenjabat(PenjabatBlokir $penjabatBlokir)
    {
        # code...
        // return 'penjabat'
        $penjabat = $penjabatBlokir->find(1);
        return view('officers.officerSettingPenjabat',['penjabat'=>$penjabat]);
    }
    public function updatePenjabat(Request $request,PenjabatBlokir $penjabatBlokir)
    {
        # code...
        // return $request;
        $penjabatBlokir->find(1)->update([
            'kepala_kantor'                                 => $request['kepalaKantor'],
            'nip_kepala_kantor'                             => $request['nipKepalaKantor'],
            'kepala_sub_penanganan_masalah_pertanahan'      => $request['kepala_seksi_penanganan_masalah'],
            'nip_kepala_sub_penanganan_masalah_pertanahan'  => $request['nip_kepala_seksi_penanganan_masalah'],
            'calon_analis_sengketa'                         => $request['calon_analis_sengketa_pertanahan'],
            'nip_calon_analisis_sengketa'                   => $request['nip_calon_analis_sengketa_pertanahan'],
        ]);
        return redirect()->back()->with('success', 'Update Penjabat Berhasil !!!');
    }
}
