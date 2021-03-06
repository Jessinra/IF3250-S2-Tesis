<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSidangTesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sidang_tesis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mahasiswa_id');
            $table->unsignedInteger('dosen_pembimbing1')->nullable();
            $table->unsignedInteger('dosen_pembimbing2')->nullable();
            $table->unsignedInteger('dosen_penguji')->nullable();
            $table->timestamp('waktu' )->nullable();
            $table->char('nilai')->nullable();
            $table->string('tempat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sidang_tesis');
    }
}
