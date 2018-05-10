<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDosenPengujiPembimbing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seminar_proposals', function (Blueprint $table) {
            //
            $table->integer('id_dosen_pembimbing_1')->nullable();
            $table->integer('id_dosen_pembimbing_2')->nullable();
            $table->integer('id_dosen_penguji')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seminar_proposals', function (Blueprint $table) {
            //
            $table->dropColumn('id_dosen_pembimbing_1');
            $table->dropColumn('id_dosen_pembimbing_2');
            $table->dropColumn('id_dosen_penguji');

        });
    }
}
