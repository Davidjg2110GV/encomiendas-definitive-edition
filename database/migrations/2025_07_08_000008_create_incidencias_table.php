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
     Schema::create('incidencias', function (Blueprint $table) {
    $table->id();
    $table->foreignId('encomienda_id')->constrained()->onDelete('cascade');
    $table->enum('tipo', ['retraso', 'daño', 'extravio', 'otro']);
    $table->text('descripcion');
    $table->timestamp('fecha_incidencia');
    $table->enum('estado', ['pendiente', 'resuelta'])->default('pendiente');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidencias');
    }
};
