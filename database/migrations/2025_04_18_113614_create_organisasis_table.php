<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisasisTable extends Migration
{
    public function up()
    {
        Schema::create('organisasis', function (Blueprint $table) {
            $table->string('ID_ORGANISASI', 10);
            $table->string('NAMA', 50)->nullable();
            $table->string('ALAMAT', 50)->nullable();
            $table->string('TELEPON', 20)->nullable();
            $table->string('DESKRIPSI', 250)->nullable();
            $table->string('EMAIL', 250)->nullable();
            $table->string('PASSWORD', 250)->nullable();
            $table->enum('STATUS', ['active', 'inactive'])->nullable();
            $table->string('FOTO_ORGANISASI', 250)->nullable();
            $table->primary('ID_ORGANISASI');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('organisasis');
    }
}