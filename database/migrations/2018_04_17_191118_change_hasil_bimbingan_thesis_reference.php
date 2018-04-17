<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeHasilBimbinganThesisReference extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_bimbingans', function (Blueprint $table) {
            $table->unsignedInteger('thesis_id');
            $table->dropColumn('mahasiswa_id');
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
            $table->dropColumn('thesis_id');
            $table->unsignedInteger('mahasiswa_id');
        });
    }
}
