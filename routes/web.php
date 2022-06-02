<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route
Route::get('/get3plus','Check\SchedulerCheck@showData3Day');
Route::get('/cium', function(){
    // $targetFolder = $_SERVER['DOCUMENT_ROOT'].'apps/storage/app/public';
    // $linkFolder = $_SERVER['DOCUMENT_ROOT'].'apps/public/storage';
    // symlink($targetFolder,$linkFolder);
    echo $_SERVER['DOCUMENT_ROOT'];
    // echo 'Symlink process successfully completed';
});
Auth::routes(['verify' => true]);
// Route::middleware('auth','verified')->group(function (){
Route::middleware('auth')->group(function (){
    Route::get('/home', function (){
        if (auth()->user()->hasRole('petugas'))
        {
            return redirect(route('officerIndex'));
        }else{
            return redirect(route('appsIndex'));
        }
    })->name('home');
    Route::get('/apps','Apps\AppsController@index')->name('appsIndex');
    Route::get('/apps/pengajuan/blokir','Apps\AppsController@pengajuanBlokir')->name('apps.blokir');
    Route::post('/apps/pengajuan/blokir','Apps\AppsController@storePengajuanBlokir')->name('apps.storeblokir');
    Route::get('/apps/riwayat/blokir','Apps\AppsController@riwayatBlokir')->name('apps.riwayatblokir');
    Route::get('/apps/riwayat/blokir/{pengajuan_blokir_id}','Apps\AppsController@riwayatDetailBlokir')->name('apps.riwayatblokir.detail');
    Route::get('/apps/riwayat/blokir/{pengajuan_blokir_id}/edit','Apps\AppsController@editDetailBlokir')->name('apps.riwayatblokir.edit');
    // Update data dokumen
    Route::post('/apps/riwayat/blokirdokumen/updatektp','Apps\AppsController@updateKTP')->name('apps.riwayatblokir.updatektp');
    Route::post('/apps/riwayat/blokirdokumen/updatekk','Apps\AppsController@updateKK')->name('apps.riwayatblokir.updatekk');
    Route::post('/apps/riwayat/blokirdokumen/updateshm','Apps\AppsController@updateSHM')->name('apps.riwayatblokir.updateshm');
    Route::post('/apps/riwayat/blokirdokumen/updatesuratkuasa','Apps\AppsController@updateSuratKuasa')->name('apps.riwayatblokir.updatesuratkuasa');
    Route::post('/apps/riwayat/blokirdokumen/updatepermohonan','Apps\AppsController@updateSuratPermohonan')->name('apps.riwayatblokir.updatesuratpermohonan');
    Route::post('/apps/riwayat/blokirdokumen/updatehubunganhukum','Apps\AppsController@updateHubunganHukum')->name('apps.riwayatblokir.updatesurathubunganhukum');
    // Update data dokumen
    Route::post('/apps/riwayat/blokirtiketloket','Apps\AppsController@nomerTiketLoket')->name('apps.riwayatblokir.tiketLoket');
    Route::get('/apps/profile','Apps\ProfileController@index')->name('apps.profile');
    Route::post('/apps/profile/update','Apps\ProfileController@updateProfile')->name('apps.updateProfile');
    Route::post('/apps/profile/update/password','Apps\ProfileController@updatePassword')->name('apps.updatePassword');

    // Petugas Route
    Route::get('/officer','Officer\OfficerController@index')->name('officerIndex');
    Route::get('/officer/riwayatblokir','Officer\OfficerController@riwayatBlokir')->name('officer.riwayatblokir');
    Route::get('/officer/riwayatblokir3day','Officer\OfficerController@riwayatBlokir3day')->name('officer.riwayatblokir3day');
    Route::get('/officer/riwayatblokir/pengkajian/blokir/{pengajuan_blokir_id}','Officer\OfficerController@pengkajianBlokir')->name('officer.pengkajianblokir');
    Route::post('/officer/riwayatblokir/pengkajian/uploadpnbp','Officer\OfficerController@petugasUploadpnbp')->name('officer.petugasUploadPnbp');
    Route::post('/officer/riwayatblokir/pengkajian/berkas/ktp','Officer\OfficerController@berkasKTP')->name('officer.berkasKTP');
    Route::post('/officer/riwayatblokir/pengkajian/berkas/kk','Officer\OfficerController@berkasKK')->name('officer.berkasKK');
    Route::post('/officer/riwayatblokir/pengkajian/berkas/shm','Officer\OfficerController@berkasSHM')->name('officer.berkasSHM');
    Route::post('/officer/riwayatblokir/pengkajian/berkas/suratkuasa','Officer\OfficerController@berkasSuratKuasa')->name('officer.berkasSuratKuasa');
    Route::post('/officer/riwayatblokir/pengkajian/berkas/suratpermohonan','Officer\OfficerController@berkasSuratPermohonan')->name('officer.berkasSuratPermohonan');
    Route::post('/officer/riwayatblokir/pengkajian/berkas/surathubunganhukum','Officer\OfficerController@berkasSuratHubunganHukum')->name('officer.berkasSuratHubunganHukum');
    Route::post('/officer/riwayatblokir/pengkajian/klarifikasi/dokumen/blokir','Officer\OfficerController@klarifikasiDokumen')->name('officer.klarifikasiDokumenBlokir');
    Route::post('/officer/riwayatblokir/pengkajian/klarifikasi/dokumen/tidakvalid','Officer\OfficerController@dokumenTidakValid')->name('officer.dokumenTidakValid');
    Route::post('/officer/riwayatblokir/pengkajian/klarifikasi/pnpb/cek','Officer\OfficerController@cekPNPB')->name('officer.cekPNPB');
    Route::post('/officer/riwayatblokir/pengkajian/keterangandokumen','Officer\OfficerController@storeKeteranganDokumen')->name('officer.keteranganDokumen');
    Route::post('/officer/riwayatblokir/pengkajian/hasilkajian','Officer\OfficerController@storeHasilKajian')->name('officer.hasilKajian');
    Route::post('/officer/riwayatblokir/pengkajian/cetakhasilkajian','Officer\OfficerController@generateHasilKajian')->name('officer.generateHasilKajian');
    Route::get('/officer/riwayatblokir/pengkajian/hasilkajian/{pengajuan_blokir_id}','Officer\OfficerController@printHasilKajian')->name('officer.printHasilKajian');
    Route::post('/officer/riwayatblokir/pengkajian/upload/hasilkajian','Officer\OfficerController@uploadHasilKajian')->name('officer.uploadHasilKajian');

    Route::post('/officer/riwayatblokir/carishm','Officer\OfficerController@cariSHMDataBlokir')->name('officer.cariDataSHMBlokir');
    Route::get('/officer/report/blokir','Officer\OfficerController@reportBlokir')->name('officer.reportBlokir');
    Route::post('/officer/report/blokir','Officer\OfficerController@generateReportBlokir')->name('officer.generateReportBlokir');
    Route::post('/officer/report/blokir/download','Officer\OfficerController@downloadReport')->name('officer.downloadReportBlokir');
    //setting
    Route::get('/officer/setting/petugas','Officer\OfficerController@settingPetugas')->name('officer.settingPetugas');
    Route::post('/officer/setting/petugas/add','Officer\OfficerController@storePetugas')->name('officer.storePetugas');
    Route::post('/officer/setting/petugas/update','Officer\OfficerController@updatePetugas')->name('officer.updatePetugas');

    Route::get('/officer/setting/pemohon','Officer\OfficerController@settingPemohon')->name('officer.settingPemohon');
    Route::post('/officer/setting/pemohon/updatevalidhukum','Officer\OfficerController@updatevalidhukum')->name('officer.updatevalidhukum');
    Route::get('/officer/setting/penjabat','Officer\OfficerController@settingPenjabat')->name('officer.settingPenjabat');
    Route::post('/officer/setting/penjabat','Officer\OfficerController@updatePenjabat')->name('officer.updatePenjabat');

});

