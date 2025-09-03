<x-app-layout>
    @php
        $user = Auth::user();
        $isOperator = $user->isOperador();
        $isTransportista = $user->isTransportista();
        $isAdmin = $user->isAdmin();

        // Determinar qué campos deshabilitar (no aplica para admin)
        $isDisabled = ($isOperator || $isTransportista) && !$isAdmin;

        // Determinar la ruta correcta para la acción del formulario
        if ($isOperator) {
            $updateRoute = route('operador.encomiendas.update', $encomienda->id);
            $cancelRoute = route('operador.encomiendas.index');
        } elseif ($isTransportista) {
            $updateRoute = route('transportista.encomiendas.update', $encomienda->id);
            $cancelRoute = route('transportista.encomiendas.index');
        } else {
            $updateRoute = route('admin.encomiendas.update', $encomienda->id);
            $cancelRoute = route('admin.encomiendas.index');
        }

        $formatDateTimeLocal = fn($date) => $date ? \Carbon\Carbon::parse($date)->format('Y-m-d\TH:i') : '';
        $formatDate = fn($date) => $date ? \Carbon\Carbon::parse($date)->format('Y-m-d') : '';
    @endphp

    <x-slot name="header">
        <div class="flex items-center animate__animated animate__fadeInDown">
            <svg class="w-6 h-6 text-yellow-400 mr-3 transform transition-transform duration-500 hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            <h2 class="font-semibold text-xl text-white leading-tight animate-pulse">
                Editar Encomienda #{{ $encomienda->id }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 animate__animated animate__fadeIn">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/80 backdrop-blur-sm border border-gray-700/50 overflow-hidden shadow-2xl sm:rounded-2xl transition-all duration-300 hover:shadow-yellow-400/20">
                
                <form method="POST" action="{{ $updateRoute }}" class="p-6 lg:p-8 space-y-6" id="encomiendaForm" 
                      x-data="encomiendaForm({
                        initialData: {
                            remitente_id: '{{ old('remitente_id', $encomienda->remitente_id) }}',
                            destinatario: '{{ old('destinatario', $encomienda->destinatario) }}',
                            tipo: '{{ old('tipo', $encomienda->tipo) }}',
                            peso: '{{ old('peso', $encomienda->peso) }}',
                            costo: '{{ old('costo', $encomienda->costo) }}',
                            direccion_destino: `{{ old('direccion_destino', $encomienda->direccion_destino) }}`,
                            telefono_destinatario: '{{ old('telefono_destinatario', $encomienda->telefono_destinatario) }}',
                            fecha_envio: '{{ old('fecha_envio', $formatDateTimeLocal($encomienda->fecha_envio)) }}',
                            fecha_entrega_estimada: '{{ old('fecha_entrega_estimada', $formatDate($encomienda->fecha_entrega_estimada)) }}',
                            estado: '{{ old('estado', $encomienda->estado) }}',
                            fecha_entrega_real: '{{ old('fecha_entrega_real', $formatDateTimeLocal($encomienda->fecha_entrega_real)) }}',
                            documento_receptor: '{{ old('documento_receptor', $encomienda->documento_receptor) }}',
                            descripcion: `{{ old('descripcion', $encomienda->descripcion) }}`,
                            encomienda_id: '{{ $encomienda->id }}',
                            transportista_id: '{{ old('transportista_id', $encomienda->transportista_id) }}'
                        },
                        isOperator: {{ $isOperator ? 'true' : 'false' }},
                        isTransportista: {{ $isTransportista ? 'true' : 'false' }},
                        isAdmin: {{ $isAdmin ? 'true' : 'false' }}
                    })" x-on:submit="handleSubmit">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="encomienda_id" value="{{ $encomienda->id }}">

                    {{-- Mensajes informativos por rol --}}
                    @if($isAdmin)
                        <div class="bg-purple-900/50 border border-purple-700 text-purple-200 p-4 rounded-md shadow-lg mb-6 animate__animated animate__fadeIn">
                            <h4 class="font-bold mb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Modo de Administrador: Edición Completa
                            </h4>
                            <p>Tiene acceso completo para modificar todos los campos de la encomienda.</p>
                        </div>
                    @elseif($isOperator)
                        <div class="bg-blue-900/50 border border-blue-700 text-blue-200 p-4 rounded-md shadow-lg mb-6 animate__animated animate__fadeIn">
                            <h4 class="font-bold mb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Modo de Operador: Reportar Incidencia
                            </h4>
                            <p>Solo puede cambiar el estado de la encomienda a "Incidencia". El resto de los campos no se pueden modificar.</p>
                        </div>
                    @elseif($isTransportista)
                        <div class="bg-green-900/50 border border-green-700 text-green-200 p-4 rounded-md shadow-lg mb-6 animate__animated animate__fadeIn">
                            <h4 class="font-bold mb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                Modo de Transportista: Actualizar Entrega
                            </h4>
                            <p>Puede cambiar el estado a "En tránsito" o "Entregado". Al marcar como "Entregado", debe proporcionar los datos de la entrega.</p>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-800/80 border border-red-700/50 text-white p-4 rounded-md shadow-lg mb-6 animate__animated animate__shakeX">
                            <h4 class="font-bold mb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                ¡Atención! Hay errores en el formulario:
                            </h4>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @php $disabledAttr = ($isOperator || $isTransportista) && !$isAdmin ? 'disabled' : ''; @endphp

                    <!-- Información Básica -->
                    <fieldset>
                        <h3 class="text-lg font-semibold text-yellow-400 border-b-2 border-yellow-400/20 pb-2 flex items-center animate__animated animate__fadeInLeft">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Información Básica
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            @if($isAdmin)
                                <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp">
                                    <label for="remitente_id" class="block text-sm font-medium text-gray-300">Remitente</label>
                                    <select id="remitente_id" name="remitente_id" x-model="formData.remitente_id" class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150">
                                        @foreach($remitentes as $remitente)
                                            <option value="{{ $remitente->id }}" @selected(old('remitente_id', $encomienda->remitente_id) == $remitente->id)>
                                                {{ $remitente->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('remitente_id')" class="mt-2" />
                                </div>
                            @else
                                <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp">
                                    <label class="block text-sm font-medium text-gray-300">Remitente</label>
                                    <input type="text" value="{{ $encomienda->remitente->name ?? 'N/A' }}" class="mt-1 block w-full bg-gray-700/50 text-gray-400 cursor-not-allowed rounded-md" disabled>
                                    <input type="hidden" name="remitente_id" value="{{ $encomienda->remitente_id }}">
                                </div>
                            @endif
                            
                            <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp animate__delay-100ms">
                                <label for="destinatario" class="block text-sm font-medium text-gray-300">Destinatario</label>
                                <input type="text" id="destinatario" name="destinatario" value="{{ old('destinatario', $encomienda->destinatario) }}" class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150" {{ $disabledAttr }}>
                                <x-input-error :messages="$errors->get('destinatario')" class="mt-2" />
                            </div>
                        </div>
                    </fieldset>

                    <!-- Detalles del Envío -->
                    <fieldset {{ $disabledAttr }}>
                        <h3 class="text-lg font-semibold text-yellow-400 border-b-2 border-yellow-400/20 pb-2 flex items-center animate__animated animate__fadeInLeft">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            Detalles del Envío
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                            <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp">
                                <label for="tipo" class="block text-sm font-medium text-gray-300">Tipo</label>
                                <select id="tipo" name="tipo" class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150" {{ $disabledAttr }}>
                                    <option value="documento" @selected(old('tipo', $encomienda->tipo) == 'documento')>Documento</option>
                                    <option value="paquete" @selected(old('tipo', $encomienda->tipo) == 'paquete')>Paquete</option>
                                    <option value="frágil" @selected(old('tipo', $encomienda->tipo) == 'frágil')>Frágil</option>
                                    <option value="alimento" @selected(old('tipo', $encomienda->tipo) == 'alimento')>Alimento</option>
                                </select>
                                <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                            </div>
                            
                            <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp animate__delay-100ms">
                                <label for="peso" class="block text-sm font-medium text-gray-300">Peso (kg)</label>
                                <input type="number" step="0.01" id="peso" name="peso" value="{{ old('peso', $encomienda->peso) }}" class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150" {{ $disabledAttr }}>
                                <x-input-error :messages="$errors->get('peso')" class="mt-2" />
                            </div>
                            
                            <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp animate__delay-200ms">
                                <label for="costo" class="block text-sm font-medium text-gray-300">Costo</label>
                                <input type="number" step="0.01" id="costo" name="costo" value="{{ old('costo', $encomienda->costo) }}" class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150" {{ $disabledAttr }}>
                                <x-input-error :messages="$errors->get('costo')" class="mt-2" />
                            </div>
                        </div>
                    </fieldset>

                    <!-- Dirección y Contacto -->
                    <fieldset {{ $disabledAttr }}>
                        <h3 class="text-lg font-semibold text-yellow-400 border-b-2 border-yellow-400/20 pb-2 flex items-center animate__animated animate__fadeInLeft">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Dirección y Contacto
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp">
                                <label for="direccion_destino" class="block text-sm font-medium text-gray-300">Dirección</label>
                                <textarea id="direccion_destino" name="direccion_destino" rows="3" class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150" {{ $disabledAttr }}>{{ old('direccion_destino', $encomienda->direccion_destino) }}</textarea>
                                <x-input-error :messages="$errors->get('direccion_destino')" class="mt-2" />
                            </div>
                            
                            <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp animate__delay-100ms">
                                <label for="telefono_destinatario" class="block text-sm font-medium text-gray-300">Teléfono</label>
                                <input type="text" id="telefono_destinatario" name="telefono_destinatario" value="{{ old('telefono_destinatario', $encomienda->telefono_destinatario) }}" class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150" {{ $disabledAttr }}>
                                <x-input-error :messages="$errors->get('telefono_destinatario')" class="mt-2" />
                            </div>
                        </div>
                    </fieldset>

                    <!-- Fechas y Estado -->
                    <h3 class="text-lg font-semibold text-yellow-400 border-b-2 border-yellow-400/20 pb-2 flex items-center animate__animated animate__fadeInLeft">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Fechas y Estado
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                        <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp">
                            <label for="estado" class="block text-sm font-medium text-gray-300 mb-1">Estado *</label>
                            <select id="estado" name="estado" required class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150" 
                                    x-model="formData.estado" x-on:change="toggleEntregaSection"
                                    :disabled="!isAdmin && !isTransportista && !isOperator">
                                @foreach(['pendiente', 'en_proceso', 'en_transito', 'entregado', 'incidencia'] as $estado)
                                    @php
                                        $optionDisabled = false;
                                        if ($isOperator && $estado !== 'incidencia' && $encomienda->estado !== $estado) {
                                            $optionDisabled = true;
                                        }
                                        if ($isTransportista && !in_array($estado, ['en_transito', 'entregado']) && $encomienda->estado !== $estado) {
                                            $optionDisabled = true;
                                        }
                                    @endphp
                                    <option value="{{ $estado }}" 
                                            @selected(old('estado', $encomienda->estado) == $estado)
                                            @if($optionDisabled) disabled class="text-gray-500" @endif>
                                        {{ ucfirst(str_replace('_', ' ', $estado)) }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                        </div>
                        
                        <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp animate__delay-100ms">
                            <label for="transportista_id" class="block text-sm font-medium text-gray-300">Transportista</label>
                            <select id="transportista_id" name="transportista_id" class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150" {{ $isAdmin ? '' : 'disabled' }}>
                                <option value="">No asignado</option>
                                @foreach($transportistas as $transportista)
                                    <option value="{{ $transportista->id }}" @selected(old('transportista_id', $encomienda->transportista_id) == $transportista->id)>
                                        {{ $transportista->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('transportista_id')" class="mt-2" />
                        </div>

                        <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp animate__delay-200ms">
                            <label for="fecha_entrega_estimada" class="block text-sm font-medium text-gray-300">Fecha Estimada</label>
                            <input type="date" id="fecha_entrega_estimada" name="fecha_entrega_estimada" value="{{ old('fecha_entrega_estimada', $formatDate($encomienda->fecha_entrega_estimada)) }}" class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150" {{ $isAdmin ? '' : 'disabled' }}>
                            <x-input-error :messages="$errors->get('fecha_entrega_estimada')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Sección de Entrega (condicional) -->
                    <div id="entregaSection" x-show="formData.estado === 'entregado'" x-transition:enter="animate__animated animate__fadeIn" x-transition:leave="animate__animated animate__fadeOut">
                        <h3 class="text-lg font-semibold text-yellow-400 border-b-2 border-yellow-400/20 pb-2 flex items-center animate__animated animate__fadeInLeft">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Datos de Entrega
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp">
                                <label for="fecha_entrega_real" class="block text-sm font-medium text-gray-300 mb-1">Fecha de Entrega Real *</label>
                                <input type="datetime-local" id="fecha_entrega_real" name="fecha_entrega_real" value="{{ old('fecha_entrega_real', $formatDateTimeLocal($encomienda->fecha_entrega_real)) }}" class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150" 
                                       x-model="formData.fecha_entrega_real" 
                                       :disabled="!isTransportista && !isAdmin"
                                       x-bind:required="formData.estado === 'entregado'">
                                <x-input-error :messages="$errors->get('fecha_entrega_real')" class="mt-2" />
                            </div>
                            
                            <div class="transition-all duration-200 hover:scale-[1.01] animate__animated animate__fadeInUp animate__delay-100ms">
                                <label for="documento_receptor" class="block text-sm font-medium text-gray-300 mb-1">Documento Receptor *</label>
                                <input type="text" id="documento_receptor" name="documento_receptor" value="{{ old('documento_receptor', $encomienda->documento_receptor) }}" class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150" 
                                       x-model="formData.documento_receptor" 
                                       :disabled="!isTransportista && !isAdmin"
                                       x-bind:required="formData.estado === 'entregado'">
                                <x-input-error :messages="$errors->get('documento_receptor')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    
                    <!-- Descripción -->
                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-300 mb-1">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="3" 
                                  class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition duration-150 disabled:bg-gray-700/50 disabled:cursor-not-allowed" 
                                  x-model="formData.descripcion"
                                  :disabled="!(isAdmin || (isTransportista && formData.estado === 'entregado'))"
                                  placeholder="{{ $isAdmin ? 'Añada una descripción o nota aquí...' : 'Añada una nota sobre la entrega aquí (opcional)...' }}"
                                  >{{ old('descripcion', $encomienda->descripcion) }}</textarea>
                        <p x-show="isTransportista && formData.estado === 'entregado'" class="text-xs text-gray-400 mt-1">Puede añadir una nota sobre la entrega.</p>
                        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex items-center justify-end pt-6 border-t border-gray-700/50 space-x-4 animate__animated animate__fadeInUp">
                        <a href="{{ $cancelRoute }}" class="text-gray-400 hover:text-white transition-colors duration-300 flex items-center hover:underline" x-on:click="confirmCancel($event)">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Cancelar
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 bg-yellow-400 text-gray-900 font-bold py-2 px-4 rounded-lg shadow-lg hover:bg-yellow-300 transition-all duration-300 transform hover:scale-105 active:scale-95" x-bind:disabled="isSubmitting">
                            <svg x-show="!isSubmitting" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <svg x-show="isSubmitting" class="animate-spin -ml-1 mr-2 h-5 w-5 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span x-text="isSubmitting ? 'Actualizando...' : 'Actualizar Encomienda'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Animaciones CSS -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"></noscript>
    
    <!-- Alpine JS para manejo de estado del formulario -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script>
        function encomiendaForm({ initialData, isOperator, isTransportista, isAdmin }) {
            return {
                isSubmitting: false,
                originalValues: { ...initialData },
                formData: { ...initialData },
                isOperator: isOperator,
                isTransportista: isTransportista,
                isAdmin: isAdmin,

                init() {
                    // Cargar desde localStorage si hay datos guardados para esta encomienda
                    const savedData = localStorage.getItem('encomiendaEditFormData');
                    if (savedData) {
                        try {
                            const parsedData = JSON.parse(savedData);
                            if (parsedData.encomienda_id === this.formData.encomienda_id) {
                                Object.assign(this.formData, parsedData);
                            }
                        } catch (e) {
                            console.error('Error al restaurar datos del formulario desde localStorage', e);
                        }
                    }

                    // Observa los cambios en formData para guardar en localStorage
                    this.$watch('formData', (newVal) => {
                        localStorage.setItem('encomiendaEditFormData', JSON.stringify(newVal));
                    });

                    // Ejecutar la lógica de la sección de entrega al inicializar
                    this.toggleEntregaSection();

                    // Animación de elementos al cargar la página
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.style.opacity = 1;
                                observer.unobserve(entry.target);
                            }
                        });
                    }, { threshold: 0.1 });

                    document.querySelectorAll('.animate__animated').forEach(el => {
                        el.style.opacity = 0; // Ocultar al inicio para la animación
                        observer.observe(el);
                    });
                },

                toggleEntregaSection() {
                    if (this.formData.estado === 'entregado') {
                        // Establecer fecha y hora actual si el campo está vacío
                        if (!this.formData.fecha_entrega_real) {
                            const now = new Date();
                            const localDateTime = new Date(now.getTime() - now.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
                            this.formData.fecha_entrega_real = localDateTime;
                        }
                    } else {
                        // Limpiar campos si el estado no es "entregado"
                        this.formData.fecha_entrega_real = '';
                        this.formData.documento_receptor = '';
                    }
                    
                    // Limpiar descripción si no es admin y el estado no es entregado
                    if (this.formData.estado !== 'entregado' && !this.isAdmin) {
                        this.formData.descripcion = '';
                    }
                },
                
                handleSubmit(event) {
                    this.isSubmitting = true;
                    
                    // Validación JS de fecha_entrega_real para estado 'entregado'
                    if (this.formData.estado === 'entregado' && !this.formData.fecha_entrega_real) {
                        alert('La Fecha de Entrega Real es obligatoria cuando el estado es "Entregado".');
                        this.isSubmitting = false;
                        event.preventDefault();
                        return;
                    }
                    
                    // Si es admin, permitir cualquier cambio
                    if (!this.isAdmin) {
                        // Si es operador, solo permitir cambiar estado a incidencia
                        if (this.isOperator && this.formData.estado !== 'incidencia' && this.formData.estado !== this.originalValues.estado) {
                            alert('Como operador solo puede cambiar el estado a "Incidencia".');
                            this.isSubmitting = false;
                            event.preventDefault();
                            return;
                        }
                        
                        // Si es transportista, solo permitir cambiar a en_transito o entregado
                        if (this.isTransportista && !['en_transito', 'entregado'].includes(this.formData.estado) && this.formData.estado !== this.originalValues.estado) {
                            alert('Como transportista solo puede cambiar el estado a "En tránsito" o "Entregado".');
                            this.isSubmitting = false;
                            event.preventDefault();
                            return;
                        }
                    }
                    
                    // Limpiar localStorage
                    localStorage.removeItem('encomiendaEditFormData');
                },
                
                confirmCancel(event) {
                    const hasChanges = Object.keys(this.formData).some(key => {
                        if (key === 'encomienda_id') return false;
                        return this.formData[key] !== this.originalValues[key];
                    });
                    
                    if (hasChanges && !confirm('¿Estás seguro de que deseas cancelar? Los cambios no guardados se perderán.')) {
                        event.preventDefault();
                    }
                }
            }
        }
    </script>
</x-app-layout>