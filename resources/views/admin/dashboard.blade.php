<x-app-layout>
    {{-- Contenedor principal con fondo de efecto aurora mejorado --}}
    <div class="relative min-h-screen overflow-hidden">
        <div class="absolute inset-0 -z-10 h-full w-full bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
            {{-- Efecto de grid sutil --}}
            <div class="absolute bottom-0 left-0 right-0 top-0 bg-[linear-gradient(to_right,#4f4f4f2e_1px,transparent_1px),linear-gradient(to_bottom,#4f4f4f2e_1px,transparent_1px)] bg-[size:14px_24px] [mask-image:radial-gradient(ellipse_80%_50%_at_50%_0%,#000_70%,transparent_110%)]"></div>
            
            {{-- Particles animadas mejoradas --}}
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute w-2 h-2 bg-yellow-400 rounded-full animate-pulse" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
                <div class="absolute w-1 h-1 bg-blue-400 rounded-full animate-pulse" style="top: 30%; left: 80%; animation-delay: 1s;"></div>
                <div class="absolute w-3 h-3 bg-purple-400 rounded-full animate-pulse" style="top: 60%; left: 20%; animation-delay: 2s;"></div>
                <div class="absolute w-2 h-2 bg-green-400 rounded-full animate-pulse" style="top: 80%; left: 70%; animation-delay: 3s;"></div>
                <div class="absolute w-1 h-1 bg-red-400 rounded-full animate-pulse" style="top: 40%; left: 60%; animation-delay: 4s;"></div>
                <div class="absolute w-2 h-2 bg-pink-400 rounded-full animate-pulse" style="top: 70%; left: 90%; animation-delay: 5s;"></div>
                <div class="absolute w-1 h-1 bg-cyan-400 rounded-full animate-pulse" style="top: 10%; left: 50%; animation-delay: 6s;"></div>
                <div class="absolute w-2 h-2 bg-orange-400 rounded-full animate-pulse" style="top: 50%; left: 30%; animation-delay: 7s;"></div>
            </div>
        </div>
