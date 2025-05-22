<?php

use Illuminate\Database\Migrations\Migration; 
use Illuminate\Database\Schema\Blueprint; 
use Illuminate\Support\Facades\Schema; 

class CreateNilaiTable extends Migration 
{ 
    public function up() 
    { 
        Schema::create('nilai', function (Blueprint $table) { 
            $table->id(); 
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa'); 
            $table->foreignId('matakuliah_id')->constrained('matakuliah'); 
            $table->integer('nilai'); 
            $table->timestamps(); 
        }); 
    } 

    public function down() 
    { 
        Schema::dropIfExists('nilai'); 
    } 
}
