<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDosenScore extends Migration
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
            $table->char('mark_dosen_pembimbing')->nullable();
            $table->char('mark_dosen_penguji')->nullable();

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
            $table->dropColumn('mark_dosen_pembimbing');
            $table->dropColumn('mark_dosen_penguji');
        });
    }
}
