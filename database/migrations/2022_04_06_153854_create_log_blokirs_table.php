<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogBlokirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_blokirs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->comment('di proses oleh');
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('pengajuan_blokir_id')->unsigned()->comment('transaksi di handle oleh');
            $table->foreign('pengajuan_blokir_id')->references('id')->on('pengajuan_blokirs');
            $table->enum('statusPengkajian',[
                'Verifikasi Dokumen',
                'Dokumen di Tolak',
                'Klarifikasi',
                'Pengkajian Blokir',
                'Selesai',
                ])->nullable();
            $table->string('keterangan')->nullable();
            $table->string('file_surat')->nullable();
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
        Schema::dropIfExists('log_blokirs');
    }
}
