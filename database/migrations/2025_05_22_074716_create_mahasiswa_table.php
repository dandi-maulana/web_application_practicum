<?php

use Illuminate\Database\Migrations\Migration; 
use Illuminate\Database\Schema\Blueprint; 
use Illuminate\Support\Facades\Schema; 

class CreateMahasiswaTable extends Migration 
{ 
    public function up() 
    { 
        Schema::create('mahasiswa', function (Blueprint $table) { 
            $table->id(); 
            $table->string('nama'); 
            $table->string('nim'); 
            $table->string('alamat')->nullable(); 
            $table->timestamps(); 
        }); 
    } 

    public function down() 
    { 
        Schema::dropIfExists('mahasiswa'); 
    } 
}
