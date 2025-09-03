<x-guest-layout>
    <!-- Título y descripción -->
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-white">Confirmar Contraseña</h1>
    </div>

    <div class="mb-4 text-sm text-gray-400">
        {{ __('Esta es un área segura de la aplicación. Por favor, confirma tu contraseña antes de continuar.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Contraseña -->
        <div>
            <x-input-label for="password" value="Contraseña" class="text-gray-300"/>

            <x-text-input id="password" class="block mt-1 w-full bg-gray-900 border-gray-700 text-white focus:border-yellow-400 focus:ring-yellow-400"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-6">
            {{-- Botón de Confirmar --}}
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-gray-900 uppercase tracking-widest hover:bg-yellow-500 focus:bg-yellow-500 active:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
                {{ __('Confirmar') }}
            </button>
        </div>
    </form>
</x-guest-layout>