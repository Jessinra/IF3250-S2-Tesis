<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeminarProposal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminar_proposals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mahasiswa_id');
            $table->timestamp('schedule');
            $table->boolean('passed')->nullable();
            $table->integer('creator_id');
            $table->integer('evaluator_id')->nullable();
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
        Schema::dropIfExists('seminar_proposals');
    }
}
