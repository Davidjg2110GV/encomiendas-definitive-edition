<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Encomienda extends Model
{
    use HasFactory;

    protected $fillable = [
        'remitente_id',
        'transportista_id', // <-- AÑADIDO: Para poder asignar masivamente.
        'destinatario',
        'numero_seguimiento',
        'estado',
        'motivo_cancelacion',
        'peso',
        'tipo',
        'descripcion',
        'direccion_destino',
        'telefono_destinatario',
        'costo',
        'fecha_envio',
        'fecha_entrega_estimada',
        'fecha_entrega_real',
        'documento_receptor',
        'firma_digital',
    ];

    protected $casts = [
        'fecha_envio' => 'datetime',
        'fecha_entrega_estimada' => 'date',
        'fecha_entrega_real' => 'datetime',
        'peso' => 'decimal:2',
        'costo' => 'decimal:2',
    ];

    /**
     * Relación: Una encomienda pertenece a un remitente (User).
     */
    public function remitente()
    {
        return $this->belongsTo(User::class, 'remitente_id');
    }

    /**
     * Relación: Una encomienda es asignada a un transportista (User).
     */
    public function transportista()
    {
        return $this->belongsTo(User::class, 'transportista_id');
    }
    
    /**
     * Relación: Una encomienda puede tener muchas incidencias.
     */
    public function incidencias()
    {
        return $this->hasMany(Incidencia::class);
    }
    
    /**
     * Genera un número de seguimiento único.
     */
    public static function generarNumeroSeguimiento(): string
    {
        $prefix = 'CG';
        $date = now()->format('Ymd');
        $random = strtoupper(Str::random(6));
        
        return "{$prefix}{$date}{$random}";
    }
    
    /**
     * Calcula el costo de la encomienda.
     */
    public function calcularCosto(): float
    {
        $base = 5.00;
        $porPeso = $this->peso * 0.75;
        $costoPorTipo = 0;

        switch ($this->tipo) {
            case 'documento':
            case 'sobre':
                $costoPorTipo = 2.00;
                break;
            case 'paquete':
                $costoPorTipo = 4.50;
                break;
            case 'caja':
                $costoPorTipo = 6.00;
                break;
            default:
                $costoPorTipo = 5.00;
                break;
        }
        
        return round($base + $porPeso + $costoPorTipo, 2);
    }
}