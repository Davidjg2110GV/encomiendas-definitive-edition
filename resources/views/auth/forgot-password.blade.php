<x-guest-layout>
    <!-- Título y descripción -->
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-white">Recuperar Contraseña</h1>
    </div>

    <div class="mb-4 text-sm text-gray-400">
        {{ __('¿Olvidaste tu contraseña? No hay problema. Solo dinos tu dirección de correo electrónico y te enviaremos un enlace para que puedas elegir una nueva.') }}
    </div>

    <!-- Session Status: Muestra mensajes como "¡Te hemos enviado el enlace!" -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Correo Electrónico" class="text-gray-300"/>
            <x-text-input id="email" class="block mt-1 w-full bg-gray-900 border-gray-700 text-white focus:border-yellow-400 focus:ring-yellow-400" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            {{-- Botón de Enviar Enlace --}}
            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-gray-900 uppercase tracking-widest hover:bg-yellow-500 focus:bg-yellow-500 active:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
                {{ __('Enviar Enlace de Recuperación') }}
            </button>
        </div>
    </form>
    
    <!-- Enlace para volver a Iniciar Sesión -->
    <div class="text-center mt-6">
        <a class="underline text-sm text-gray-400 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" href="{{ route('login') }}">
            Volver a Iniciar Sesión
        </a>
    </div>
</x-guest-layout>