<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Model\HasilKajianBlokir;
use App\Model\NoteDokumenLampiran;
use App\Model\PengajuanBlokir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class OfficerController extends Controller
{
    //
    public function index()
    {
        # code...
        // return 'index';
        return view('officers.officerIndex');
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
    public function printHasilKajian($pengajuan_blokir_id,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        // return $request;
        $blokir = $pengajuanBlokir->detailBlokir($pengajuan_blokir_id);
        return view('officers.suratHasilKajian',['blokir'=>$blokir]);
    }
    public function uploadHasilKajian(Request $request,PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        return $request;
    }
    public function reportBlokir(PengajuanBlokir $pengajuanBlokir)
    {
        # code...
        return $pengajuanBlokir;
    }
}
