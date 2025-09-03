<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <svg class="w-8 h-8 text-yellow-400 mr-3 transform transition-transform duration-500 hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 2v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h2 class="font-bold text-3xl text-white leading-tight bg-gradient-to-r from-yellow-300 to-yellow-500 text-gradient">
                Generación de Reportes
            </h2>
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
                <div class="p-6">
                    <form action="{{ route('reports.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        <div>
                            <label for="fecha_desde" class="block text-gray-300 text-sm font-bold mb-2">Desde:</label>
                            <input type="date" name="fecha_desde" id="fecha_desde"
                                   class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-200 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-gray-700"
                                   value="{{ request('fecha_desde') }}">
                        </div>
                        <div>
                            <label for="fecha_hasta" class="block text-gray-300 text-sm font-bold mb-2">Hasta:</label>
                            <input type="date" name="fecha_hasta" id="fecha_hasta"
                                   class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-200 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-gray-700"
                                   value="{{ request('fecha_hasta') }}">
                        </div>
                        <div>
                            <label for="estado" class="block text-gray-300 text-sm font-bold mb-2">Estado:</label>
                            <select name="estado" id="estado"
                                    class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-200 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-gray-700">
                                <option value="todos">Todos los Estados</option>
                                @foreach ($estados as $key => $value)
                                    <option value="{{ $key }}" {{ request('estado') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 bg-yellow-400 text-gray-900 font-bold py-2 px-4 rounded-lg shadow-lg hover:bg-yellow-300 transition-all duration-300 transform hover:scale-105 active:scale-95">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                                Filtrar
                            </button>
                            <a href="{{ route('reports.index') }}" class="flex-1 inline-flex items-center justify-center gap-2 bg-gray-600 text-white font-bold py-2 px-4 rounded-lg shadow-lg hover:bg-gray-500 transition-all duration-300 transform hover:scale-105 active:scale-95">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Limpiar
                            </a>
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-900/70">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Seguimiento</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Remitente</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Destinatario</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Estado</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Fecha Envío</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Costo</th>
                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Acciones</span></th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700/50">
                            @forelse ($encomiendas as $encomienda)
                                <tr class="group hover:bg-gray-700/50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-yellow-400">
                                        {{ $encomienda->numero_seguimiento }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        {{ $encomienda->remitente->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        {{ $encomienda->destinatario }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-bold rounded-full
                                            @if($encomienda->estado == 'entregado') bg-green-500/80 text-white
                                            @elseif($encomienda->estado == 'incidencia') bg-red-500/80 text-white
                                            @elseif($encomienda->estado == 'cancelado') bg-gray-500/80 text-white
                                            @elseif($encomienda->estado == 'en_transito') bg-blue-500/80 text-white
                                            @elseif($encomienda->estado == 'en_proceso') bg-purple-500/80 text-white
                                            @else bg-gray-600 text-white @endif">
                                            {{ ucfirst(str_replace('_', ' ', $encomienda->estado)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                        {{ $encomienda->fecha_envio ? $encomienda->fecha_envio->format('d/m/Y') : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-200">
                                        S/ {{ number_format($encomienda->costo, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2 opacity-50 group-hover:opacity-100 transition-opacity duration-300">
                                            {{-- Botón para generar reporte PDF individual --}}
                                            <a href="{{ route('reports.generatePdf', $encomienda->id) }}"
                                               class="p-2 text-purple-400 hover:text-white hover:bg-purple-400/20 rounded-full transition-all duration-300 transform hover:scale-110"
                                               title="Generar Reporte PDF">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-24 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center animate__animated animate__fadeIn">
                                            <svg class="w-20 h-20 text-gray-600/50 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            <h3 class="text-xl font-semibold text-gray-400 mb-2">No se encontraron encomiendas</h3>
                                            <p class="text-gray-500">
                                                Ajusta tus filtros o registra una nueva encomienda para verla aquí.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                if (row.querySelectorAll('td').length > 1) {
                    row.style.setProperty('--animate-duration', '0.5s');
                    row.style.setProperty('--animate-delay', `${index * 0.05}s`);
                    row.classList.add('animate__animated', 'animate__fadeInUp');
                }
            });

            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.classList.remove('animate__bounceIn');
                    successAlert.classList.add('animate__fadeOut');
                    setTimeout(() => successAlert.style.display = 'none', 500);
                }, 5000);
            }
            const errorAlert = document.getElementById('error-alert');
            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.classList.remove('animate__bounceIn');
                    errorAlert.classList.add('animate__fadeOut');
                    setTimeout(() => errorAlert.style.display = 'none', 500);
                }, 5000);
            }
        });
    </script>
</x-app-layout>