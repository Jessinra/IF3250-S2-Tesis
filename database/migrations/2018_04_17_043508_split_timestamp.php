<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SplitTimestamp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seminar_teses', function (Blueprint $table) {
            //
            $table->dropColumn('jadwal');
            $table->date('hari')->nullable();
            $table->time('waktu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seminar_teses', function (Blueprint $table) {
            //
            $table->timestamp('jadwal')->nullable();
            $table->dropColumn('hari');
            $table->dropColumn('waktu');

        });
    }
}
