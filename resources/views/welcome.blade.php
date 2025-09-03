<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Canguro Envíos - Rápido y Seguro</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-900 text-white selection:bg-yellow-500 selection:text-gray-900">
    {{-- Fondo con gradiente sutil --}}
    <div class="absolute inset-0 -z-10 h-full w-full bg-gray-900 bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(250,204,21,0.15),rgba(255,255,255,0))]"></div>
    
    <div class="relative min-h-screen flex flex-col">
        <!-- #################### NAVEGACIÓN #################### -->
        <header class="w-full">
            <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
                <!-- Logo -->
                <a href="/">
                    <img src="{{ asset('imagenes/Canguro.png') }}" alt="Logo Canguro Envíos" class="h-12 w-auto hover:opacity-90 transition-opacity">
                </a>

                <!-- Enlaces de Autenticación -->
                <div class="flex items-center space-x-6">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-300 hover:text-white transition duration-300">Dashboard</a>
                        @else
                            {{-- CORRECCIÓN: El botón "Iniciar Sesión" es el principal aquí --}}
                            <a href="{{ route('login') }}" class="font-semibold text-gray-300 hover:text-white transition duration-300">Iniciar Sesión</a>
                            
                            {{-- El botón "Registrarse" es el que pide la clave --}}
                            <a href="#" onclick="promptForRegister(event)" class="font-bold text-gray-900 bg-yellow-400 hover:bg-yellow-300 py-2 px-5 rounded-lg shadow-lg shadow-yellow-500/20 transition-all duration-300 transform hover:scale-105">
                                Registrarse
                            </a>
                        @endauth
                    @endif
                </div>
            </nav>
        </header>

        <!-- #################### HERO SECTION (BIENVENIDA) #################### -->
        <main class="flex-grow flex flex-col justify-center text-center">
            <div class="container mx-auto px-6">
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tighter">
                    La Logística que <span class="text-yellow-400">Salta por Ti</span>
                </h1>
                <p class="mt-6 text-lg md:text-xl text-gray-400 max-w-3xl mx-auto">
                    Con Canguro, tus paquetes no solo viajan, dan el salto a la eficiencia. Registra, envía y sigue cada paso con nuestra plataforma interna para distribuidores.
                </p>
                <div class="mt-10">
                    {{-- CORRECCIÓN: El botón "¡Empieza Ahora!" ahora lleva al Login --}}
                    <a href="{{ route('login') }}" class="text-gray-900 bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-500 font-bold text-xl py-4 px-10 rounded-lg shadow-2xl shadow-yellow-500/30 transition-all duration-300 transform hover:scale-110">
                        ¡Empieza Ahora!
                    </a>
                </div>
            </div>
        </main>
    </div>

    <!-- #################### SECCIÓN DE CARACTERÍSTICAS / ACERCA DE #################### -->
    <section class="w-full bg-gray-800 py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold">Un Sistema Pensado Para Ti</h2>
                <p class="text-gray-400 mt-2">Todo lo que necesitas para una gestión impecable.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="bg-gray-900 p-8 rounded-lg text-center shadow-lg">
                    <h3 class="text-xl font-bold mt-6 text-yellow-400">Registro Simplificado</h3>
                    <p class="mt-2 text-gray-400">Crea encomiendas en segundos. Menos papeleo, más envíos.</p>
                </div>
                <!-- Feature 2 -->
                <div class="bg-gray-900 p-8 rounded-lg text-center shadow-lg">
                    <h3 class="text-xl font-bold mt-6 text-yellow-400">Gestión Centralizada</h3>
                    <p class="mt-2 text-gray-400">Asigna rutas, transportistas y gestiona incidencias desde un solo lugar.</p>
                </div>
                <!-- Feature 3 -->
                <div class="bg-gray-900 p-8 rounded-lg text-center shadow-lg">
                    <h3 class="text-xl font-bold mt-6 text-yellow-400">Reportes Inteligentes</h3>
                    <p class="mt-2 text-gray-400">Obtén informes detallados para optimizar tus operaciones y tomar mejores decisiones.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- #################### FOOTER CON REDES SOCIALES #################### -->
    <footer class="w-full py-12 bg-gray-900">
        <div class="container mx-auto px-6 text-center">
            <div class="flex justify-center items-center space-x-6 mb-6">
                {{-- Enlace a Instagram --}}
                <a href="https://www.instagram.com/cangurove?igsh=MWQ0dDRqdmx0aTdiMw==" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-yellow-400 transition-colors">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.013-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.08 2.525c.636-.247 1.363-.416 2.427-.465C9.53 2.013 9.884 2 12.315 2zM12 7a5 5 0 100 10 5 5 0 000-10zm0 8a3 3 0 110-6 3 3 0 010 6zm5.25-9.25a1.25 1.25 0 100-2.5 1.25 1.25 0 000 2.5z" clip-rule="evenodd" /></svg>
                    <span class="sr-only">Instagram</span>
                </a>
                {{-- Enlace a la Página Principal --}}
                <a href="https://www.cangurovenezuela.com/" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-yellow-400 transition-colors">
                     <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9V3m0 18a9 9 0 00-9-9m9 9a9 9 0 00-9-9"></path></svg>
                    <span class="sr-only">Página Principal</span>
                </a>
            </div>
            <p class="text-gray-500">© {{ date('Y') }} Canguro Envíos. Todos los derechos reservados.</p>
        </div>
    </footer>

    {{-- ==================== SCRIPT DE VERIFICACIÓN (sin cambios) ==================== --}}
    <script>
        function promptForRegister(event) {
            event.preventDefault();
            const secretPassword = "211200zai.2024@xcANGur.*";
            const enteredPassword = prompt("Por favor, introduce la contraseña de administrador para registrarte:");
            if (enteredPassword === null || enteredPassword === "") {
                alert("Registro cancelado.");
                return;
            }
            if (enteredPassword === secretPassword) {
                window.location.href = "{{ route('register') }}";
            } else {
                alert("Contraseña incorrecta. No tienes permiso para registrarte.");
            }
        }
    </script>
</body>
</html>