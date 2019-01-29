<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTopikToThesis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thesis', function (Blueprint $table) {
            $table->string('topic');
            $table->integer('status')->default(0);
            $table->string('keilmuan')->nullable();
            $table->string('opsi')->nullable();
            $table->integer('creator');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thesis', function (Blueprint $table) {
            //
            $table->dropColumn('topic');
            $table->dropColumn('status');
            $table->dropColumn('keilmuan');
            $table->dropColumn('opsi');
            $table->dropColumn('creator');
        });
    }
}
