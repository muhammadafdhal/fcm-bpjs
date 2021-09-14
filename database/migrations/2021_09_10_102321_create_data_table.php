<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->bigIncrements('data_id');
            $table->string('data_nama');
            $table->string('data_nik');
            $table->string('data_hp');
            $table->string('data_alamat');
            $table->enum('data_tinggal', ['kontrak','rumah sendiri']);
            $table->Integer('data_jml_keluarga');
            $table->enum('data_pekerjaan', ['buruh','pedagang','karyawan','guru','pegawai swasta','pegawai']);
            $table->bigInteger('data_penghasilan');
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
        Schema::dropIfExists('data');
    }
}
