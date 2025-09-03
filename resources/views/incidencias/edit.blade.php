<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Editar Incidencia #{{ $incidencia->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/60 backdrop-blur-sm border border-gray-700/50 shadow-2xl sm:rounded-2xl p-6">
                <form action="{{ route('incidencias.update', $incidencia) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Importante para que Laravel reconozca la petición como UPDATE --}}

                    <div class="mb-4">
                        <label for="encomienda_id" class="block text-gray-300 text-sm font-bold mb-2">
                            Encomienda Asociada:
                        </label>
                        {{-- El select para encomiendas se muestra deshabilitado para no cambiar la encomienda de una incidencia existente,
                             a menos que seas admin. Puedes ajustar esta lógica según tus necesidades. --}}
                        <select name="encomienda_id" id="encomienda_id"
                                class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-200 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-gray-700"
                                {{ Auth::user()->isAdmin() ? '' : 'disabled' }}>
                            @foreach ($encomiendas as $encom)
                                <option value="{{ $encom->id }}" {{ (old('encomienda_id', $incidencia->encomienda_id) == $encom->id) ? 'selected' : '' }}>
                                    {{ $encom->numero_seguimiento }}
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
                            @foreach ($tipos as $tipoOption)
                                <option value="{{ $tipoOption }}" {{ (old('tipo', $incidencia->tipo) == $tipoOption) ? 'selected' : '' }}>
                                    {{ ucfirst($tipoOption) }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="block text-gray-300 text-sm font-bold mb-2">
                            Descripción:
                        </label>
                        <textarea name="descripcion" id="descripcion" rows="5"
                                  class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-200 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-gray-700"
                                  placeholder="Detalles de la incidencia...">{{ old('descripcion', $incidencia->descripcion) }}</textarea>
                        @error('descripcion')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="estado" class="block text-gray-300 text-sm font-bold mb-2">
                            Estado:
                        </label>
                        <select name="estado" id="estado"
                                class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-200 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-gray-700">
                            @foreach ($estados as $estadoOption)
                                <option value="{{ $estadoOption }}" {{ (old('estado', $incidencia->estado) == $estadoOption) ? 'selected' : '' }}>
                                    {{ ucfirst($estadoOption) }}
                                </option>
                            @endforeach
                        </select>
                        @error('estado')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                                class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition-colors duration-300">
                            Actualizar Incidencia
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