<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanBlokirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_blokirs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->comment('pengajuan di input oleh');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nomor_notaDinas')->nullable()->comment('di input oleh petugas');
            $table->string('foto_notaDinas')->nullable()->comment('di input oleh petugas');
            $table->enum('statusPemohon',['Perorangan','Badan Hukum','Penegak Hukum'])->nullable();
            $table->enum('statusPengkajian',[
                'Verifikasi Dokumen',
                'Dokumen di Tolak',
                'Klarifikasi',
                'Pengkajian Blokir',
                'Selesai',
                ])->default('Verifikasi Dokumen');
            $table->string('namaPemohon');
            $table->string('nomorKTP');
            $table->string('fotoKTP');
            $table->enum('status_KTP',[
                'Proses Validasi',
                'Valid',
                'Dokumen di Tolak',
                ])->default('Proses Validasi');
            $table->string('fotoKK');
            $table->enum('status_KK',[
                'Proses Validasi',
                'Valid',
                'Dokumen di Tolak',
                ])->default('Proses Validasi');
            $table->string('nomorSHM');
            $table->string('fotoSHM');
            $table->enum('status_SHM',[
                'Proses Validasi',
                'Valid',
                'Dokumen di Tolak',
                ])->default('Proses Validasi');
            $table->string('kecamatan');
            $table->string('desa');
            $table->enum('status_desa',[
                'Proses Validasi',
                'Valid',
                'Dokumen di Tolak',
                ])->default('Proses Validasi');
            $table->string('suratKuasa');
            $table->enum('status_suratKuasa',[
                'Proses Validasi',
                'Valid',
                'Dokumen di Tolak',
                ])->default('Proses Validasi');
            $table->string('suratPermohonan');
            $table->enum('status_suratPermohonan',[
                'Proses Validasi',
                'Valid',
                'Dokumen di Tolak',
                ])->default('Proses Validasi');
            $table->string('suratHubunganHukum');
            $table->enum('status_suratHubunganHukum',[
                'Proses Validasi',
                'Valid',
                'Dokumen di Tolak',
                ])->default('Proses Validasi');
            $table->string('catatan')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan_blokirs');
    }
}
