<?php

namespace Database\Factories;

use App\Models\Encomienda;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EncomiendaFactory extends Factory
{
    protected $model = Encomienda::class;

    public function definition()
    {
        $tipos = ['documento', 'paquete', 'caja', 'sobre', 'otro'];
        
        return [
            'remitente_id' => User::factory(),
            'destinatario' => $this->faker->name,
            'numero_seguimiento' => Encomienda::generarNumeroSeguimiento(),
            'estado' => $this->faker->randomElement(['pendiente', 'en_proceso', 'en_transito', 'entregado', 'incidencia']),
            'peso' => $this->faker->randomFloat(2, 0.1, 50),
            'tipo' => $this->faker->randomElement($tipos),
            'descripcion' => $this->faker->sentence,
            'direccion_destino' => $this->faker->address,
            'telefono_destinatario' => $this->faker->phoneNumber,
            'costo' => $this->faker->randomFloat(2, 5, 100),
            'fecha_envio' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'fecha_entrega_estimada' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}