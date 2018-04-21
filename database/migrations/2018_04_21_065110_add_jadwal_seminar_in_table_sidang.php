<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJadwalSeminarInTableSidang extends Migration
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
            $table->timestamp('jadwal_seminar')->nullable();
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
            $table->dropColumn('jadwal_seminar');
        });
    }
}
