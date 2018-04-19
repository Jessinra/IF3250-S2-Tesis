<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAtributeToSidangTesis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        Schema::table('sidang_tesis', function (Blueprint $table) {

                $table->dropColumn('dosen_penguji');
                $table->unsignedInteger('dosen_penguji_1');
                $table->unsignedInteger('dosen_penguji_2');
                $table->char('nilai_dosen_pembimbing_utama');
                $table->char('nilai_dosen_pembimbing_penting');
                $table->char('nilai_dosen_pembimbing_pendukung');
                $table->char('nilai_dosen_penguji_1_utama');
                $table->char('nilai_dosen_penguji_1_penting');
                $table->char('nilai_dosen_penguji_1_pendukung');
                $table->char('nilai_dosen_penguji_2_utama');
                $table->char('nilai_dosen_penguji_2_penting');
                $table->char('nilai_dosen_penguji_2_pendukung');
                $table->char('nilai_dosen_kelas_utama');
                $table->char('nilai_dosen_kelas_penting');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sidang_tesis', function (Blueprint $table) {

            $table->unsignedInteger('dosen_penguji');
            $table->dropColumn('dosen_penguji_1');
            $table->dropColumn('dosen_penguji_2');
            $table->dropColumn('nilai_dosen_pembimbing_utama');
            $table->dropColumn('nilai_dosen_pembimbing_penting');
            $table->dropColumn('nilai_dosen_pembimbing_pendukung');
            $table->dropColumn('nilai_dosen_penguji_1_utama');
            $table->dropColumn('nilai_dosen_penguji_1_penting');
            $table->dropColumn('nilai_dosen_penguji_1_pendukung');
            $table->dropColumn('nilai_dosen_penguji_2_utama');
            $table->dropColumn('nilai_dosen_penguji_2_penting');
            $table->dropColumn('nilai_dosen_penguji_2_pendukung');
            $table->dropColumn('nilai_dosen_kelas_utama');
            $table->dropColumn('nilai_dosen_kelas_penting');
        });
    }
}
