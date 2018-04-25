<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableAttributeSidang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sidang_tesis', function($table) {
            $table->date('tanggal')->nullable()->change();
            $table->time('jam')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sidang_tesis', function($table) {
            $table->date('tanggal')->nullable(false)->change();
            $table->time('jam')->nullable(false)->change();
        });
    }
}
