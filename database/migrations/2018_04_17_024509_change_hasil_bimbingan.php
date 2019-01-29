<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeHasilBimbingan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_bimbingans', function (Blueprint $table) {
            $table->unsignedInteger('dosen_id2')->nullable();
            $table->dateTime('waktu_bimbingan_selanjutnya')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hasil_bimbingans', function (Blueprint $table) {
            //
            $table->dropColumn('dosen_id2');
            $table->dropColumn('waktu_bimbingan_selanjutnya');
        });
    }
}
