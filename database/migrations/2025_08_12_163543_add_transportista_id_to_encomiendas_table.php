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
        Schema::table('encomiendas', function (Blueprint $table) {
            // Añadimos la columna para el ID del transportista.
            // La hacemos 'nullable' por si una encomienda aún no ha sido asignada.
            // La ponemos después de la columna 'remitente_id' por orden (opcional).
            $table->unsignedBigInteger('transportista_id')->nullable()->after('remitente_id');

            // Creamos la clave foránea para asegurar la integridad de los datos.
            // Se relaciona con la tabla 'users'.
            // Si un usuario transportista es eliminado, el campo 'transportista_id' en la encomienda se pondrá a NULL.
            $table->foreign('transportista_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('encomiendas', function (Blueprint $table) {
            // Para poder eliminar la columna, primero hay que eliminar la clave foránea.
            $table->dropForeign(['transportista_id']);
            
            // Ahora sí, eliminamos la columna.
            $table->dropColumn('transportista_id');
        });
    }
};