<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trocas_de_oleo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_veiculo')
                ->constrained('veiculos')
                ->onDelete('cascade');
            $table->foreignId('tipo_de_oleo_id')
                ->constrained('tipos_de_oleo')
                ->onDelete('cascade');
            $table->date('data_troca');
            $table->integer('quilometragem');
            $table->decimal('valor', 10, 2)->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trocas_de_oleo');
    }
};
