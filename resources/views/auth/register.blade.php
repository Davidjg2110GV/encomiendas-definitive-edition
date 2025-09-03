<x-guest-layout>
    <!-- Título y descripción -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-white tracking-tight">Crea tu Cuenta</h1>
        <p class="text-gray-400 mt-2">Únete a la plataforma de <span class="font-semibold text-yellow-400">Canguro Envíos</span>.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Nombre Completo -->
        <div>
            <x-input-label for="name" value="Nombre Completo" class="text-gray-300" />
            <div class="relative mt-2">
                 <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </span>
                <x-text-input id="name" class="block w-full pl-10 bg-gray-900 border-gray-700 text-white focus:border-yellow-400 focus:ring-yellow-400" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Correo Electrónico" class="text-gray-300" />
            <div class="relative mt-2">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                </span>
                <x-text-input id="email" class="block w-full pl-10 bg-gray-900 border-gray-700 text-white focus:border-yellow-400 focus:ring-yellow-400" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        <!-- Selección de Rol -->
        <div>
            <x-input-label for="rol" value="Tipo de Cuenta" class="text-gray-300" />
            <select id="rol" name="rol" class="block mt-2 w-full bg-gray-900 border-gray-700 text-white focus:border-yellow-400 focus:ring-yellow-400 rounded-md shadow-sm" required>
                <option value="" disabled selected class="text-gray-500">Seleccione un rol...</option>
                <option value="Remitente" @selected(old('rol') == 'Remitente')>Remitente (Para registrar envíos)</option>
                <option value="operador" @selected(old('rol') == 'operador')>Operador (Para gestionar logística)</option>
                <option value="transportista" @selected(old('rol') == 'transportista')>Transportista (Para realizar entregas)</option>
                <option value="admin" @selected(old('rol') == 'admin')>Administrador (Control total)</option>
            </select>
            <x-input-error :messages="$errors->get('rol')" class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div>
            <x-input-label for="password" value="Contraseña" class="text-gray-300" />
            <div class="relative mt-2">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                     <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </span>
                <x-text-input id="password" class="block w-full pl-10 bg-gray-900 border-gray-700 text-white focus:border-yellow-400 focus:ring-yellow-400" type="password" name="password" required autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Contraseña -->
        <div>
            <x-input-label for="password_confirmation" value="Confirmar Contraseña" class="text-gray-300" />
            <div class="relative mt-2">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                     <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </span>
                <x-text-input id="password_confirmation" class="block w-full pl-10 bg-gray-900 border-gray-700 text-white focus:border-yellow-400 focus:ring-yellow-400" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        
        <!-- Botón de Registrarse -->
        <div>
            <button type="submit" class="mt-4 w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-sm font-bold text-gray-900 bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-yellow-400 transition-all duration-300 transform hover:scale-105">
                Crear Cuenta
            </button>
        </div>

        <!-- Enlace para Iniciar Sesión -->
         <p class="text-center text-sm text-gray-400">
            ¿Ya tienes una cuenta?
            <a href="{{ route('login') }}" class="font-semibold text-yellow-400 hover:underline">
                Inicia sesión aquí
            </a>
        </p>
    </form>
</x-guest-layout>