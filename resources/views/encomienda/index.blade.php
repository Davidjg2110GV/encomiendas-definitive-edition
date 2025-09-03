<x-app-layout>
    {{-- Estilos personalizados para efectos adicionales --}}
    <style>
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }
        /* Hover effects for status badges */
        .status-badge-glow-green:hover { box-shadow: 0 0 10px rgba(34, 197, 94, 0.7); }
        .status-badge-glow-red:hover { box-shadow: 0 0 10px rgba(239, 68, 68, 0.7); }
        .status-badge-glow-blue:hover { box-shadow: 0 0 10px rgba(59, 130, 246, 0.7); }
        .status-badge-glow-purple:hover { box-shadow: 0 0 10px rgba(168, 85, 247, 0.7); }
        .status-badge-glow-gray:hover { box-shadow: 0 0 10px rgba(107, 114, 128, 0.7); }

        /* Ajustes para la tabla para intentar evitar el scroll horizontal */
        .table-auto-width {
            width: 100%; /* Asegura que la tabla ocupe el 100% del contenedor */
            table-layout: auto; /* Permite que las columnas se ajusten al contenido */
        }
        .table-auto-width th, .table-auto-width td {
            white-space: nowrap; /* Evita que el texto se rompa en varias líneas */
            overflow: hidden; /* Oculta el contenido que excede el ancho */
            text-overflow: ellipsis; /* Añade puntos suspensivos (...) al final del texto truncado */
            max-width: 150px; /* Ancho máximo para columnas de texto, ajusta si es necesario */
            min-width: 80px; /* Ancho mínimo para evitar que las columnas se colapsen demasiado */
        }
        .table-auto-width .action-column {
            width: 1%; /* Mantiene las columnas de acción lo más pequeñas posible */
            min-width: 100px; /* Asegura espacio para los botones */
            white-space: nowrap;
            overflow: visible; /* Las acciones deben ser visibles */
            text-overflow: clip;
        }
        .table-auto-width .id-column, .table-auto-width .status-column, .table-auto-width .cost-column {
            max-width: 80px; /* Columnas con contenido más corto */
        }
        .table-auto-width .date-column {
            max-width: 120px; /* Columnas de fecha y hora */
        }
    </style>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center animate__animated animate__fadeInDown">
            <div class="flex items-center">
                <svg class="w-8 h-8 text-yellow-400 mr-3 transform transition-transform duration-500 hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <h2 class="font-bold text-3xl text-white leading-tight bg-gradient-to-r from-yellow-300 to-yellow-500 text-gradient">
                    @if(Auth::user()->isRemitente())
                        Mis Envíos
                    @else
                        Gestión de Encomiendas
                    @endif
                </h2>
            </div>
            
            {{-- Botón para registrar encomienda, visible SOLO para Admin y Operador --}}
            {{-- Se ha eliminado la condición para el remitente --}}
            @if(Auth::user()->isAdmin() || Auth::user()->isOperador())
                <a href="
                    @if (Auth::user()->isAdmin())
                        {{-- Asegúrate que esta ruta exista, por ejemplo: admin.encomiendas.create --}}
                        {{ route('admin.encomiendas.create') }}
                    @elseif (Auth::user()->isOperador())
                        {{-- Asegúrate que esta ruta exista, por ejemplo: operador.encomiendas.create --}}
                        {{ route('operador.encomiendas.create') }}
                    @endif
                    " class="mt-4 sm:mt-0 inline-flex items-center gap-2 bg-yellow-400 text-gray-900 font-bold py-2 px-4 rounded-lg shadow-lg hover:bg-yellow-300 transition-all duration-300 transform hover:scale-105 active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Registrar Encomienda
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12 animate__animated animate__fadeIn">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div id="success-alert" class="bg-green-500/90 backdrop-blur-sm text-white p-4 rounded-lg shadow-lg mb-6 border border-green-400/50 animate__animated animate__bounceIn flex justify-between items-center">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                    <button onclick="document.getElementById('success-alert').style.display='none'" class="text-green-100 hover:text-white">×</button>
                </div>
            @endif

            <div class="bg-gray-800/60 backdrop-blur-sm border border-gray-700/50 overflow-hidden shadow-2xl sm:rounded-2xl transition-all duration-500 hover:shadow-yellow-400/20 hover:border-yellow-400/30">
                <table class="min-w-full divide-y divide-gray-700 table-auto-width">
                    <thead class="bg-gray-900/70">
                        <tr>
                            <th scope="col" class="px-3 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider id-column">N° Seguimiento</th>
                            @if(!Auth::user()->isRemitente()) {{-- El remitente no necesita ver su propio nombre --}}
                                <th scope="col" class="px-3 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Remitente</th>
                            @endif
                            <th scope="col" class="px-3 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Destinatario</th>
                            <th scope="col" class="px-3 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Tipo</th>
                            <th scope="col" class="px-3 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider status-column">Estado</th>
                            <th scope="col" class="px-3 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider date-column">Fecha Envío</th>
                            <th scope="col" class="px-3 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider date-column">Entrega Estimada</th>
                            <th scope="col" class="px-3 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider date-column">Entrega Real</th>
                            <th scope="col" class="px-3 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider cost-column">Costo</th>
                            
                            <th scope="col" class="relative px-3 py-4 action-column"><span class="sr-only">Acciones</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700/50">
                        @forelse ($encomiendas as $encomienda)
                            <tr class="group hover:bg-gray-700/50 transition-colors duration-200">
                                <td class="px-3 py-3 whitespace-nowrap text-sm font-semibold text-yellow-400">
                                    {{ $encomienda->numero_seguimiento }}
                                </td>
                                @if(!Auth::user()->isRemitente())
                                <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-300">
                                    {{ $encomienda->remitente->name ?? 'N/A' }}
                                </td>
                                @endif
                                <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-300">
                                    {{ $encomienda->destinatario }}
                                </td>
                                <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-300 capitalize">
                                    {{ $encomienda->tipo }}
                                </td>
                                <td class="px-3 py-3 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-bold rounded-full transition-all duration-300
                                        @if($encomienda->estado == 'entregado') bg-green-500/80 text-white status-badge-glow-green
                                        @elseif($encomienda->estado == 'incidencia') bg-red-500/80 text-white status-badge-glow-red
                                        @elseif($encomienda->estado == 'en_transito') bg-blue-500/80 text-white status-badge-glow-blue
                                        @elseif($encomienda->estado == 'en_proceso') bg-purple-500/80 text-white status-badge-glow-purple
                                        @else bg-gray-600 text-white status-badge-glow-gray @endif
                                        transform hover:scale-110">
                                        {{ ucfirst(str_replace('_', ' ', $encomienda->estado)) }}
                                    </span>
                                </td>
                                <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-400">
                                    {{ $encomienda->fecha_envio ? $encomienda->fecha_envio->format('d/m/Y H:i') : 'N/A' }}
                                </td>
                                <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-400">
                                    @if($encomienda->fecha_entrega_estimada)
                                        {{ $encomienda->fecha_entrega_estimada->format('d/m/Y') }}
                                        @if($encomienda->estado != 'entregado' && now()->startOfDay() > $encomienda->fecha_entrega_estimada)
                                            <span class="ml-1 text-red-400" title="Retrasado">⚠️</span>
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-400">
                                    @if($encomienda->fecha_entrega_real)
                                        {{ $encomienda->fecha_entrega_real->format('d/m/Y H:i') }}
                                        @if($encomienda->estado == 'entregado')
                                            <span class="ml-1 text-green-400" title="Entregado">✓</span>
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="px-3 py-3 whitespace-nowrap text-sm font-medium text-gray-200">
                                    S/ {{ number_format($encomienda->costo, 2) }}
                                </td>

                                <td class="px-3 py-3 whitespace-nowrap text-right text-sm font-medium action-column">
                                    <div class="flex justify-end space-x-2 opacity-50 group-hover:opacity-100 transition-opacity duration-300">
                                        
                                        {{-- ===== INICIO DEL CAMBIO ===== --}}
                                        {{-- Botón de Editar: Visible para Administrador, Operador y Transportista --}}
                                        @if(Auth::user()->isAdmin() || Auth::user()->isOperador() || Auth::user()->isTransportista())
                                            <a href="
                                                @if(Auth::user()->isAdmin())
                                                    {{ route('admin.encomiendas.edit', $encomienda->id) }}
                                                @elseif(Auth::user()->isOperador())
                                                    {{ route('operador.encomiendas.edit', $encomienda->id) }}
                                                @elseif(Auth::user()->isTransportista())
                                                    {{ route('transportista.encomiendas.edit', $encomienda->id) }}
                                                @endif
                                                " class="p-2 text-yellow-400 hover:text-white hover:bg-yellow-400/20 rounded-full transition-all duration-300 transform hover:scale-110"
                                                title="Editar">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </a>
                                        @endif
                                        {{-- ===== FIN DEL CAMBIO ===== --}}
                                        
                                        {{-- Botón de Eliminar: Visible solo para Administrador --}}
                                        @if(Auth::user()->isAdmin())
                                            <form action="{{ route('admin.encomiendas.destroy', $encomienda) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="p-2 text-red-400 hover:text-white hover:bg-red-400/20 rounded-full transition-all duration-300 transform hover:scale-110"
                                                        title="Eliminar">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ Auth::user()->isRemitente() ? 9 : 10 }}" class="px-6 py-24 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500 animate__animated animate__fadeIn">
                                        <svg class="w-20 h-20 text-gray-600/50 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                        <h3 class="text-xl font-semibold text-gray-400 mb-2">Aún no hay encomiendas</h3>
                                        <p class="text-gray-500">
                                            @if(Auth::user()->isRemitente())
                                                Cuando registres una nueva encomienda, aparecerá aquí.
                                            @else
                                                No se han encontrado registros de encomiendas.
                                            @endif
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if ($encomiendas->hasPages())
                    <div class="p-4 bg-gray-900/50 border-t border-gray-700/50">
                        {{ $encomiendas->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Dependencias externas -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Animación escalonada de las filas de la tabla
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                // Solo animar si no es la fila de "no hay encomiendas"
                if (row.querySelectorAll('td').length > 1) {
                    row.style.setProperty('--animate-duration', '0.5s');
                    row.style.setProperty('--animate-delay', `${index * 0.05}s`);
                    row.classList.add('animate__animated', 'animate__fadeInUp');
                }
            });

            // Ocultar alerta de éxito automáticamente
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.classList.remove('animate__bounceIn');
                    successAlert.classList.add('animate__fadeOut');
                    setTimeout(() => successAlert.style.display = 'none', 500);
                }, 5000); // Ocultar después de 5 segundos
            }
        });
    </script>
</x-app-layout>