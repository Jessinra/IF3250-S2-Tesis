<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditSidangTesis2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sidang_tesis', function (Blueprint $table) {
            //
            $table->integer('ajuan_penguji1')->nullable();
            $table->integer('ajuan_penguji2')->nullable();
            $table->integer('ajuan_penguji3')->nullable();
            $table->boolean('approval_penguji1')->nullable();
            $table->boolean('approval_penguji2')->nullable();
            $table->boolean('approval_penguji3')->nullable();
            $table->string('semester_terdaftar')->nullable();
            $table->string('evaluasi_diri')->nullable();
            $table->string('draft_makalah')->nullable();
            $table->string('laporan_tesis')->nullable();
            $table->string('ksm_terakhir')->nullable();
            $table->string('submit_paper')->nullable();

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
            //
            $table->dropColumn('ajuan_penguji1');
            $table->dropColumn('ajuan_penguji2');
            $table->dropColumn('ajuan_penguji3');
            $table->dropColumn('approval_penguji1');
            $table->dropColumn('approval_penguji2');
            $table->dropColumn('approval_penguji3');
            $table->dropColumn('semester_terdaftar');
            $table->dropColumn('evaluasi_diri');
            $table->dropColumn('draft_makalah');
            $table->dropColumn('laporan_tesis');
            $table->dropColumn('ksm_terakhir');
            $table->dropColumn('submit_paper');
        });
    }
}
