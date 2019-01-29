<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProgressDateColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->timestamp('t_topik1')->nullable();
            $table->timestamp('t_topik2')->nullable();
            $table->timestamp('t_topik3')->nullable();
            $table->timestamp('t_topik4')->nullable();
            $table->timestamp('t_proposal1')->nullable();
            $table->timestamp('t_proposal2')->nullable();
            $table->timestamp('t_proposal3')->nullable();
            $table->timestamp('t_proposal4')->nullable();
            $table->timestamp('t_seminar1')->nullable();
            $table->timestamp('t_seminar2')->nullable();
            $table->timestamp('t_sidang')->nullable();
            $table->timestamp('t_lulus')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->dropColumn('t_topik1');
            $table->dropColumn('t_topik2');
            $table->dropColumn('t_topik3');
            $table->dropColumn('t_topik4');
            $table->dropColumn('t_proposal1');
            $table->dropColumn('t_proposal2');
            $table->dropColumn('t_proposal3');
            $table->dropColumn('t_proposal4');
            $table->dropColumn('t_seminar1');
            $table->dropColumn('t_seminar2');
            $table->dropColumn('t_sidang');
            $table->dropColumn('t_lulus');
        });
    }
}
