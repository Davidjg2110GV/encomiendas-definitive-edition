<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntregaController extends Controller
{
    public function registrarEntrega(Request $request, Encomienda $encomienda)
    {
        $request->validate([
            'nombre_receptor' => 'required|string|max:100',
            'firma' => 'required|string',
            'observaciones' => 'nullable|string'
        ]);

        Entrega::create([
            'encomienda_id' => $encomienda->id,
            'nombre_receptor' => $request->nombre_receptor,
            'firma' => $request->firma,
            'observaciones' => $request->observaciones,
            'fecha_entrega' => now()
        ]);

        // Actualizar estado de la encomienda
        $encomienda->update(['estado' => 'entregado']);

        return redirect()->route('encomiendas.index')->with('success', 'Entrega registrada exitosamente');
    }
}