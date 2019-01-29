<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableSeminar extends Migration
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
            $table->boolean('draft_laporan')->nullable();
            $table->boolean('sidang_dengan_teman')->nullable();
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