<div class="container mx-auto px-4 py-8 space-y-8">
    <!-- Encabezado con logo y título -->
    <div class="flex flex-col items-center mb-8 animate-fade-in-down">
        <div class="relative mb-4">
            <div class="absolute -inset-2 bg-gradient-to-r from-yellow-400 via-purple-500 to-pink-500 rounded-full blur opacity-30 animate-pulse"></div>
            <div class="relative bg-white/10 backdrop-blur-sm p-1 rounded-full shadow-2xl" style="width: 100px; height: 100px;">
                <!-- Logo Canguro - Ruta corregida -->
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
</div>
            <!-- Sección de gestión principal -->
            <div class="relative group mb-12 animate-fade-in-up">
                <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-500"></div>
                <div class="relative bg-gray-800/80 backdrop-blur-lg border border-gray-700/50 p-6 rounded-2xl shadow-xl">
                    <h2 class="text-2xl font-bold mb-6 text-white flex items-center gap-2">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span class="bg-gradient-to-r from-purple-400 to-pink-500 bg-clip-text text-transparent">Gestionar Encomiendas</span>
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-700/50 p-4 rounded-xl border border-gray-600/50 hover:bg-gray-600/50 transition-all duration-300 transform hover:scale-[1.02]">
                            <h3 class="text-lg font-semibold text-white mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                Incidencias
                            </h3>
                            <p class="text-gray-400 text-sm">Gestión de problemas y seguimiento de incidencias</p>
                        </div>
                        <div class="bg-gray-700/50 p-4 rounded-xl border border-gray-600/50 hover:bg-gray-600/50 transition-all duration-300 transform hover:scale-[1.02]">
                            <h3 class="text-lg font-semibold text-white mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Reportes
                            </h3>
                            <p class="text-gray-400 text-sm">Generación de informes y estadísticas</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de encomiendas hoy -->
            <div class="mb-12 animate-fade-in-up" style="animation-delay: 200ms;">
                <h2 class="text-2xl font-bold mb-6 text-white flex items-center gap-2">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">Encomiendas Hoy</span>
                </h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @php
                        $cards = [
                            ['icon' => 'truck', 'title' => 'Entregas Pendientes', 'value' => $entregasPendientes, 'color' => 'green', 'gradient' => 'from-green-400 to-emerald-500'],
                            ['icon' => 'package', 'title' => 'Encomiendas (Semana)', 'value' => $encomiendasSemana, 'color' => 'blue', 'gradient' => 'from-blue-400 to-purple-500'],
                            ['icon' => 'warning', 'title' => 'Incidencias Abiertas', 'value' => $incidenciasAbiertas, 'color' => 'red', 'gradient' => 'from-red-400 to-pink-500'],
                            ['icon' => 'users', 'title' => 'Usuarios Recientes', 'value' => count($usuariosRecientes), 'color' => 'purple', 'gradient' => 'from-purple-400 to-pink-500'],
                        ];
                    @endphp
                    
                    @foreach ($cards as $index => $card)
                    <div class="relative group cursor-pointer" style="animation-delay: {{ ($index + 1) * 100 }}ms;">
                        <div class="absolute -inset-0.5 bg-gradient-to-r {{ $card['gradient'] }} rounded-xl blur opacity-20 group-hover:opacity-75 transition duration-300"></div>
                        <div class="relative bg-gray-800/80 backdrop-blur-lg p-5 rounded-xl shadow-lg border border-gray-700/50 transform group-hover:-translate-y-1 transition-all duration-300 hover:shadow-{{ $card['color'] }}-500/20">
                            <div class="flex items-center space-x-4">
                                <div class="bg-gradient-to-r {{ $card['gradient'] }} p-3 rounded-xl shadow-lg">
                                    @if($card['icon'] == 'truck') 
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2 2h8a1 1 0 001-1z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 8h1a4 4 0 010 8h-1"></path>
                                        </svg> 
                                    @endif
                                    @if($card['icon'] == 'package') 
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg> 
                                    @endif
                                    @if($card['icon'] == 'warning') 
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                        </svg> 
                                    @endif
                                    @if($card['icon'] == 'users') 
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg> 
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-400">{{ $card['title'] }}</p>
                                    <p class="text-2xl font-bold text-white">{{ $card['value'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Sección de encomiendas recientes -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 animate-fade-in-up" style="animation-delay: 400ms;">
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl blur opacity-20 group-hover:opacity-75 transition duration-300"></div>
                    <div class="relative bg-gray-800/80 backdrop-blur-lg border border-gray-700/50 p-6 rounded-2xl shadow-lg">
                        <h3 class="text-xl font-bold mb-4 text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span class="bg-gradient-to-r from-blue-400 to-cyan-500 bg-clip-text text-transparent">Usuarios Recientes</span>
                        </h3>
                        <div class="space-y-3">
                            @forelse ($usuariosRecientes as $index => $usuario)
                                @php
                                    $avatarColors = [
                                        'from-pink-400 to-purple-500',
                                        'from-green-400 to-blue-500',
                                        'from-yellow-400 to-orange-500',
                                        'from-red-400 to-pink-500',
                                        'from-blue-400 to-purple-500'
                                    ];
                                    $rolColors = [
                                        'admin' => 'bg-gradient-to-r from-red-400 to-pink-500',
                                        'operador' => 'bg-gradient-to-r from-blue-400 to-purple-500',
                                        'remitente' => 'bg-gradient-to-r from-green-400 to-emerald-500',
                                        'transportista' => 'bg-gradient-to-r from-yellow-400 to-orange-500'
                                    ];
                                @endphp
                                <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-700/50 transition-all duration-300 transform hover:scale-[1.02] animate-slide-in-right" style="animation-delay: {{ $index * 50 }}ms;">
                                    <div class="flex items-center space-x-3">
                                        <div class="relative">
                                            <div class="absolute -inset-0.5 bg-gradient-to-r {{ $avatarColors[$index % count($avatarColors)] }} rounded-full blur opacity-75 animate-pulse"></div>
                                            <span class="relative flex items-center justify-center h-10 w-10 rounded-full bg-gradient-to-r {{ $avatarColors[$index % count($avatarColors)] }} font-bold text-white border-2 border-gray-600 shadow-lg">
                                                {{ strtoupper(substr($usuario->name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-200">{{ $usuario->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $usuario->email }}</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 text-xs font-bold text-white {{ $rolColors[$usuario->rol] ?? 'bg-gradient-to-r from-gray-400 to-gray-500' }} rounded-full shadow-lg">
                                        {{ ucfirst($usuario->rol) }}
                                    </span>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-400 mx-auto mb-4"></div>
                                    <p class="text-gray-500">No hay usuarios recientes</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl blur opacity-20 group-hover:opacity-75 transition duration-300"></div>
                    <div class="relative bg-gray-800/80 backdrop-blur-lg border border-gray-700/50 p-6 rounded-2xl shadow-lg">
                        <h3 class="text-xl font-bold mb-4 text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <span class="bg-gradient-to-r from-purple-400 to-pink-500 bg-clip-text text-transparent">Encomiendas Recientes</span>
                        </h3>
                        <div class="space-y-3">
                            @forelse ($encomiendasRecientes as $index => $encomienda)
                            @php
                                $statusColors = [
                                    'pendiente' => 'bg-gradient-to-r from-gray-400 to-gray-500',
                                    'en_proceso' => 'bg-gradient-to-r from-blue-400 to-purple-500',
                                    'en_transito' => 'bg-gradient-to-r from-purple-400 to-pink-500',
                                    'entregado' => 'bg-gradient-to-r from-green-400 to-emerald-500',
                                    'incidencia' => 'bg-gradient-to-r from-red-400 to-pink-500',
                                ];
                                $iconColors = [
                                    'from-yellow-400 to-orange-500',
                                    'from-green-400 to-blue-500',
                                    'from-purple-400 to-pink-500',
                                    'from-blue-400 to-purple-500',
                                    'from-red-400 to-pink-500'
                                ];
                            @endphp
                                <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-700/50 transition-all duration-300 transform hover:scale-[1.02] animate-slide-in-left" style="animation-delay: {{ $index * 50 }}ms;">
                                    <div class="flex items-center space-x-3">
                                        <div class="relative">
                                            <div class="absolute -inset-0.5 bg-gradient-to-r {{ $iconColors[$index % count($iconColors)] }} rounded-full blur opacity-75 animate-pulse"></div>
                                            <div class="relative p-2 bg-gradient-to-r {{ $iconColors[$index % count($iconColors)] }} rounded-full border-2 border-gray-600 shadow-lg">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-200">De: <span class="text-white">{{ $encomienda->remitente->name ?? 'N/A' }}</span></p>
                                            <p class="text-xs text-gray-500">#{{ $encomienda->numero_seguimiento }}</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 text-xs font-bold text-white {{ $statusColors[$encomienda->estado] ?? 'bg-gradient-to-r from-gray-400 to-gray-500' }} rounded-full shadow-lg">
                                        {{ str_replace('_', ' ', ucfirst($encomienda->estado)) }}
                                    </span>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-purple-400 mx-auto mb-4"></div>
                                    <p class="text-gray-500">No hay encomiendas recientes</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

    
    <style>
        @keyframes fade-in-down {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slide-in-right {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slide-in-left {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .animate-fade-in-down {
            animation: fade-in-down 0.6s ease-out forwards;
        }
        
        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
        }
        
        .animate-slide-in-right {
            animation: slide-in-right 0.6s ease-out forwards;
        }
        
        .animate-slide-in-left {
            animation: slide-in-left 0.6s ease-out forwards;
        }
    </style>
</x-app-layout>