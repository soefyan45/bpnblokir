<?php

namespace App\Http\Controllers\Check;

use App\Http\Controllers\Controller;
use App\Mail\MailInfo;
use App\Model\PengajuanBlokir;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SchedulerCheck extends Controller
{
    //
    public function showData3Day(PengajuanBlokir $blokir)
    {
        # code...
        $blokir = $blokir->riwayatCheck();
        // return $blokir->count();
        if($blokir->count()!=0){
            $data = array(
                'name'      => 'BPN KAMPAR',
                'body'      => 'Warning Pengkajian Blokir Yang Belum Di Selesaikan & Sudah Lebih 3 Hari Dari Pembayaran PNBP Di Konfirmasi',
                'cta_link'  => route('officer.riwayatblokir3day'),
                'cta_title' => 'Detail',
                'subject'   => 'Warning Pengkajian Blokir +3hari'
            );
            Mail::to('soefyan45@gmail.com')->send(new MailInfo($data));
        }
    }
}
