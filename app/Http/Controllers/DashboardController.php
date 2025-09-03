<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Encomienda;
use App\Models\Entrega;
use App\Models\Incidencia;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Redirige al dashboard específico según el rol del usuario.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user->activo) {
            Auth::logout();
            return redirect('/login')->with('error', 'Tu cuenta está desactivada.');
        }

        switch ($user->rol) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'operador':
                return redirect()->route('operador.dashboard');
            case 'transportista':
                return redirect()->route('transportista.dashboard');
            case 'remitente':
                return redirect()->route('remitente.dashboard');
            default:
                Auth::logout();
                return redirect('/login')->with('error', 'Rol de usuario no válido.');
        }
    }

    /**
     * Dashboard para administradores.
     */
    public function adminDashboard()
    {
        $hoy = Carbon::today();
        $semanaPasada = Carbon::today()->subDays(7);

        return view('admin.dashboard', [
            'encomiendasHoy' => Encomienda::whereDate('created_at', $hoy)->count(),
            'encomiendasSemana' => Encomienda::where('created_at', '>=', $semanaPasada)->count(),
            'entregasPendientes' => Encomienda::where('estado', 'en_proceso')->count(),
            'incidenciasAbiertas' => Incidencia::where('estado', 'pendiente')->count(),
            'usuariosRecientes' => User::where('created_at', '>=', $semanaPasada)
                                    ->orderBy('created_at', 'desc')
                                    ->limit(5)
                                    ->get(),
            'encomiendasRecientes' => Encomienda::with('remitente')
                                            ->orderBy('created_at', 'desc')
                                            ->limit(5)
                                            ->get()
        ]);
    }

    /**
     * Dashboard para operadores.
     */
     public function operadorDashboard()
    {
        // --- Recopilamos las estadísticas clave para el Operador ---

        // 1. Encomiendas que están actualmente en proceso
        $encomiendasEnProceso = Encomienda::where('estado', 'en_proceso')->count();

        // 2. Incidencias que están abiertas y necesitan atención
        $incidenciasPendientes = Incidencia::where('estado', 'pendiente')->count();

        // 3. Encomiendas que el operador ha registrado hoy
        $encomiendasCreadasHoy = Encomienda::whereDate('created_at', today())->count();
        
        // 4. Lista de las últimas 5 encomiendas gestionadas para mostrar actividad reciente
        $encomiendasRecientes = Encomienda::with('remitente')->latest()->take(5)->get();

        // Pasamos todas las variables a la vista
        return view('operador.dashboard', compact(
            'encomiendasEnProceso',
            'incidenciasPendientes',
            'encomiendasCreadasHoy',
            'encomiendasRecientes'
        ));
    }
    
    /**
     * Dashboard para remitente.
     */
    public function remitenteDashboard()
    {
        $user = Auth::user();
        return view('remitente.dashboard', [
            'misEncomiendas' => Encomienda::where('remitente_id', $user->id)
                                    ->orderBy('created_at', 'desc')
                                    ->limit(5)
                                    ->get(),
            'encomiendasPendientes' => Encomienda::where('remitente_id', $user->id)
                                            ->whereIn('estado', ['pendiente', 'en_proceso'])
                                            ->count(),
            'entregasCompletadas' => Encomienda::where('remitente_id', $user->id)
                                        ->where('estado', 'entregado')
                                        ->count()
        ]);
    }

    // ======================================================================
    // |         NUEVO MÉTODO AÑADIDO PARA EL TRANSPORTISTA                 |
    // ======================================================================
    
    /**
     * Dashboard para transportistas.
     */
    public function transportistaDashboard()
    {
        $user = Auth::user();
        $hoy = Carbon::today();

        // Asumo que en tu tabla 'encomiendas' tienes una columna 'transportista_id'
        // para saber qué encomienda pertenece a qué transportista.
        // Si la columna se llama diferente, ajústala aquí.
        
        // Conteo de encomiendas asignadas y en tránsito
        $encomiendasAsignadas = Encomienda::where('transportista_id', $user->id)
                                            ->whereIn('estado', ['asignada', 'en_transito']) // Ajusta estos estados si los llamas diferente
                                            ->count();

        // Conteo de entregas completadas hoy por este transportista
        $entregasHoy = Encomienda::where('transportista_id', $user->id)
                                 ->where('estado', 'entregado')
                                 ->whereDate('updated_at', $hoy) // Asume que updated_at se actualiza al entregar
                                 ->count();

        // Lista de las últimas encomiendas asignadas para mostrar en una tabla
        $ultimasAsignaciones = Encomienda::with(['remitente']) // CORREGIDO: Se quita 'destinatario'
                                 ->where('transportista_id', $user->id)
                                 ->orderBy('created_at', 'desc')
                                 ->limit(5)
                                 ->get();
                                 
        return view('transportista.dashboard', [
            'user' => $user,
            'encomiendasAsignadas' => $encomiendasAsignadas,
            'entregasHoy' => $entregasHoy,
            'ultimasAsignaciones' => $ultimasAsignaciones,
        ]);
    }
}