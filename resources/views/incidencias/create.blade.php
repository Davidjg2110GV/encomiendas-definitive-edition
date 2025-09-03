<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Reportar Nueva Incidencia
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/60 backdrop-blur-sm border border-gray-700/50 shadow-2xl sm:rounded-2xl p-6">
                <form action="{{ route('incidencias.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="encomienda_id" class="block text-gray-300 text-sm font-bold mb-2">
                            Encomienda Asociada:
                        </label>
                        <select name="encomienda_id" id="encomienda_id"
                                class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-200 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-gray-700">
                            <option value="">Seleccione una encomienda</option>
                            @foreach ($encomiendas as $encomienda)
                                <option value="{{ $encomienda->id }}" {{ old('encomienda_id') == $encomienda->id ? 'selected' : '' }}>
                                    {{ $encomienda->numero_seguimiento }}
                                </option>
                            @endforeach
                        </select>
                        @error('encomienda_id')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tipo" class="block text-gray-300 text-sm font-bold mb-2">
                            Tipo de Incidencia:
                        </label>
                        <select name="tipo" id="tipo"
                                class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-200 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-gray-700">
                            <option value="">Seleccione el tipo</option>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo }}" {{ old('tipo') == $tipo ? 'selected' : '' }}>
                                    {{ ucfirst($tipo) }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="descripcion" class="block text-gray-300 text-sm font-bold mb-2">
                            Descripción:
                        </label>
                        <textarea name="descripcion" id="descripcion" rows="5"
                                  class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-200 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-gray-700"
                                  placeholder="Detalles de la incidencia...">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                                class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition-colors duration-300">
                            Reportar Incidencia
                        </button>
                        <a href="{{ route('incidencias.index') }}"
                           class="inline-block align-baseline font-bold text-sm text-gray-400 hover:text-gray-200 transition-colors duration-300">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>