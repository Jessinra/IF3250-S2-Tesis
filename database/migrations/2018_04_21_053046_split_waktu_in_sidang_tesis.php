<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SplitWaktuInSidangTesis extends Migration
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
            $table->dropColumn('waktu');
            $table->date('tanggal');
            $table->time('jam');
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
            $table->dropColumn('tanggal');
            $table->dropColumn('jam');
            $table->timestamp('waktu');

        });
    }
}
