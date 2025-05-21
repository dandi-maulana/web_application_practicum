<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('kota_id');
            $table->timestamps();
            
            $table->foreign('kota_id')
                  ->references('id')
                  ->on('kota')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kecamatan');
    }
};