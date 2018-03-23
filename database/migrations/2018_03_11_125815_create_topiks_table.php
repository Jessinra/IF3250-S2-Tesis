<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mahasiswa_id');
            $table->integer('status')->default(0);
            $table->unsignedInteger('prioritas');
            $table->string('judul');
            $table->string('keilmuan');
            $table->unsignedInteger('calon_pembimbing1');
            $table->unsignedInteger('calon_pembimbing2')->nullable();
            $table->integer("editor")->nullable();
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
        Schema::dropIfExists('topiks');
    }
}
