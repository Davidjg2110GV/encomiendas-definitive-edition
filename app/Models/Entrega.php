<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    use HasFactory;

    protected $fillable = ['encomienda_id', 'firma', 'nombre_receptor', 'observaciones', 'fecha_entrega'];

    public function encomienda()
    {
        return $this->belongsTo(Encomienda::class);
    }
}