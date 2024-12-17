<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('tipos_de_oleo', function (Blueprint $table) {
            $table->id();
            $table->string('nome'); 
            $table->string('viscosidade')->nullable(); 
            $table->string('fabricante')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_de_oleo');
    }
};
