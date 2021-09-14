<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataset', function (Blueprint $table) {
            $table->bigIncrements('dataset_id');
            $table->integer('dataset_data_id');
            $table->integer('dataset_x1');
            $table->integer('dataset_x2');
            $table->integer('dataset_x3');
            $table->integer('dataset_x4');
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
        Schema::dropIfExists('dataset');
    }
}
