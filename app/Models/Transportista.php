<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportista extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'contacto',
        'user_id', // Relación con el usuario
        'vehiculo',
        'capacidad_carga', // en kg
        'disponible',
        'fecha_ultima_revision',
    ];

    /**
     * Los atributos que deberían ser casteados.
     *
     * @var array
     */
    protected $casts = [
        'disponible' => 'boolean',
        'fecha_ultima_revision' => 'date',
    ];

    /**
     * Obtener el usuario asociado al transportista.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener las rutas asignadas al transportista.
     */
    public function rutas()
    {
        return $this->belongsToMany(Ruta::class, 'encomienda_ruta_transportista')
                    ->withPivot('encomienda_id', 'fecha_asignacion', 'estado')
                    ->withTimestamps();
    }

    /**
     * Obtener las encomiendas asignadas al transportista.
     */
    public function encomiendas()
    {
        return $this->belongsToMany(Encomienda::class, 'encomienda_ruta_transportista')
                    ->withPivot('ruta_id', 'fecha_asignacion', 'estado')
                    ->withTimestamps();
    }

    /**
     * Obtener las entregas realizadas por el transportista.
     */
    public function entregas()
    {
        return $this->hasManyThrough(
            Entrega::class,
            Encomienda::class,
            'id', // Foreign key on encomiendas table...
            'encomienda_id', // Foreign key on entregas table...
            'id', // Local key on transportistas table...
            'id' // Local key on encomiendas table...
        );
    }

    /**
     * Obtener las incidencias reportadas por el transportista.
     */
    public function incidencias()
    {
        return $this->hasManyThrough(
            Incidencia::class,
            Encomienda::class,
            'id', // Foreign key on encomiendas table...
            'encomienda_id', // Foreign key on incidencias table...
            'id', // Local key on transportistas table...
            'id' // Local key on encomiendas table...
        );
    }

    /**
     * Scope para transportistas disponibles.
     */
    public function scopeDisponibles($query)
    {
        return $query->where('disponible', true);
    }

    /**
     * Obtener el nombre completo del transportista.
     */
    public function getNombreCompletoAttribute()
    {
        return $this->nombre;
    }

    /**
     * Marcar al transportista como disponible/no disponible.
     */
    public function marcarDisponibilidad($disponible)
    {
        $this->update(['disponible' => $disponible]);
    }
}