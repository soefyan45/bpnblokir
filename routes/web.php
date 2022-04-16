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
Auth::routes(['verify' => true]);
// Route::middleware('auth','verified')->group(function (){
Route::middleware('auth')->group(function (){
    Route::get('/home', 'HomeController@index')->name('home');
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

    // Petugas Route
    Route::get('/officer','Officer\OfficerController@index')->name('officerIndex');
    Route::get('/officer/riwayatblokir','Officer\OfficerController@riwayatBlokir')->name('officer.riwayatblokir');
    Route::get('/officer/riwayatblokir/pengkajian/blokir/{pengajuan_blokir_id}','Officer\OfficerController@pengkajianBlokir')->name('officer.pengkajianblokir');
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

    Route::get('/officer/report/blokir','Officer\OfficerController@reportBlokir')->name('officer.reportBlokir');
});

