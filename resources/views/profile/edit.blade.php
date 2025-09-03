<x-app-layout>
    {{-- 
        ESTILOS AVANZADOS PARA LA PÁGINA DE PERFIL
        - Paleta de colores corregida para máxima legibilidad.
        - Efecto 3D "tilt" en las tarjetas al pasar el ratón.
        - Animación de "respiración" para el icono principal.
        - Divisor animado para los encabezados de las tarjetas.
        - Botones mejorados con más feedback visual.
    --}}
    <style>
        /* Animación para el icono del header */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
            100% { transform: translateY(0px); }
        }

        .icon-float {
            animation: float 4s ease-in-out infinite;
        }

        /* Gradiente para el texto del título */
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }
        
        /* Contenedor principal con perspectiva para el efecto 3D */
        .perspective-container {
            perspective: 1000px;
        }

        /* Estilo base de las tarjetas interactivas */
        .profile-card-interactive {
            transform-style: preserve-3d;
            transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                        box-shadow 0.3s ease, 
                        border-color 0.3s ease;
            opacity: 0;
            transform: translateY(40px);
        }

        /* Efecto 3D y brillo al pasar el ratón */
        .profile-card-interactive:hover {
            transform: rotateX(5deg) rotateY(-5deg) scale(1.02);
            box-shadow: 0px 15px 30px rgba(251, 191, 36, 0.2); /* Sombra amarilla */
            border-color: rgba(251, 191, 36, 0.5); /* Borde amarillo más visible */
        }
        
        /* Clase para activar la animación de entrada */
        .is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Divisor animado */
        .animated-divider {
            width: 0;
            height: 1px;
            background: linear-gradient(to right, rgba(251, 191, 36, 0.1), rgba(251, 191, 36, 0.7), rgba(251, 191, 36, 0.1));
            transition: width 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        }
        .is-visible .animated-divider {
            width: 100%;
        }

        /* **CORRECCIONES DE LEGIBILIDAD** */
        .form-label-dark { @apply block font-medium text-sm text-gray-300; }
        .form-input-dark {
            @apply w-full bg-gray-900/70 border-2 border-gray-700 text-gray-200 rounded-lg shadow-inner;
            @apply placeholder-gray-500 focus:border-yellow-400 focus:ring focus:ring-yellow-400 focus:ring-opacity-50 transition duration-150 ease-in-out;
        }
        .card-header-title { @apply text-2xl font-bold text-gray-100; }
        .card-header-description { @apply mt-1 text-sm text-gray-400; }

        /* Botón primario (Guardar) */
        .btn-primary-yellow {
            @apply inline-flex items-center px-6 py-2 bg-yellow-400 border border-transparent rounded-lg font-bold text-sm text-gray-900 uppercase tracking-wider shadow-lg;
            @apply hover:bg-yellow-300 hover:shadow-xl hover:-translate-y-0.5 active:bg-yellow-500 disabled:opacity-25 transition-all duration-300 transform;
        }

        /* Botón de peligro (Eliminar) */
        .btn-danger-red {
            @apply inline-flex items-center justify-center px-6 py-2 bg-red-600 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-wider shadow-lg;
            @apply hover:bg-red-500 hover:shadow-xl hover:-translate-y-0.5 active:bg-red-700 disabled:opacity-25 transition-all ease-in-out duration-300 transform;
        }
    </style>

    <x-slot name="header">
        <div class="flex items-center gap-4 animate__animated animate__fadeInDown">
            <svg class="w-10 h-10 text-yellow-400 icon-float" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h2 class="font-bold text-3xl text-white leading-tight bg-gradient-to-r from-yellow-300 to-yellow-500 text-gradient">
                {{ __('Profile') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10 perspective-container">

            {{-- Tarjeta 1: Información del Perfil --}}
            <div class="profile-card-interactive p-6 sm:p-8 bg-gray-800/60 backdrop-blur-md border border-gray-700/50 shadow-xl sm:rounded-2xl">
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Tarjeta 2: Actualizar Contraseña --}}
            <div class="profile-card-interactive p-6 sm:p-8 bg-gray-800/60 backdrop-blur-md border border-gray-700/50 shadow-xl sm:rounded-2xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Tarjeta 3: Eliminar Cuenta (con borde y sombra de peligro) --}}
            <div class="profile-card-interactive p-6 sm:p-8 bg-gray-800/60 backdrop-blur-md border border-red-500/30 shadow-xl sm:rounded-2xl hover:!shadow-red-500/20 hover:!border-red-500/50">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            
        </div>
    </div>

    <!-- Dependencias (si aún no las tienes en el layout principal) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- Animación de entrada al hacer scroll ---
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Esperamos un poco antes de añadir la clase para un efecto más suave
                    setTimeout(() => {
                        entry.target.classList.add('is-visible');
                    }, 100);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 }); // Se activa cuando el 10% del elemento es visible

        document.querySelectorAll('.profile-card-interactive').forEach(card => {
            observer.observe(card);
        });

        // --- Feedback visual para el mensaje de "Guardado" ---
        const statusMessage = document.querySelector('.status-message');
        if (statusMessage && statusMessage.innerText.trim() !== '') {
            statusMessage.classList.add('animate-saved');
            setTimeout(() => {
                statusMessage.classList.remove('animate-saved');
            }, 4000);
        }
    });
    </script>
</x-app-layout>