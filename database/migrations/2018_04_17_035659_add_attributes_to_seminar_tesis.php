<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributesToSeminarTesis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seminar_teses', function (Blueprint $table) {
            $table->integer('tesis_id');
            $table->timestamp('jadwal')->nullable();
            $table->string('tempat')->nullable();
            $table->integer('issuer_id');
            $table->boolean('approval_pembimbing1')->default(false);
            $table->boolean('approval_pembimbing2')->default(false);
            $table->boolean('verdict')->nullable();
            $table->integer('evaluator_id')->nullable();
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
            $table->dropColumn('tesis_id');
            $table->dropColumn('jadwal');
            $table->dropColumn('tempat');
            $table->dropColumn('issuer_id');
            $table->dropColumn('approval_pembimbing1');
            $table->dropColumn('approval_pembimbing2');
            $table->dropColumn('verdict')->nullable();
            $table->dropColumn('evaluator_id');
        });
    }
}
