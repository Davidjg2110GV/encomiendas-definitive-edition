<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center animate__animated animate__fadeInDown">
            <svg class="w-6 h-6 text-yellow-400 mr-3 transform transition-transform duration-500 hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
            <h2 class="font-semibold text-xl text-white leading-tight animate-pulse">
                Registrar Nueva Encomienda
            </h2>
        </div>
    </x-slot>

    <div class="py-12 animate__animated animate__fadeIn">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/80 backdrop-blur-sm border border-gray-700/50 overflow-hidden shadow-2xl sm:rounded-2xl transition-all duration-300 hover:shadow-yellow-400/20">
                
                @php
                    // Lógica para determinar la ruta correcta según el rol del usuario
                    $user = Auth::user();
                    if ($user->isAdmin()) {
                        $storeRoute = route('admin.encomiendas.store');
                        $cancelRoute = route('admin.encomiendas.index');
                    } elseif ($user->isOperador()) {
                        $storeRoute = route('operador.encomiendas.store');
                        $cancelRoute = route('operador.encomiendas.index');
                    } else { // Asumiendo que remitente es el otro caso
                        $storeRoute = route('remitente.encomiendas.store');
                        $cancelRoute = route('remitente.encomiendas.index');
                    }
                @endphp
                
                <form method="POST" action="{{ $storeRoute }}" class="p-6 lg:p-8 space-y-6" id="encomiendaForm">
                    @csrf

                    <!-- Campo oculto para el estado (siempre pendiente al crear) -->
                    <input type="hidden" name="estado" value="pendiente">

                    <!-- Sección 1: Información Básica -->
                    <h3 class="text-lg font-semibold text-yellow-400 border-b-2 border-yellow-400/20 pb-2 flex items-center animate__animated animate__fadeInLeft">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Información Básica
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp">
                            <label for="remitente_id" class="block text-sm font-medium text-gray-300 mb-1">Remitente *</label>
                            <select id="remitente_id" name="remitente_id" required class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150">
                                <option value="" disabled selected>-- Seleccionar Remitente --</option>
                                @foreach ($remitentes as $remitente)
                                    <option value="{{ $remitente->id }}" {{ old('remitente_id') == $remitente->id ? 'selected' : '' }}>{{ $remitente->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('remitente_id')" class="mt-2" />
                        </div>
                        
                        <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp animate__delay-100ms">
                            <label for="destinatario" class="block text-sm font-medium text-gray-300 mb-1">Destinatario *</label>
                            <input type="text" id="destinatario" name="destinatario" value="{{ old('destinatario') }}" required 
                                   class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150">
                            <x-input-error :messages="$errors->get('destinatario')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Sección 2: Detalles del Envío -->
                    <h3 class="text-lg font-semibold text-yellow-400 border-b-2 border-yellow-400/20 pb-2 flex items-center animate__animated animate__fadeInLeft">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        Detalles del Envío
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp">
                            <label for="tipo" class="block text-sm font-medium text-gray-300 mb-1">Tipo *</label>
                            <select id="tipo" name="tipo" required 
                                    class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150">
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="documento" {{ old('tipo') == 'documento' ? 'selected' : '' }}>Documento</option>
                                <option value="paquete" {{ old('tipo') == 'paquete' ? 'selected' : '' }}>Paquete</option>
                                <option value="caja" {{ old('tipo') == 'caja' ? 'selected' : '' }}>Caja</option>
                                <option value="sobre" {{ old('tipo') == 'sobre' ? 'selected' : '' }}>Sobre</option>
                                <option value="otro" {{ old('tipo') == 'otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                        </div>
                        
                        <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp animate__delay-100ms">
                            <label for="peso" class="block text-sm font-medium text-gray-300 mb-1">Peso (kg) *</label>
                            <input type="number" id="peso" name="peso" value="{{ old('peso') }}" required step="0.01" min="0.01"
                                   class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150">
                            <x-input-error :messages="$errors->get('peso')" class="mt-2" />
                        </div>
                        
                        <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp animate__delay-200ms">
                            <label for="costo" class="block text-sm font-medium text-gray-300 mb-1">Costo</label>
                            <input type="number" id="costo" name="costo" value="{{ old('costo') }}" step="0.01" min="0" placeholder="0.00"
                                   class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150">
                            <x-input-error :messages="$errors->get('costo')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Sección 3: Dirección y Contacto -->
                    <h3 class="text-lg font-semibold text-yellow-400 border-b-2 border-yellow-400/20 pb-2 flex items-center animate__animated animate__fadeInLeft">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Dirección y Contacto
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp">
                            <label for="direccion_destino" class="block text-sm font-medium text-gray-300 mb-1">Dirección *</label>
                            <textarea id="direccion_destino" name="direccion_destino" rows="3" required
                                      class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150">{{ old('direccion_destino') }}</textarea>
                            <x-input-error :messages="$errors->get('direccion_destino')" class="mt-2" />
                        </div>
                        
                        <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp animate__delay-100ms">
                            <label for="telefono_destinatario" class="block text-sm font-medium text-gray-300 mb-1">Teléfono *</label>
                            <input type="text" id="telefono_destinatario" name="telefono_destinatario" value="{{ old('telefono_destinatario') }}" required
                                   class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150">
                            <x-input-error :messages="$errors->get('telefono_destinatario')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Sección 4: Fechas -->
                    <h3 class="text-lg font-semibold text-yellow-400 border-b-2 border-yellow-400/20 pb-2 flex items-center animate__animated animate__fadeInLeft">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Fechas
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp">
                            <label for="fecha_envio" class="block text-sm font-medium text-gray-300 mb-1">Fecha de Envío (Opcional)</label>
                            <input type="datetime-local" id="fecha_envio" name="fecha_envio" value="{{ old('fecha_envio') }}"
                                   class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150">
                            <x-input-error :messages="$errors->get('fecha_envio')" class="mt-2" />
                        </div>
                        
                        <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp animate__delay-100ms">
                            <label for="fecha_entrega_estimada" class="block text-sm font-medium text-gray-300 mb-1">Fecha Estimada *</label>
                            <input type="date" id="fecha_entrega_estimada" name="fecha_entrega_estimada" 
                                   min="{{ date('Y-m-d') }}" value="{{ old('fecha_entrega_estimada') }}" required
                                   class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150">
                            <x-input-error :messages="$errors->get('fecha_entrega_estimada')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Sección 5: Descripción -->
                    <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp animate__delay-300ms">
                        <label for="descripcion" class="block text-sm font-medium text-gray-300 mb-1">Descripción (Opcional)</label>
                        <textarea id="descripcion" name="descripcion" rows="3"
                                  class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150">{{ old('descripcion') }}</textarea>
                        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex items-center justify-end pt-6 border-t border-gray-700/50 space-x-4 animate__animated animate__fadeInUp">
                        <a href="{{ $cancelRoute }}" class="text-gray-400 hover:text-white transition-colors duration-300 flex items-center hover:underline">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Cancelar
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 bg-yellow-400 text-gray-900 font-bold py-2 px-4 rounded-lg shadow-lg hover:bg-yellow-300 transition-all duration-300 transform hover:scale-105 active:scale-95">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Registrar Encomienda
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Animaciones CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Manejar envío del formulario
            document.getElementById('encomiendaForm').addEventListener('submit', function(e) {
                const submitButton = this.querySelector('button[type="submit"]');
                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Procesando...
                `;
            });
            
            // Animación al cargar la página
            const elements = document.querySelectorAll('.animate__animated');
            elements.forEach((el, index) => {
                setTimeout(() => {
                    el.style.opacity = 1;
                }, index * 100);
            });

            // Establecer fecha mínima para la fecha estimada de entrega
            const fechaEstimadaInput = document.getElementById('fecha_entrega_estimada');
            if (!fechaEstimadaInput.value) {
                const today = new Date();
                const tomorrow = new Date(today);
                tomorrow.setDate(tomorrow.getDate() + 1);
                fechaEstimadaInput.valueAsDate = tomorrow;
            }
        });
    </script>
</x-app-layout>