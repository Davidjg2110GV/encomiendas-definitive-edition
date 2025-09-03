<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'encomienda_id',
        'tipo',
        'descripcion',
        'fecha_incidencia', // Asegúrate de que este nombre coincida con tu migración
        'estado',
    ];

    // Castear la fecha a un objeto Carbon para facilitar su manejo
    protected $casts = [
        'fecha_incidencia' => 'datetime',
    ];

    /**
     * Get the encomienda that owns the incidencia.
     */
    public function encomienda()
    {
        return $this->belongsTo(Encomienda::class);
    }

    /**
     * Check if the incidence is resolved.
     */
    public function isResuelta(): bool
    {
        return $this->estado === 'resuelta';
    }
}