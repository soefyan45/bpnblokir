<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjabatBlokirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjabat_blokirs', function (Blueprint $table) {
            $table->id();
            $table->string('kepala_kantor');
            $table->string('kepala_sub_penanganan_masalah_pertanahan');
            $table->string('calon_analis_sengketa');
            
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
        Schema::dropIfExists('penjabat_blokirs');
    }
}
