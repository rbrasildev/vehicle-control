<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();  // Identificador único do veículo
            $table->string('placa')->unique();  // Placa do veículo
            $table->string('marca');  // Marca do veículo
            $table->string('modelo');  // Modelo do veículo
            $table->string('ano');  // Ano de fabricação
            $table->string('chassi')->unique();  // Número do chassi
            $table->timestamps();  // Campos created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('veiculos');
    }
};
