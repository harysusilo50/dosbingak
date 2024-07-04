<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonsultasiBimbinganAkademiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsultasi_bimbingan_akademiks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bimbingan_akademik_id');
            $table->foreign('bimbingan_akademik_id')->references('id')->on('bimbingan_akademiks')->onDelete('cascade');
            $table->longText('pesan');
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
        Schema::dropIfExists('konsultasi_bimbingan_akademiks');
    }
}
