<?php

use Illuminate\Database\Migrations\Migration; 
use Illuminate\Database\Schema\Blueprint; 
use Illuminate\Support\Facades\Schema; 

class CreateMatakuliahTable extends Migration 
{ 
    public function up() 
    { 
        Schema::create('matakuliah', function (Blueprint $table) { 
            $table->id(); 
            $table->string('kode'); 
            $table->string('nama'); 
            $table->integer('sks'); 
            $table->timestamps(); 
        }); 
    } 

    public function down() 
    { 
        Schema::dropIfExists('matakuliah'); 
    } 
}
