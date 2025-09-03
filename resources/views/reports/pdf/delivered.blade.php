@extends('reports.pdf.layout')

@section('report_content')
    <div class="section">
        <h2>Información de Entrega</h2>
        <div class="data-item"><strong>Fecha de Entrega Real:</strong> {{ $encomienda->fecha_entrega_real ? $encomienda->fecha_entrega_real->format('d/m/Y H:i') : 'N/A' }}</div>
        <div class="data-item"><strong>Receptor:</strong> {{ $encomienda->documento_receptor ?? $encomienda->destinatario }}</div>
        <div class="data-item"><strong>Documento Receptor:</strong> {{ $encomienda->documento_receptor ?? 'N/A' }}</div>
        <div class="data-item"><strong>Teléfono Receptor:</strong> {{ $encomienda->telefono_destinatario ?? 'N/A' }}</div>
        <div class="data-item"><strong>Dirección de Destino:</strong> {{ $encomienda->direccion_destino ?? 'N/A' }}</div>
    </div>

    <div class="signature-section" style="margin-top: 80px;">
        <div class="signature-line" style="width: 400px;"></div>
        <p>Firma del Receptor</p>
        <p>Nombre: {{ $encomienda->destinatario }}</p>
        <p>DNI/ID: {{ $encomienda->documento_receptor ?? '____________________' }}</p>
    </div>
@endsection