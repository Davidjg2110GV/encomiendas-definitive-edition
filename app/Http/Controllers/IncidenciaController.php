<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Models\Encomienda; // Necesitarás esto para el formulario de creación/edición
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     * Muestra una lista de incidencias.
     */
    public function index()
    {
        // Solo administradores y operadores pueden ver todas las incidencias.
        // Los transportistas y remitentes podrían ver las suyas si fuera necesario,
        // pero por ahora, mantendremos la visibilidad principal para Admin/Operador.
        if (!Auth::user()->isAdmin() && !Auth::user()->isOperador()) {
            abort(403, 'Acceso no autorizado.');
        }

        // Carga las incidencias paginadas, eager-loading la encomienda relacionada
        $incidencias = Incidencia::with('encomienda')->latest('fecha_incidencia')->paginate(10);

        return view('incidencias.index', compact('incidencias'));
    }

    /**
     * Show the form for creating a new resource.
     * Muestra el formulario para crear una nueva incidencia.
     */
    public function create()
    {
        // Solo administradores, operadores y transportistas pueden reportar incidencias
        if (!Auth::user()->isAdmin() && !Auth::user()->isOperador() && !Auth::user()->isTransportista()) {
            abort(403, 'Acceso no autorizado para reportar incidencias.');
        }

        $encomiendas = Encomienda::all(['id', 'numero_seguimiento']); // Para el dropdown de encomiendas
        $tipos = ['retraso', 'daño', 'extravio', 'otro']; // Tipos de incidencia de tu enum

        return view('incidencias.create', compact('encomiendas', 'tipos'));
    }

    /**
     * Store a newly created resource in storage.
     * Guarda una nueva incidencia en la base de datos.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isOperador() && !Auth::user()->isTransportista()) {
            abort(403, 'Acceso no autorizado para crear incidencias.');
        }

        $validated = $request->validate([
            'encomienda_id' => 'required|exists:encomiendas,id',
            'tipo'          => 'required|in:retraso,daño,extravio,otro',
            'descripcion'   => 'required|string|max:1000',
            // fecha_incidencia se establecerá automáticamente o se tomará de la petición si se envía
            // Si quieres que se establezca automáticamente a la hora de creación, no la incluyas aquí
        ]);

        $incidencia = Incidencia::create(array_merge($validated, [
            'fecha_incidencia' => now(), // Asegura que la fecha de incidencia sea la actual
            'estado'           => 'pendiente', // Por defecto siempre pendiente al crear
        ]));

        // Opcional: Si quieres cambiar el estado de la encomienda a 'incidencia'
        $incidencia->encomienda->update(['estado' => 'incidencia']);

        return redirect()->route('incidencias.index')->with('success', 'Incidencia reportada exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     * Muestra el formulario para editar la incidencia especificada.
     */
    public function edit(Incidencia $incidencia)
    {
        // Solo administradores y operadores pueden editar incidencias
        if (!Auth::user()->isAdmin() && !Auth::user()->isOperador()) {
            abort(403, 'Acceso no autorizado para editar incidencias.');
        }

        $encomiendas = Encomienda::all(['id', 'numero_seguimiento']);
        $tipos = ['retraso', 'daño', 'extravio', 'otro'];
        $estados = ['pendiente', 'resuelta'];

        return view('incidencias.edit', compact('incidencia', 'encomiendas', 'tipos', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     * Actualiza la incidencia especificada en la base de datos.
     */
    public function update(Request $request, Incidencia $incidencia)
    {
        // Solo administradores y operadores pueden actualizar incidencias
        if (!Auth::user()->isAdmin() && !Auth::user()->isOperador()) {
            abort(403, 'Acceso no autorizado para actualizar incidencias.');
        }

        $validated = $request->validate([
            'encomienda_id' => 'required|exists:encomiendas,id',
            'tipo'          => 'required|in:retraso,daño,extravio,otro',
            'descripcion'   => 'required|string|max:1000',
            'estado'        => 'required|in:pendiente,resuelta',
        ]);

        $incidencia->update($validated);

        // Opcional: Si la incidencia se resuelve, podrías querer cambiar el estado de la encomienda de nuevo
        if ($incidencia->estado !== 'incidencia' && $validated['estado'] == 'resuelta') {
            // Lógica para decidir a qué estado vuelve la encomienda.
            // Esto es complejo, ya que podría estar en tránsito, entregada, etc.
            // Podrías ponerla en "en_proceso" o dejar el transportista que la maneje.
            // Por simplicidad, por ahora no cambiamos el estado de la encomienda automáticamente al resolver la incidencia.
            // Si la encomienda estaba en 'incidencia' y esta es la última 'incidencia' activa,
            // entonces podrías querer revertir su estado a uno previo o a un estado predeterminado.
            // Ejemplo básico:
            // $activeIncidences = $incidencia->encomienda->incidencias()->where('estado', 'pendiente')->count();
            // if ($activeIncidences === 0) {
            //     $incidencia->encomienda->update(['estado' => 'en_transito']); // O a su estado anterior conocido
            // }
        }


        return redirect()->route('incidencias.index')->with('success', 'Incidencia actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     * Elimina la incidencia especificada de la base de datos.
     */
    public function destroy(Incidencia $incidencia)
    {
        // Solo administradores pueden eliminar incidencias
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Acceso no autorizado para eliminar incidencias.');
        }

        $incidencia->delete();

        return redirect()->route('incidencias.index')->with('success', 'Incidencia eliminada exitosamente.');
    }

    /**
     * Marks an incidence as resolved.
     * Marca una incidencia como resuelta.
     */
    public function markAsResolved(Incidencia $incidencia)
    {
        // Solo administradores y operadores pueden resolver incidencias
        if (!Auth::user()->isAdmin() && !Auth::user()->isOperador()) {
            abort(403, 'Acceso no autorizado para resolver incidencias.');
        }

        if ($incidencia->estado === 'pendiente') {
            $incidencia->update(['estado' => 'resuelta']);
            return redirect()->back()->with('success', 'Incidencia marcada como resuelta.');
        }

        return redirect()->back()->with('error', 'La incidencia ya ha sido resuelta.');
    }
}