<x-app-layout>
    {{-- Contenedor principal con fondo de efecto aurora --}}
    <div class="relative min-h-screen overflow-hidden">
        <div class="absolute inset-0 -z-10 h-full w-full bg-gradient-to-br from-slate-900 via-green-900 to-slate-900">
            {{-- Efecto de grid sutil y partículas animadas --}}
            <div class="absolute bottom-0 left-0 right-0 top-0 bg-[linear-gradient(to_right,#4f4f4f2e_1px,transparent_1px),linear-gradient(to_bottom,#4f4f4f2e_1px,transparent_1px)] bg-[size:14px_24px] [mask-image:radial-gradient(ellipse_80%_50%_at_50%_0%,#000_70%,transparent_110%)]"></div>
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute w-2 h-2 bg-yellow-400 rounded-full animate-pulse" style="top: 20%; left: 10%;"></div>
                <div class="absolute w-1 h-1 bg-cyan-400 rounded-full animate-pulse" style="top: 30%; left: 80%; animation-delay: 1s;"></div>
                <div class="absolute w-3 h-3 bg-green-400 rounded-full animate-pulse" style="top: 60%; left: 20%; animation-delay: 2s;"></div>
                <div class="absolute w-2 h-2 bg-pink-400 rounded-full animate-pulse" style="top: 80%; left: 70%; animation-delay: 3s;"></div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8 space-y-8">
            <!-- Encabezado con logo y bienvenida personalizada -->
            <div class="flex flex-col items-center mb-8 animate-fade-in-down">
                <div class="relative mb-4">
                    <div class="absolute -inset-2 bg-gradient-to-r from-yellow-400 via-green-500 to-cyan-500 rounded-full blur opacity-30 animate-pulse"></div>
                    <div class="relative bg-white/10 backdrop-blur-sm p-1 rounded-full shadow-2xl" style="width: 100px; height: 100px;">
                        <img src="{{ asset('imagenes/canguro.png') }}" alt="Logo CanguroPanel" class="w-full h-full object-contain p-2 rounded-full">
                    </div>
                </div>
                <h1 class="text-4xl font-bold text-center bg-gradient-to-r from-yellow-300 via-green-400 to-cyan-400 bg-clip-text text-transparent">
                    Mi Panel de Envíos
                </h1>
                <p class="text-gray-400 mt-2 text-center">Hola, {{ Auth::user()->name }}. Aquí puedes seguir el estado de tus encomiendas.</p>
            </div>

            <!-- Métricas Clave para el Remitente -->
            <div class="mb-12 animate-fade-in-up" style="animation-delay: 200ms;">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @php
                        $cards = [
                            ['icon' => 'truck', 'title' => 'Envíos en Camino', 'value' => $encomiendasPendientes, 'gradient' => 'from-blue-400 to-purple-500'],
                            ['icon' => 'check-circle', 'title' => 'Envíos Entregados', 'value' => $entregasCompletadas, 'gradient' => 'from-green-400 to-emerald-500'],
                            ['icon' => 'view-list', 'title' => 'Ver Todos mis Envíos', 'value' => 'Mi Historial', 'link' => route('remitente.encomiendas.index'), 'gradient' => 'from-yellow-400 to-orange-500'],
                        ];
                    @endphp
                    
                    @foreach ($cards as $index => $card)
                    <a href="{{ $card['link'] ?? '#' }}" class="relative group cursor-pointer block animate-fade-in-up" style="animation-delay: {{ ($index + 1) * 100 }}ms;">
                        <div class="absolute -inset-0.5 bg-gradient-to-r {{ $card['gradient'] }} rounded-xl blur opacity-20 group-hover:opacity-75 transition duration-300"></div>
                        <div class="relative bg-gray-800/80 backdrop-blur-lg p-5 h-full rounded-xl shadow-lg border border-gray-700/50 transform group-hover:-translate-y-1 transition-all duration-300">
                            <div class="flex items-center space-x-4">
                                <div class="bg-gradient-to-r {{ $card['gradient'] }} p-3 rounded-xl shadow-lg">
                                    {{-- Iconos SVG para cada tarjeta --}}
                                    @if($card['icon'] == 'truck') <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2 2h8a1 1 0 001-1z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 8h1a4 4 0 010 8h-1"></path></svg> @endif
                                    @if($card['icon'] == 'check-circle') <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> @endif
                                    @if($card['icon'] == 'view-list') <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg> @endif
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-400">{{ $card['title'] }}</p>
                                    <p class="text-2xl font-bold text-white">{{ $card['value'] }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Tabla de Mis Últimas Encomiendas -->
            <div class="animate-fade-in-up" style="animation-delay: 400ms;">
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-green-500 to-cyan-500 rounded-2xl blur opacity-20 group-hover:opacity-75 transition duration-300"></div>
                    <div class="relative bg-gray-800/80 backdrop-blur-lg border border-gray-700/50 p-6 rounded-2xl shadow-lg">
                        <h3 class="text-xl font-bold mb-4 text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            <span class="bg-gradient-to-r from-green-400 to-cyan-500 bg-clip-text text-transparent">Mis Envíos Recientes</span>
                        </h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-700/50">
                                <thead class="bg-gray-900/40">
                                    <tr>
                                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Seguimiento</th>
                                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Destinatario</th>
                                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Estado</th>
                                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Acción</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-800/50 divide-y divide-gray-700/50">
                                    @forelse ($misEncomiendas as $encomienda)
                                        @php
                                            $statusColors = [
                                                'en_proceso' => 'bg-blue-500/80',
                                                'en_transito' => 'bg-purple-500/80',
                                                'entregado' => 'bg-green-500/80',
                                                'incidencia' => 'bg-red-500/80',
                                                'cancelado' => 'bg-gray-600/80',
                                            ];
                                        @endphp
                                        <tr class="hover:bg-gray-700/50 transition-colors duration-200">
                                            <td class="px-5 py-4 whitespace-nowrap text-sm font-semibold text-yellow-400">{{ $encomienda->numero_seguimiento }}</td>
                                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-300">{{ $encomienda->destinatario }}</td>
                                            <td class="px-5 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-bold rounded-full text-white {{ $statusColors[$encomienda->estado] ?? 'bg-gray-500/80' }}">
                                                    {{ str_replace('_', ' ', ucfirst($encomienda->estado)) }}
                                                </span>
                                            </td>
                                            <td class="px-5 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('remitente.encomiendas.show', $encomienda) }}" class="text-cyan-400 hover:text-cyan-300 hover:underline">
                                                    Rastrear
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-5 py-10 text-center text-gray-500">Aún no has realizado ningún envío.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Animaciones CSS --}}
    <style>
        @keyframes fade-in-down { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fade-in-up { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in-down { animation: fade-in-down 0.6s ease-out forwards; }
        .animate-fade-in-up { animation: fade-in-up 0.6s ease-out forwards; }
    </style>
</x-app-layout>