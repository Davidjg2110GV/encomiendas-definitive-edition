<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center animate__animated animate__fadeInDown">
            <div class="flex items-center">
                <svg class="w-8 h-8 text-yellow-400 mr-3 transform transition-transform duration-500 hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <h2 class="font-bold text-3xl text-white leading-tight bg-gradient-to-r from-yellow-300 to-yellow-500 text-gradient">
                    Gestión de Incidencias
                </h2>
            </div>
            
            {{-- Botón para Reportar Incidencia, visible para Admin, Operador, Transportista --}}
            @if(Auth::user()->isAdmin() || Auth::user()->isOperador() || Auth::user()->isTransportista())
                <a href="{{ route('incidencias.create') }}" class="mt-4 sm:mt-0 inline-flex items-center gap-2 bg-yellow-400 text-gray-900 font-bold py-2 px-4 rounded-lg shadow-lg hover:bg-yellow-300 transition-all duration-300 transform hover:scale-105 active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Reportar Incidencia
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
            @if (session('error'))
                <div id="error-alert" class="bg-red-500/90 backdrop-blur-sm text-white p-4 rounded-lg shadow-lg mb-6 border border-red-400/50 animate__animated animate__bounceIn flex justify-between items-center">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                    <button onclick="document.getElementById('error-alert').style.display='none'" class="text-red-100 hover:text-white">×</button>
                </div>
            @endif

            <div class="bg-gray-800/60 backdrop-blur-sm border border-gray-700/50 overflow-hidden shadow-2xl sm:rounded-2xl transition-all duration-500 hover:shadow-yellow-400/20 hover:border-yellow-400/30">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-900/70">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">N° Encomienda</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Tipo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Descripción</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Fecha de Incidencia</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Estado</th>
                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Acciones</span></th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700/50">
                            @forelse ($incidencias as $incidencia)
                                <tr class="group hover:bg-gray-700/50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-yellow-400">
                                        {{ $incidencia->encomienda->numero_seguimiento ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-red-500/20 text-red-400">
                                            {{ ucfirst($incidencia->tipo) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-300 max-w-xs truncate" title="{{ $incidencia->descripcion }}">
                                        {{ $incidencia->descripcion }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                        {{ $incidencia->fecha_incidencia ? $incidencia->fecha_incidencia->format('d/m/Y H:i') : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        <span class="font-bold {{ $incidencia->isResuelta() ? 'text-green-400' : 'text-yellow-400' }}">
                                            {{ $incidencia->isResuelta() ? 'Resuelta' : 'Pendiente' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2 opacity-50 group-hover:opacity-100 transition-opacity duration-300">
                                            {{-- Botón Editar: Solo para Admin y Operador --}}
                                            @if(Auth::user()->isAdmin() || Auth::user()->isOperador())
                                                <a href="{{ route('incidencias.edit', $incidencia->id) }}" class="p-2 text-blue-400 hover:text-white hover:bg-blue-400/20 rounded-full transition-all duration-300 transform hover:scale-110" title="Editar">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                </a>
                                            @endif

                                            {{-- Botón Resolver: Solo para Admin y Operador, y si la incidencia está pendiente --}}
                                            @if((Auth::user()->isAdmin() || Auth::user()->isOperador()) && !$incidencia->isResuelta())
                                                <form action="{{ route('incidencias.resolve', $incidencia) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="p-2 text-green-400 hover:text-white hover:bg-green-400/20 rounded-full transition-all duration-300 transform hover:scale-110" title="Marcar como Resuelta">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- Botón Eliminar: Solo para Admin --}}
                                            @if(Auth::user()->isAdmin())
                                                <form action="{{ route('incidencias.destroy', $incidencia) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-red-400 hover:text-white hover:bg-red-400/20 rounded-full transition-all duration-300 transform hover:scale-110" title="Eliminar">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            <h3 class="mt-2 text-sm font-medium">¡Todo en orden!</h3>
                                            <p class="mt-1 text-sm">No hay incidencias registradas.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($incidencias->hasPages())
                    <div class="p-4 bg-gray-900/50 border-t border-gray-700/50">
                        {{ $incidencias->links() }}
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
                if (row.querySelectorAll('td').length > 1) { // Evita animar la fila "No hay incidencias"
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
            // Ocultar alerta de error automáticamente
            const errorAlert = document.getElementById('error-alert');
            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.classList.remove('animate__bounceIn');
                    errorAlert.classList.add('animate__fadeOut');
                    setTimeout(() => errorAlert.style.display = 'none', 500);
                }, 5000); // Ocultar después de 5 segundos
            }
        });
    </script>
</x-app-layout>