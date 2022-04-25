<?php

namespace App\Exports;

use App\Model\PengajuanBlokir;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BlokirReportExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return PengajuanBlokir::all();
        return PengajuanBlokir::select(
            'tiket',
            'namaPemohon',
            'alamatPemohon',
            'pekerjaanPemohon',
            'nomorKTP',
            'statusPemohon',
            'nomor_notaDinas',
            'tanggal_notaDinas',
            'nomorSHM',
            'anSHM',
            'SUnomor',
            'tanggalSHM',
            'luasSHM',
            'kecamatan',
            'desa',
            'tanggalBayarPNPB',
            'statusPengkajian',
            )->get();
    }
    public function headings(): array
    {
        //Put Here Header Name That you want in your excel sheet
        return [
            'Tiket',
            'Pemohon',
            'Alamat Pemohon',
            'Pekerjaan Pemohon',
            'No KTP',
            'Jenis Pemohon',
            'Nota Dinas',
            'Tanggal Nota Dinas',
            'No SHM',
            'AN SHM',
            'SU Nomor',
            'Tanggal SHM',
            'Luas SHM',
            'Kecamatan SHM',
            'Desa SHM',
            'Tanggal Bayar PNPB',
            'Status',
        ];
    }
}
