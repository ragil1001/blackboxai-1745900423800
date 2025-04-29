<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlamatsTable extends Migration
{
    public function up()
    {
        Schema::create('alamats', function (Blueprint $table) {
            $table->increments('ID_ALAMAT');
            $table->unsignedInteger('ID_PEMBELI');
            $table->string('JALAN', 50)->nullable();
            $table->string('KECAMATAN', 50)->nullable();
            $table->string('KOTA', 50)->nullable();
            $table->string('KODE_POS', 50)->nullable();
            $table->boolean('ALAMAT_UTAMA')->nullable();
            $table->foreign('ID_PEMBELI')->references('ID_PEMBELI')->on('pembelis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alamats');
    }
}