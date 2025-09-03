@extends('reports.pdf.layout')

@section('report_content')
    <div class="section">
        <h2>Detalles de la Incidencia</h2>
        @if ($incidencias_activas->isNotEmpty())
            @foreach ($incidencias_activas as $incidencia)
                <div style="margin-bottom: 10px; border-bottom: 1px dashed #ccc; padding-bottom: 10px;">
                    <div class="data-item"><strong>Tipo de Incidencia:</strong> {{ ucfirst($incidencia->tipo) }}</div>
                    <div class="data-item"><strong>Descripción:</strong> {{ $incidencia->descripcion }}</div>
                    <div class="data-item"><strong>Fecha de Reporte:</strong> {{ $incidencia->fecha_incidencia->format('d/m/Y H:i') }}</div>
                    <div class="data-item"><strong>Estado Incidencia:</strong> <span class="text-{{ $incidencia->estado == 'pendiente' ? 'yellow' : 'green' }}">{{ ucfirst($incidencia->estado) }}</span></div>
                </div>
            @endforeach
        @else
            <p>No se encontraron incidencias activas asociadas a esta encomienda.</p>
        @endif
    </div>
@endsection