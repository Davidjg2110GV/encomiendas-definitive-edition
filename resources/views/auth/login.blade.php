<x-guest-layout>
    <!-- Título y descripción con un toque más de estilo -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-white tracking-tight">¡Bienvenido de Nuevo!</h1>
        <p class="text-gray-400 mt-2">Gestiona tus envíos con <span class="font-semibold text-yellow-400">Canguro</span>.</p>
    </div>

    <!-- Mensaje de estado (ej: después de resetear contraseña) -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Correo Electrónico" class="text-gray-300" />
            <div class="relative mt-2">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                </span>
                <x-text-input id="email" class="block w-full pl-10 bg-gray-900 border-gray-700 text-white focus:border-yellow-400 focus:ring-yellow-400" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div>
            <x-input-label for="password" value="Contraseña" class="text-gray-300" />
            <div class="relative mt-2">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                     <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </span>
                <x-text-input id="password" class="block w-full pl-10 bg-gray-900 border-gray-700 text-white focus:border-yellow-400 focus:ring-yellow-400" type="password" name="password" required autocomplete="current-password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Opciones (Recuérdame y Olvidé Contraseña) -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded bg-gray-900 border-gray-700 text-yellow-400 shadow-sm focus:ring-yellow-400 focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-400">{{ __('Recuérdame') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-400 hover:text-yellow-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>
        
        <!-- Botón de Iniciar Sesión -->
        <div>
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-sm font-bold text-gray-900 bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-yellow-400 transition-all duration-300 transform hover:scale-105">
                Iniciar Sesión
            </button>
        </div>

        <!-- Enlace para registrarse -->
         <p class="text-center text-sm text-gray-400">
            ¿No tienes una cuenta?
            <a href="#" onclick="promptForRegister(event)" class="font-semibold text-yellow-400 hover:underline">
                Regístrate aquí
            </a>
        </p>
    </form>
    
    {{-- Script de verificación (necesario para el enlace de registro) --}}
    <script>
        function promptForRegister(event) {
            event.preventDefault();
            const secretPassword = "211200zai.2024@xcANGur.*";
            const enteredPassword = prompt("Por favor, introduce la contraseña de administrador para registrarte:");
            if (enteredPassword === null || enteredPassword === "") { return; }
            if (enteredPassword === secretPassword) {
                window.location.href = "{{ route('register') }}";
            } else {
                alert("Contraseña incorrecta. No tienes permiso para registrarte.");
            }
        }
    </script>
</x-guest-layout>