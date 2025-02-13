<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToValidasiKrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('validasi_krs', function (Blueprint $table) {
            $table->text('file_surat')->after('status')->nullable();
            $table->text('keterangan_surat')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('validasi_krs', function (Blueprint $table) {
            $table->dropColumn('file_surat');
            $table->dropColumn('keterangan_surat');
        });
    }
}
