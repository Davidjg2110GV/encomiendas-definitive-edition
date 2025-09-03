<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('encomiendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('remitente_id')->constrained('users')->onDelete('cascade');
            $table->string('destinatario', 100);
            $table->string('numero_seguimiento', 25)->unique();
            $table->enum('estado', ['pendiente', 'en_proceso', 'en_transito', 'entregado', 'incidencia'])->default('pendiente');
            $table->decimal('peso', 8, 2);
            $table->enum('tipo', ['documento', 'paquete', 'caja', 'sobre', 'otro']);
            $table->text('descripcion')->nullable();
            $table->text('direccion_destino');
            $table->string('telefono_destinatario', 20);
            $table->decimal('costo', 10, 2)->nullable();
            $table->dateTime('fecha_envio')->nullable();
            $table->date('fecha_entrega_estimada')->nullable();
            $table->dateTime('fecha_entrega_real')->nullable(); // Nuevo campo añadido
            $table->string('documento_receptor', 20)->nullable(); // Nuevo campo
            $table->text('firma_digital')->nullable(); // Nuevo campo
            $table->timestamps();
            
            // Índices para mejorar rendimiento
            $table->index('estado');
            $table->index('fecha_entrega_estimada');
        });
    }

    public function down()
    {
        Schema::dropIfExists('encomiendas');
    }
};