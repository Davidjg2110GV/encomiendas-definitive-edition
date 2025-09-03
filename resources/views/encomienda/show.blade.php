@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Detalle de Encomienda</h4>
                        <span class="badge badge-light">
                            {{ $encomienda->numero_seguimiento }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Información del Remitente</h5>
                            <p class="mb-1"><strong>Nombre:</strong> {{ $encomienda->remitente->name }}</p>
                            <p class="mb-1"><strong>Email:</strong> {{ $encomienda->remitente->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Información del Destinatario</h5>
                            <p class="mb-1"><strong>Nombre:</strong> {{ $encomienda->destinatario }}</p>
                            <p class="mb-1"><strong>Teléfono:</strong> {{ $encomienda->telefono_destinatario }}</p>
                            <p class="mb-1"><strong>Dirección:</strong> {{ $encomienda->direccion_destino }}</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Detalles del Envío</h5>
                            <p class="mb-1"><strong>Tipo:</strong> {{ ucfirst($encomienda->tipo) }}</p>
                            <p class="mb-1"><strong>Peso:</strong> {{ $encomienda->peso }} kg</p>
                            <p class="mb-1"><strong>Descripción:</strong> {{ $encomienda->descripcion ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Información de Pago</h5>
                            <p class="mb-1"><strong>Costo:</strong> ${{ number_format($encomienda->costo, 2) }}</p>
                            <p class="mb-1"><strong>Estado:</strong> 
                                <span class="badge 
                                    @if($encomienda->estado == 'pendiente') badge-warning
                                    @elseif($encomienda->estado == 'entregado') badge-success
                                    @elseif($encomienda->estado == 'incidencia') badge-danger
                                    @else badge-info @endif">
                                    {{ str_replace('_', ' ', ucfirst($encomienda->estado)) }}
                                </span>
                            </p>
                            @if($encomienda->fecha_entrega_estimada)
                                <p class="mb-1"><strong>Entrega estimada:</strong> {{ $encomienda->fecha_entrega_estimada->format('d/m/Y') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('encomiendas.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Volver al listado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection