<?php

namespace App\Http\Controllers;

use App\Models\Encomienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Encomienda::with('remitente');

        // Apply filters
        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha_envio', '>=', $request->input('fecha_desde'));
        }
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha_envio', '<=', $request->input('fecha_hasta'));
        }
        if ($request->filled('estado') && $request->input('estado') != 'todos') {
            $query->where('estado', $request->input('estado'));
        }

        $encomiendas = $query->paginate(10)->withQueryString();

        $estados = [
            'en_proceso'  => 'En Proceso',
            'en_transito' => 'En Tránsito',
            'entregado'   => 'Entregado',
            'cancelado'   => 'Cancelado',
            'incidencia'  => 'Incidencia',
        ];

        // Use the same view for both admin and operador
        return view('reports.index', compact('encomiendas', 'estados'));
    }

    public function generatePdf(Encomienda $encomienda)
    {
        $viewName = '';
        $fileName = '';
        $data = [
            'encomienda'  => $encomienda->load('remitente'),
            'admin_name'  => Auth::user()->name,
            'admin_role'  => Auth::user()->role,
        ];

        switch ($encomienda->estado) {
            case 'cancelado':
                $viewName = 'reports.pdf.cancelled';
                $fileName = 'reporte_cancelacion_' . $encomienda->numero_seguimiento . '.pdf';
                break;
            case 'incidencia':
                $viewName = 'reports.pdf.incidencia';
                $data['incidencias_activas'] = $encomienda->incidencias()->where('estado', 'pendiente')->get();
                $fileName = 'reporte_incidencia_' . $encomienda->numero_seguimiento . '.pdf';
                break;
            case 'entregado':
                $viewName = 'reports.pdf.delivered';
                $fileName = 'reporte_entrega_' . $encomienda->numero_seguimiento . '_' . $encomienda->destinatario . '.pdf';
                break;
            default:
                return redirect()->back()->with('error', 'No se puede generar un reporte detallado para el estado actual de esta encomienda.');
        }

        $pdf = Pdf::loadView($viewName, $data);

        return $pdf->download($fileName);
    }
}