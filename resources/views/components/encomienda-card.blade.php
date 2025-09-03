<div class="card-canguro bg-white p-4 rounded-lg shadow-md mb-4">
    <div class="flex justify-between items-start">
        <div>
            <h3 class="font-bold text-lg">
                <span class="text-yellow-600">#{{ $encomienda->numero_seguimiento }}</span>
                <span class="text-sm ml-2 bg-yellow-400 text-black px-2 py-1 rounded-full">
                    {{ ucfirst($encomienda->estado) }}
                </span>
            </h3>
            <p class="text-gray-600">{{ $encomienda->destinatario }}</p>
        </div>
        <div class="text-right">
            <span class="font-bold">${{ number_format($encomienda->costo, 2) }}</span>
            <a href="{{ route('encomiendas.show', $encomienda) }}" class="block mt-2 text-yellow-600 hover:text-yellow-800">
                Ver detalles
            </a>
        </div>
    </div>
</div>