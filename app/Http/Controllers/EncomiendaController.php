<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encomienda;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EncomiendaController extends Controller
{
    /**
     * Display a paginated list of shipments filtered by user role.
     */
    public function index()
    {
        $user = Auth::user();
        
        $query = Encomienda::with(['remitente', 'transportista'])
            ->latest();

        switch ($user->rol) {
            case 'admin':
            case 'operador':
                $encomiendas = $query->paginate(15);
                break;
            
            case 'transportista':
                $encomiendas = $query->where('transportista_id', $user->id)
                    ->paginate(15);
                break;

            case 'remitente':
                $encomiendas = $query->where('remitente_id', $user->id)
                    ->paginate(15);
                break;

            default:
                $encomiendas = collect([])->paginate(15);
                break;
        }
        
        return view('encomienda.index', compact('encomiendas'));
    }

    /**
     * Show the form for creating a new shipment.
     */
    public function create()
    {
        $remitentes = User::where('rol', 'remitente')
            ->select('id', 'name', 'email')
            ->get();
            
        return view('encomienda.create', compact('remitentes'));
    }

    /**
     * Store a newly created shipment in database.
     */
    public function store(Request $request)
    {
        $rules = [
            'remitente_id' => 'required|exists:users,id',
            'destinatario' => 'required|string|max:255',
            'peso' => 'required|numeric|min:0.01|max:50',
            'tipo' => 'required|in:documento,sobre,paquete,caja,otro',
            'descripcion' => 'nullable|string|max:500',
            'direccion_destino' => 'required|string|max:255',
            'telefono_destinatario' => 'required|string|max:20',
            'fecha_entrega_estimada' => 'required|date|after_or_equal:today',
            'costo' => 'nullable|numeric|min:0',
            'fecha_envio' => 'nullable|date',
            'estado' => 'required|in:pendiente,en_proceso,en_transito,entregado,incidencia',
            'fecha_entrega_real' => 'nullable|date',
            'documento_receptor' => 'nullable|string|max:255',
        ];

        $validated = $request->validate($rules);

        try {
            DB::beginTransaction();
            
            $encomienda = new Encomienda($validated);
            $encomienda->numero_seguimiento = Encomienda::generarNumeroSeguimiento();
            $encomienda->costo = $validated['costo'] ?? $encomienda->calcularCosto();
            $encomienda->save();
            
            DB::commit();

            return redirect()->route(Auth::user()->isAdmin() ? 'admin.encomiendas.index' : 'operador.encomiendas.index')
                ->with('success', 'Encomienda creada exitosamente. N° Seguimiento: '.$encomienda->numero_seguimiento);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Error al crear la encomienda: '.$e->getMessage());
        }
    }

    /**
     * Display the specified shipment.
     */
    public function show(Encomienda $encomienda)
    {
        return view('encomienda.show', compact('encomienda'));
    }

    /**
     * Show the form for editing the specified shipment.
     */
    public function edit(Encomienda $encomienda)
    {
        $remitentes = User::where('rol', 'remitente')
            ->select('id', 'name', 'email')
            ->get();
            
        $transportistas = User::where('rol', 'transportista')
            ->select('id', 'name')
            ->get();
            
        return view('encomienda.edit', compact('encomienda', 'remitentes', 'transportistas'));
    }

    /**
     * Update the specified shipment in database.
     */
    public function update(Request $request, Encomienda $encomienda)
    {
        $user = Auth::user();

        // ==================== LÓGICA PARA ROL DE OPERADOR ====================
        if ($user->isOperador()) {
            $validated = $request->validate([
                'estado' => ['required', Rule::in(['incidencia'])]
            ], [
                'estado.in' => 'Como operador, solo puede cambiar el estado a "Incidencia".'
            ]);
            
            try {
                $encomienda->update($validated);
                return redirect()->route('operador.encomiendas.index')
                    ->with('success', 'La encomienda ha sido marcada como incidencia correctamente.');
            
            } catch (\Exception $e) {
                return back()
                    ->with('error', 'Error al actualizar la encomienda: '.$e->getMessage());
            }
        }

        // ==================== LÓGICA PARA ROL DE TRANSPORTISTA ====================
        elseif ($user->isTransportista()) {
            // 1. Validar que el estado sea 'en_transito' o 'entregado'
            $rules = [
                'estado' => ['required', Rule::in(['en_transito', 'entregado'])]
            ];
            
            // 2. Si el estado es 'entregado', añadir reglas para los campos de entrega
            if ($request->input('estado') === 'entregado') {
                $rules['fecha_entrega_real'] = ['required', 'date'];
                $rules['documento_receptor'] = ['required', 'string', 'max:255'];
                // ===== CAMBIO 3: PERMITIR LA DESCRIPCIÓN AL ENTREGAR =====
                $rules['descripcion'] = ['nullable', 'string', 'max:500'];
            }
            
            $validator = Validator::make($request->all(), $rules, [
                'estado.in' => 'Como transportista, solo puede cambiar el estado a "En tránsito" o "Entregado".',
                'fecha_entrega_real.required' => 'La fecha de entrega es obligatoria al marcar como entregado.',
                'documento_receptor.required' => 'El documento del receptor es obligatorio al marcar como entregado.',
            ]);
            
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $validated = $validator->validated();

            // Si el estado cambia a 'en_transito', nos aseguramos de no enviar la descripción.
            if ($request->input('estado') === 'en_transito') {
                unset($validated['descripcion']);
            }

            try {
                DB::beginTransaction();
                $encomienda->update($validated);
                DB::commit();

                return redirect()->route('transportista.encomiendas.index')
                    ->with('success', 'Estado de la encomienda actualizado correctamente.');

            } catch (\Exception $e) {
                DB::rollBack();
                return back()
                    ->with('error', 'Error al actualizar la encomienda: '.$e->getMessage());
            }
        }
        
        // ==================== LÓGICA PARA ADMIN (Y OTROS ROLES) ====================
        else {
            $rules = [
                'remitente_id' => 'required|exists:users,id',
                'transportista_id' => 'nullable|exists:users,id',
                'destinatario' => 'required|string|max:255',
                'peso' => 'required|numeric|min:0.01|max:50',
                'tipo' => 'required|in:documento,sobre,paquete,caja,otro',
                'descripcion' => 'nullable|string|max:500',
                'direccion_destino' => 'required|string|max:255',
                'telefono_destinatario' => 'required|string|max:20',
                'fecha_envio' => 'nullable|date',
                'fecha_entrega_estimada' => 'required|date',
                'estado' => 'required|in:pendiente,en_proceso,en_transito,entregado,incidencia',
                'costo' => 'nullable|numeric|min:0',
            ];

            if ($request->input('estado') === 'entregado') {
                $rules['fecha_entrega_real'] = ['required', 'date'];
                $rules['documento_receptor'] = ['required', 'string', 'max:255'];
            } else {
                $rules['fecha_entrega_real'] = ['nullable', 'date'];
                $rules['documento_receptor'] = ['nullable', 'string', 'max:255'];
            }

            $validator = Validator::make($request->all(), $rules);
            
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $validated = $validator->validated();

            try {
                DB::beginTransaction();
                $encomienda->update($validated);
                DB::commit();

                return redirect()->route('admin.encomiendas.index')
                    ->with('success', 'Encomienda actualizada exitosamente.');

            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withInput()
                    ->with('error', 'Error al actualizar la encomienda: '.$e->getMessage());
            }
        }
    }

    /**
     * Remove the specified shipment from database.
     */
    public function destroy(Encomienda $encomienda)
    {
        try {
            $encomienda->delete();
            
            $redirectRoute = Auth::user()->isAdmin() 
                ? 'admin.encomiendas.index' 
                : 'operador.encomiendas.index';
                
            return redirect()->route($redirectRoute)
                ->with('success', 'Encomienda eliminada exitosamente.');
                
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Error al eliminar la encomienda: '.$e->getMessage());
        }
    }
}