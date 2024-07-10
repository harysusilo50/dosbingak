<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToKonsultasiBimbinganAkademiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('konsultasi_bimbingan_akademiks', function (Blueprint $table) {
            $table->integer('user_id')->after('bimbingan_akademik_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('konsultasi_bimbingan_akademiks', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
