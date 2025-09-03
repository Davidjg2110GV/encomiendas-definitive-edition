<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-400 leading-tight bg-gradient-to-r from-yellow-400 via-orange-500 to-red-500 bg-clip-text text-transparent">
            {{ __('CanguroPanel') }}
        </h2>
    </x-slot>

    <div class="relative min-h-screen overflow-hidden">
        <div class="absolute inset-0 -z-10 h-full w-full bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
            <div class="absolute bottom-0 left-0 right-0 top-0 bg-[linear-gradient(to_right,#4f4f4f2e_1px,transparent_1px),linear-gradient(to_bottom,#4f4f4f2e_1px,transparent_1px)] bg-[size:14px_24px] [mask-image:radial-gradient(ellipse_80%_50%_at_50%_0%,#000_70%,transparent_110%)]"></div>
            
            <!-- Particles animadas -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute w-2 h-2 bg-yellow-400 rounded-full animate-pulse" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
                <div class="absolute w-1 h-1 bg-blue-400 rounded-full animate-pulse" style="top: 30%; left: 80%; animation-delay: 1s;"></div>
                <div class="absolute w-3 h-3 bg-purple-400 rounded-full animate-pulse" style="top: 60%; left: 20%; animation-delay: 2s;"></div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8 space-y-8">
            <!-- Encabezado con logo y título -->
            <div class="flex flex-col items-center mb-8 animate-fade-in-down">
                <div class="relative mb-4">
                    <div class="absolute -inset-2 bg-gradient-to-r from-yellow-400 via-purple-500 to-pink-500 rounded-full blur opacity-30 animate-pulse"></div>
                    <div class="relative bg-white/10 backdrop-blur-sm p-1 rounded-full shadow-2xl" style="width: 100px; height: 100px;">
                        <img src="{{ asset('imagenes/canguro.png') }}" 
                             alt="Logo CanguroPanel" 
                             class="w-full h-full object-contain p-2 rounded-full">
                    </div>
                </div>
                <h1 class="text-4xl font-bold text-center bg-gradient-to-r from-yellow-400 via-orange-500 to-red-500 bg-clip-text text-transparent">
                    CanguroPanel
                </h1>
                <p class="text-gray-400 mt-2 text-center">Sistema de gestión de paquetería y envíos</p>
            </div>

            <!-- Tarjetas de Resumen -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Tarjeta 1 -->
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-xl blur opacity-20 group-hover:opacity-75 transition duration-300"></div>
                    <div class="relative bg-gray-800/80 backdrop-blur-lg border border-gray-700/50 p-6 rounded-xl shadow-lg transform group-hover:-translate-y-1 transition-all duration-300 hover:shadow-yellow-500/20">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-400">Encomiendas Hoy</p>
                                <p class="text-2xl font-bold text-white">24</p>
                            </div>
                            <div class="bg-gradient-to-r from-yellow-400 to-orange-500 p-3 rounded-full shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-gray-400">+12% desde ayer</p>
                    </div>
                </div>

                <!-- Tarjeta 2 -->
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-green-400 to-emerald-500 rounded-xl blur opacity-20 group-hover:opacity-75 transition duration-300"></div>
                    <div class="relative bg-gray-800/80 backdrop-blur-lg border border-gray-700/50 p-6 rounded-xl shadow-lg transform group-hover:-translate-y-1 transition-all duration-300 hover:shadow-green-500/20">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-400">Entregas Completadas</p>
                                <p class="text-2xl font-bold text-white">18</p>
                            </div>
                            <div class="bg-gradient-to-r from-green-400 to-emerald-500 p-3 rounded-full shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-gray-400">+5% desde ayer</p>
                    </div>
                </div>

                <!-- Tarjeta 3 -->
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-red-400 to-pink-500 rounded-xl blur opacity-20 group-hover:opacity-75 transition duration-300"></div>
                    <div class="relative bg-gray-800/80 backdrop-blur-lg border border-gray-700/50 p-6 rounded-xl shadow-lg transform group-hover:-translate-y-1 transition-all duration-300 hover:shadow-red-500/20">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-400">Incidencias</p>
                                <p class="text-2xl font-bold text-white">3</p>
                            </div>
                            <div class="bg-gradient-to-r from-red-400 to-pink-500 p-3 rounded-full shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-gray-400">2 sin resolver</p>
                    </div>
                </div>

                <!-- Tarjeta 4 -->
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-400 to-purple-500 rounded-xl blur opacity-20 group-hover:opacity-75 transition duration-300"></div>
                    <div class="relative bg-gray-800/80 backdrop-blur-lg border border-gray-700/50 p-6 rounded-xl shadow-lg transform group-hover:-translate-y-1 transition-all duration-300 hover:shadow-purple-500/20">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-400">Transportistas Activos</p>
                                <p class="text-2xl font-bold text-white">7</p>
                            </div>
                            <div class="bg-gradient-to-r from-blue-400 to-purple-500 p-3 rounded-full shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-gray-400">5 en ruta actualmente</p>
                    </div>
                </div>
            </div>

            <!-- Gráfico y Tabla -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Gráfico -->
                <div class="relative group lg:col-span-2">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-400 to-purple-500 rounded-2xl blur opacity-20 group-hover:opacity-75 transition duration-300"></div>
                    <div class="relative bg-gray-800/80 backdrop-blur-lg border border-gray-700/50 rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-white mb-4">Actividad Reciente</h3>
                        <canvas id="activityChart" class="w-full h-64"></canvas>
                    </div>
                </div>

                <!-- Últimas encomiendas -->
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-purple-400 to-pink-500 rounded-2xl blur opacity-20 group-hover:opacity-75 transition duration-300"></div>
                    <div class="relative bg-gray-800/80 backdrop-blur-lg border border-gray-700/50 rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-white mb-4">Últimas Encomiendas</h3>
                        <div class="space-y-4">
                            @foreach($ultimasEncomiendas as $encomienda)
                            <div class="border-b border-gray-700 pb-3">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium text-yellow-400">#{{ $encomienda->numero_seguimiento }}</p>
                                        <p class="text-sm text-gray-400">{{ $encomienda->destinatario }}</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        @if($encomienda->estado == 'entregado') bg-green-900/50 text-green-400
                                        @elseif($encomienda->estado == 'incidencia') bg-red-900/50 text-red-400
                                        @else bg-yellow-900/50 text-yellow-400 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $encomienda->estado)) }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $encomienda->created_at->diffForHumans() }}
                                </p>
                            </div>
                            @endforeach
                        </div>
                        <a href="{{ route('encomiendas.index') }}" class="mt-4 inline-flex items-center text-yellow-400 hover:text-yellow-300 text-sm font-medium">
                            Ver todas las encomiendas
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Acciones rápidas -->
            <div class="mt-8 relative group">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl blur opacity-20 group-hover:opacity-75 transition duration-300"></div>
                <div class="relative bg-gray-800/80 backdrop-blur-lg border border-gray-700/50 rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Acciones Rápidas</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('encomiendas.create') }}" class="bg-gray-700/50 hover:bg-gray-600/50 border border-gray-600 rounded-lg p-4 text-center transition transform hover:scale-105">
                            <div class="bg-gradient-to-r from-yellow-400 to-orange-500 p-3 rounded-full w-12 h-12 mx-auto mb-2 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-white">Nueva Encomienda</span>
                        </a>
                        <a href="{{ route('transportistas.index') }}" class="bg-gray-700/50 hover:bg-gray-600/50 border border-gray-600 rounded-lg p-4 text-center transition transform hover:scale-105">
                            <div class="bg-gradient-to-r from-blue-400 to-purple-500 p-3 rounded-full w-12 h-12 mx-auto mb-2 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-white">Gestionar Transportistas</span>
                        </a>
                        <a href="{{ route('reports.index') }}" class="bg-gray-700/50 hover:bg-gray-600/50 border border-gray-600 rounded-lg p-4 text-center transition transform hover:scale-105">
                            <div class="bg-gradient-to-r from-green-400 to-emerald-500 p-3 rounded-full w-12 h-12 mx-auto mb-2 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-white">Generar Reporte</span>
                        </a>
                        <a href="{{ route('incidencias.index') }}" class="bg-gray-700/50 hover:bg-gray-600/50 border border-gray-600 rounded-lg p-4 text-center transition transform hover:scale-105">
                            <div class="bg-gradient-to-r from-red-400 to-pink-500 p-3 rounded-full w-12 h-12 mx-auto mb-2 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                            <span class="font-medium text-white">Ver Incidencias</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Gráfico de actividad con colores personalizados
        const ctx = document.getElementById('activityChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
                datasets: [{
                    label: 'Encomiendas',
                    data: [12, 19, 15, 24, 18, 8, 5],
                    backgroundColor: 'rgba(234, 179, 8, 0.7)',
                    borderColor: 'rgba(234, 179, 8, 1)',
                    borderWidth: 1
                }, {
                    label: 'Entregas',
                    data: [8, 12, 10, 18, 15, 5, 3],
                    backgroundColor: 'rgba(16, 185, 129, 0.7)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#E5E7EB'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(55, 65, 81, 0.5)'
                        },
                        ticks: {
                            color: '#9CA3AF'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(55, 65, 81, 0.5)'
                        },
                        ticks: {
                            color: '#9CA3AF'
                        }
                    }
                }
            }
        });
    </script>
    @endpush
</x-app-layout>