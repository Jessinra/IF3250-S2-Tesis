<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHasilBimbingansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_bimbingans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mahasiswa_id');
            $table->unsignedInteger('dosen_id');
            $table->integer('status')->default(0);
            $table->dateTime('tanggal_waktu');
            $table->string('topik');
            $table->longText('hasil_dan_diskusi');
            $table->longText('rencana_tindak_lanjut');

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
        Schema::dropIfExists('hasil_bimbingans');
    }
}
