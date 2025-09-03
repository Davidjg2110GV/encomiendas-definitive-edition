<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsignacionRutaController extends Controller
{
    public function asignarRuta(Request $request, Encomienda $encomienda)
    {
        $request->validate([
            'ruta_id' => 'required|exists:rutas,id',
            'transportista_id' => 'required|exists:transportistas,id'
        ]);

        // Lógica de asignación automática
        $ruta = Ruta::find($request->ruta_id);
        $transportista = Transportista::find($request->transportista_id);

        $encomienda->rutas()->attach($ruta, [
            'transportista_id' => $transportista->id,
            'fecha_asignacion' => now(),
            'estado' => 'asignado'
        ]);

        // Actualizar estado de la encomienda
        $encomienda->update(['estado' => 'en_proceso']);

        return redirect()->back()->with('success', 'Ruta asignada correctamente');
    }

    public function seguimiento($numero_seguimiento)
    {
        $encomienda = Encomienda::with(['rutas.transportista', 'remitente'])
                        ->where('numero_seguimiento', $numero_seguimiento)
                        ->firstOrFail();

        return view('encomiendas.seguimiento', compact('encomienda'));
    }
}