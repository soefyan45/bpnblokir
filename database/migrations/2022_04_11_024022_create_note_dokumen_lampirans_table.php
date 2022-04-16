<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteDokumenLampiransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_dokumen_lampirans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->comment('di ketik oleh');
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('pengajuan_blokir_id')->unsigned()->comment('dokumen milik pengajuan blokir');
            $table->foreign('pengajuan_blokir_id')->references('id')->on('pengajuan_blokirs');
            $table->string('detail_dokumen')->nullable();
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
        Schema::dropIfExists('note_dokumen_lampirans');
    }
}
