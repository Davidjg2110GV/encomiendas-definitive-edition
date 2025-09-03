<!-- Sidebar -->
<div class="w-64 bg-gray-900/80 backdrop-blur-lg flex flex-col flex-shrink-0 border-r border-gray-700/50">
    <!-- Logo y Título con efecto gradiente -->
    <div class="flex items-center justify-center h-20 border-b border-gray-700/50 relative">
        <div class="absolute -inset-1 bg-gradient-to-r from-yellow-400 via-purple-500 to-pink-500 rounded-lg blur opacity-20"></div>
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 z-10">
            <div class="relative">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full blur opacity-30"></div>
                <img src="{{ asset('imagenes/Canguro.png') }}" alt="Logo Canguro Envíos" class="h-10 w-auto relative">
            </div>
            <span class="text-xl font-bold tracking-wider bg-gradient-to-r from-yellow-400 via-orange-500 to-red-500 bg-clip-text text-transparent">Canguro<span class="text-transparent">Panel</span></span>
        </a>
    </div>

    <!-- Navegación Principal -->
    <nav class="flex-grow px-4 py-6 space-y-1">
        @if (Auth::user()->isAdmin())
            {{-- ==================== MENÚ DE ADMINISTRADOR ==================== --}}
            <x-nav-link-sidebar :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" icon="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" gradient="from-yellow-400 to-orange-500">Dashboard</x-nav-link-sidebar>
            <x-nav-link-sidebar :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" icon="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" gradient="from-blue-400 to-purple-500">Usuarios</x-nav-link-sidebar>
            <x-nav-link-sidebar :href="route('admin.encomiendas.create')" :active="request()->routeIs('admin.encomiendas.create')" icon="M12 6v6m0 0v6m0-6h6m-6 0H6" gradient="from-green-400 to-emerald-500">Nueva Encomienda</x-nav-link-sidebar>
            <x-nav-link-sidebar :href="route('admin.encomiendas.index')" :active="request()->routeIs('admin.encomiendas.index')" icon="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" gradient="from-purple-400 to-pink-500">Gestionar Encomiendas</x-nav-link-sidebar>
            <x-nav-link-sidebar :href="route('admin.incidencias.index')" :active="request()->routeIs('admin.incidencias.*')" icon="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" gradient="from-red-400 to-pink-500">Incidencias</x-nav-link-sidebar>
            <x-nav-link-sidebar :href="route('reports.index')" :active="request()->routeIs('reports.index')" icon="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" gradient="from-indigo-400 to-blue-500">Reportes</x-nav-link-sidebar>
        
        @elseif (Auth::user()->isOperador())
            {{-- MENÚ DE OPERADOR --}}
            <x-nav-link-sidebar :href="route('operador.dashboard')" :active="request()->routeIs('operador.dashboard')" icon="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" gradient="from-yellow-400 to-orange-500">Dashboard</x-nav-link-sidebar>
            <x-nav-link-sidebar :href="route('operador.encomiendas.create')" :active="request()->routeIs('operador.encomiendas.create')" icon="M12 6v6m0 0v6m0-6h6m-6 0H6" gradient="from-green-400 to-emerald-500">Registrar Encomienda</x-nav-link-sidebar>
            <x-nav-link-sidebar :href="route('operador.encomiendas.index')" :active="request()->routeIs('operador.encomiendas.*')" icon="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" gradient="from-purple-400 to-pink-500">Gestionar Encomiendas</x-nav-link-sidebar>
            <x-nav-link-sidebar :href="route('reports.index')" :active="request()->routeIs('reports.index')" icon="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" gradient="from-indigo-400 to-blue-500">Generar Reportes</x-nav-link-sidebar>

        @elseif (Auth::user()->isRemitente())
            {{-- MENÚ DE REMITENTE --}}
            <x-nav-link-sidebar :href="route('remitente.dashboard')" :active="request()->routeIs('remitente.dashboard')" icon="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" gradient="from-yellow-400 to-orange-500">Dashboard</x-nav-link-sidebar>
            <x-nav-link-sidebar :href="route('remitente.encomiendas.index')" :active="request()->routeIs('remitente.encomiendas.*')" icon="M4 6h16M4 10h16M4 14h16M4 18h16" gradient="from-blue-400 to-purple-500">Mis Envíos</x-nav-link-sidebar>

       @elseif (Auth::user()->isTransportista())
    {{-- ==================== MENÚ DE TRANSPORTISTA ==================== --}}
    
    {{-- Enlace al Dashboard --}}
    <x-nav-link-sidebar :href="route('transportista.dashboard')" :active="request()->routeIs('transportista.dashboard')" icon="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" gradient="from-yellow-400 to-orange-500">
        Dashboard
    </x-nav-link-sidebar>

    {{-- Enlace para Gestionar Encomiendas --}}
    <x-nav-link-sidebar :href="route('transportista.encomiendas.index')" :active="request()->routeIs('transportista.encomiendas.*')" icon="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" gradient="from-purple-400 to-pink-500">
        Gestionar Encomiendas
    </x-nav-link-sidebar>
    
    {{-- Enlace para Reportes --}}
    {{-- La ruta aquí es 'reportes.index', como la del admin, porque no está prefijada por rol en tu routes/web.php --}}
    {{-- Si el transportista debe tener una ruta de reporte prefijada, tendrías que cambiarlo en web.php y aquí. --}}
    <x-nav-link-sidebar :href="route('transportista.reportes.index')" :active="request()->routeIs('transportista.reportes.index')" icon="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" gradient="from-indigo-400 to-blue-500">
        Reportes
    </x-nav-link-sidebar>

@endif
    </nav>
    
    <!-- Perfil de Usuario en el Sidebar -->
    <div class="p-4 border-t border-gray-700/50">
        <a href="{{ route('profile.edit') }}" class="group flex items-center w-full p-2 rounded-lg hover:bg-gray-700/50 transition-all duration-300">
            <div class="relative">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full blur opacity-30 group-hover:opacity-50"></div>
                <span class="relative flex items-center justify-center h-10 w-10 rounded-full bg-gradient-to-r from-yellow-400 to-orange-500 font-bold text-gray-900">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-gray-900"></span>
            </div>
            <div class="ml-3">
                <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-400">{{ ucfirst(Auth::user()->rol) }}</p>
            </div>
        </a>
    </div>
</div>