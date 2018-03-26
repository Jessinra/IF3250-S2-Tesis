<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProposalAddPath extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proposals', function (Blueprint $table) {
            //
            $table->integer("mahasiswa_id");
            $table->string("path");
            $table->string("filename");
            $table->integer("filesize");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proposals', function (Blueprint $table) {
            //
            $table->dropColumn("mahasiswa_id");
            $table->dropColumn("path");
            $table->dropColumn("filename");
            $table->dropColumn("filesize");
        });
    }
}
