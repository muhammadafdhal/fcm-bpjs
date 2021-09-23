<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil', function (Blueprint $table) {
            $table->bigIncrements('hasil_id');
            $table->integer('hasil_jumlah_cluster');
            $table->integer('hasil_iterasi');
            $table->double('hasil_error_terkecil');
            $table->longText('hasil_cluster_hitung');
            $table->longText('hasil_L');
            $table->longText('hasil_LT');
            $table->longText('hasil_cluster');
            $table->longText('hasil_fungsi_objektif');
            $table->longText('hasil_error');
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
        Schema::dropIfExists('hasil');
    }
}
