<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Encomienda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid #ddd;
        }
        .header h1 {
            color: #f59e0b;
            margin: 0;
            font-size: 24px;
        }
        .section {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .section h2 {
            color: #f59e0b;
            margin-top: 0;
            font-size: 18px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        .data-item {
            margin-bottom: 8px;
        }
        .data-item strong {
            color: #555;
            display: inline-block;
            width: 150px; /* Alineación para etiquetas */
        }
        .signature-section {
            margin-top: 50px;
            text-align: center;
        }
        .signature-line {
            border-bottom: 1px dashed #999;
            width: 300px;
            margin: 0 auto 10px;
            padding-bottom: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        .text-red { color: #ef4444; }
        .text-green { color: #22c55e; }
        .text-blue { color: #3b82f6; }
        .text-purple { color: #a855f7; }
        .text-gray { color: #6b7280; }
        .text-yellow { color: #f59e0b; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Encomienda - CanguroPanel</h1>
        <p>Generado por: {{ $admin_name ?? 'N/A' }} ({{ $admin_role ?? 'N/A' }})</p>
        <p>Fecha de Generación: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="section">
        <h2>Detalles de la Encomienda</h2>
        <div class="data-item"><strong>N° Seguimiento:</strong> {{ $encomienda->numero_seguimiento }}</div>
        <div class="data-item"><strong>Remitente:</strong> {{ $encomienda->remitente->name ?? 'N/A' }}</div>
        <div class="data-item"><strong>Destinatario:</strong> {{ $encomienda->destinatario }}</div>
        <div class="data-item"><strong>Tipo:</strong> {{ ucfirst($encomienda->tipo) }}</div>
        <div class="data-item"><strong>Estado:</strong> <span class="text-{{
            $encomienda->estado == 'entregado' ? 'green' :
            ($encomienda->estado == 'incidencia' ? 'red' :
            ($encomienda->estado == 'cancelado' ? 'gray' :
            ($encomienda->estado == 'en_transito' ? 'blue' :
            ($encomienda->estado == 'en_proceso' ? 'purple' : ''))))
        }}">{{ ucfirst(str_replace('_', ' ', $encomienda->estado)) }}</span></div>
        <div class="data-item"><strong>Fecha Envío:</strong> {{ $encomienda->fecha_envio ? $encomienda->fecha_envio->format('d/m/Y H:i') : 'N/A' }}</div>
        <div class="data-item"><strong>Entrega Estimada:</strong> {{ $encomienda->fecha_entrega_estimada ? $encomienda->fecha_entrega_estimada->format('d/m/Y') : 'N/A' }}</div>
        <div class="data-item"><strong>Costo:</strong> S/ {{ number_format($encomienda->costo, 2) }}</div>
        <div class="data-item"><strong>Descripción:</strong> {{ $encomienda->descripcion }}</div>
    </div>

    @yield('report_content')

    <div class="signature-section">
        <div class="signature-line"></div>
        <p>Firma y Sello</p>
        <p>{{ $admin_name ?? 'N/A' }}</p>
        <p>{{ $admin_role ?? 'N/A' }}</p>
    </div>

    <div class="footer">
        <p>Este documento es una impresión generada del sistema y tiene validez oficial.</p>
    </div>
</body>
</html>