<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recetas', function (Blueprint $table) {
    $table->id();

    $table->date('fecha');

    // Relaciones
    $table->foreignId('medico_id')
          ->constrained('medicos')
          ->onDelete('cascade');

    $table->foreignId('paciente_id')
          ->constrained('pacientes')
          ->onDelete('cascade');

    $table->foreignId('medicamento_id')
          ->constrained('medicamentos')
          ->onDelete('cascade');

    // Datos propios de la receta
    $table->string('dosis'); 
    $table->text('indicaciones')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receta');
    }
};
