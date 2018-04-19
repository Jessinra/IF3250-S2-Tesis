<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultValueSeminarTesis extends Migration
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
            $table->dropColumn('draft_laporan');
            $table->dropColumn('seminar_dengan_teman');
            $table->string('draft_laporan')->nullable();
            $table->string('seminar_dengan_teman')->nullable();
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
        });
    }
}
