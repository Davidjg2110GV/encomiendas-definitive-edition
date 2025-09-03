@extends('reports.pdf.layout')

@section('report_content')
    <div class="section">
        <h2>Motivo de Cancelación</h2>
        <p>{{ $encomienda->motivo_cancelacion ?? 'No se especificó un motivo de cancelación.' }}</p>
    </div>
@endsection