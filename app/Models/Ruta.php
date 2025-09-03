<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;

    protected $fillable = ['origen', 'destino', 'duracion_estimada', 'costo_base'];

    public function transportistas()
    {
        return $this->belongsToMany(Transportista::class, 'encomienda_ruta_transportista')
                    ->withPivot('encomienda_id', 'fecha_asignacion', 'estado')
                    ->withTimestamps();
    }

    public function encomiendas()
    {
        return $this->belongsToMany(Encomienda::class, 'encomienda_ruta_transportista')
                    ->withPivot('transportista_id', 'fecha_asignacion', 'estado')
                    ->withTimestamps();
    }
}
