<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSidangTesis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sidang_tesis', function (Blueprint $table) {
            $table->unsignedinteger('thesis_id');
            $table->dropColumn('mahasiswa_id');
            $table->dropColumn('dosen_pembimbing1');
            $table->dropColumn('dosen_pembimbing2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('thesis_id');
        $table->unsignedInteger('mahasiswa_id');
        $table->unsignedInteger('dosen_pembimbing1');
        $table->unsignedInteger('dosen_pembimbing2');
    }
}
