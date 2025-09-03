
<x-app-layout>
    <style>
        /* === PALETA DE COLORES MEJORADA === */
        :root {
            --color-primary: 251 191 36;  /* Amarillo vibrante */
            --color-primary-dark: 217 119 6; /* Amarillo oscuro */
            --color-secondary: 167 139 250; /* Púrpura suave */
            --color-secondary-dark: 139 92 246; /* Púrpura intenso */
            --color-dark: 17 24 39;       /* Gris oscuro base */
            --color-darker: 10 14 24;     /* Gris más oscuro */
            --color-light-text: 229 231 235; /* Texto claro */
            --color-mid-text: 156 163 175; /* Texto medio */
            --color-accent: 6 182 212;   /* Cyan para acentos */
            --color-danger: 239 68 68;    /* Rojo para errores */
        }

        /* === ANIMACIONES GLOBALES === */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        @keyframes pulse-glow {
            0%, 100% { filter: drop-shadow(0 0 4px rgba(var(--color-primary), 0.7)); }
            50% { filter: drop-shadow(0 0 16px rgba(var(--color-primary), 0.9)); }
        }
        @keyframes gradient-flow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        @keyframes shimmer {
            0% { transform: translateX(-100%) skewX(-15deg); }
            100% { transform: translateX(100%) skewX(-15deg); }
        }
        @keyframes rotate-spinner {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* === ESTRUCTURA PRINCIPAL === */
        .text-gradient {
            background-image: linear-gradient(45deg, 
                rgb(var(--color-primary)), 
                rgb(var(--color-secondary)), 
                rgb(var(--color-primary-dark)));
            background-size: 200% auto;
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            animation: gradient-flow 6s ease infinite;
        }

        /* === TARJETA CON BORDE ANIMADO === */
        .gradient-border-card {
            background-color: rgb(var(--color-darker));
            position: relative; border-radius: 1.5rem;
            overflow: hidden; padding: 3px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.6);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .gradient-border-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.7);
        }
        .gradient-border-card::before {
            content: ''; position: absolute;
            top: -50%; left: -50%; width: 200%; height: 200%;
            background: conic-gradient(
                from 180deg at 50% 50%,
                rgba(var(--color-secondary), 0.8) 0deg,
                rgba(var(--color-primary), 0.8) 120deg,
                rgba(var(--color-accent), 0.6) 240deg,
                rgba(var(--color-secondary), 0.8) 360deg);
            animation: rotate-border 8s linear infinite; z-index: 0;
        }
        .card-content {
            background: linear-gradient(145deg, rgb(var(--color-darker)), rgb(var(--color-dark)));
            border-radius: 1.35rem; position: relative; z-index: 1; padding: 2.5rem;
            backdrop-filter: blur(4px);
        }

        /* === ANIMACIONES DE ENTRADA === */
        .animate-in { opacity: 0; transform: translateY(30px) scale(0.98); transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1); }
        .animate-in.is-visible { opacity: 1; transform: translateY(0) scale(1); }

        /* === FORMULARIO AVANZADO (INPUTS Y SELECTS) === */
        .input-group, .select-group { position: relative; margin-bottom: 1.5rem; }
        .form-input-v2, .form-select-v2 {
            width: 100%;
            background: linear-gradient(to top, rgba(255,255,255,0.03), rgba(255,255,255,0.08));
            border: 2px solid rgba(55, 65, 81, 0.5); border-radius: 0.75rem;
            padding: 1.25rem 1rem 0.75rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1) inset;
            font-size: 1rem; position: relative; z-index: 1;
            color: rgb(var(--color-light-text));
        }
        .form-label-v2 {
            position: absolute; left: 1rem; top: 1rem; font-size: 1rem;
            color: rgb(var(--color-mid-text)); pointer-events: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 2;
            background: linear-gradient(to bottom, rgb(var(--color-dark)), rgb(var(--color-darker)));
            padding: 0 0.5rem; border-radius: 0.5rem;
        }
        /* La pseudo-clase `:not(:placeholder-shown)` funciona genial para inputs con `value` pre-llenado */
        .form-input-v2:focus ~ .form-label-v2,
        .form-input-v2:not(:placeholder-shown) ~ .form-label-v2,
        .form-select-v2:focus ~ .form-label-v2,
        .form-select-v2:valid ~ .form-label-v2 {
            top: -0.6rem; font-size: 0.75rem; color: rgba(var(--color-primary), 1);
            background: rgb(var(--color-darker)); box-shadow: 0 0 0 2px rgba(var(--color-primary), 0.3);
        }
        .form-input-v2:focus, .form-select-v2:focus {
            border-color: rgba(var(--color-primary), 0.8);
            box-shadow: 0 0 0 3px rgba(var(--color-primary), 0.2), 0 4px 6px rgba(0,0,0,0.1) inset;
            outline: none;
        }
        
        .form-select-v2 {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%239CA3AF'%3E%3Cpath d='M11.9997 13.1714L16.9495 8.22168L18.3637 9.63589L11.9997 15.9999L5.63574 9.63589L7.04996 8.22168L11.9997 13.1714Z'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 1rem center;
            background-size: 1.5rem; padding-right: 3rem; cursor: pointer;
        }
        .form-select-v2 option { background-color: rgb(var(--color-dark)); color: rgb(var(--color-light-text)); }
        
        .form-error-message {
            display: flex; align-items: center; gap: 0.5rem;
            padding: 0.75rem 1rem; background-color: rgba(var(--color-danger), 0.1);
            border-left: 4px solid rgb(var(--color-danger));
            color: rgb(248, 113, 113); font-size: 0.875rem; border-radius: 0.5rem;
            margin-top: 0.5rem;
        }
        
        /* === BOTONES === */
        .btn {
            position: relative; overflow: hidden; transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            border: none; outline: none; cursor: pointer; font-weight: 600; letter-spacing: 0.5px;
            text-transform: uppercase; display: inline-flex; align-items: center; justify-content: center;
        }
        .btn::before { content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent); transition: all 0.6s ease; }
        .btn:hover::before { left: 100%; }
        
        .btn-primary-yellow { background: linear-gradient(135deg, rgb(var(--color-primary)), rgb(var(--color-primary-dark))); color: rgb(17, 24, 39); padding: 0.875rem 2rem; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.1); }
        .btn-primary-yellow:not(:disabled):hover { transform: translateY(-2px) scale(1.02); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.2); }
        .btn-primary-yellow:not(:disabled):active { transform: translateY(1px) scale(0.98); }
        .btn:disabled { opacity: 0.6; cursor: not-allowed; background: linear-gradient(135deg, rgb(var(--color-primary) / 0.6), rgb(var(--color-primary-dark) / 0.6)); }
        .btn-spinner { width: 1.25em; height: 1.25em; border: 2px solid currentColor; border-right-color: transparent; border-radius: 50%; animation: rotate-spinner 0.8s linear infinite; }
        
        .btn-secondary-ghost { background: transparent; color: rgb(var(--color-light-text)); border: 2px solid rgba(var(--color-light-text), 0.2); padding: 0.75rem 1.75rem; border-radius: 0.75rem; }
        .btn-secondary-ghost:hover { background: rgba(var(--color-light-text), 0.05); border-color: rgba(var(--color-primary), 0.5); color: rgb(var(--color-primary)); transform: translateY(-2px); }

        /* === OTROS === */
        .icon-float { animation: float 4s ease-in-out infinite; filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.3)); }
        .icon-pulse-glow { animation: pulse-glow 3s ease-in-out infinite, float 6s ease-in-out infinite; }

        .divider-gradient { height: 2px; background: linear-gradient(90deg, transparent, rgba(var(--color-secondary), 0.5), rgba(var(--color-primary), 0.7), rgba(var(--color-secondary), 0.5), transparent); margin: 2.5rem 0; position: relative; overflow: hidden; }
        .divider-gradient::after { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent); animation: shimmer 3s infinite; }

        .particles { position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: -1; overflow: hidden; }
        .particle { position: absolute; background-color: rgba(var(--color-primary), 0.6); border-radius: 50%; filter: blur(2px); animation-name: float; animation-timing-function: linear; animation-iteration-count: infinite; }
    </style>

    <x-slot name="header">
        <div class="flex items-center gap-4 animate-in">
            <div class="icon-pulse-glow">
                <svg class="w-12 h-12 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
            </div>
            <div>
                <h2 class="font-bold text-4xl leading-tight text-gradient tracking-tight">
                    Editando Usuario
                </h2>
                <p class="text-lg text-purple-300 font-medium">{{ $user->name }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 relative overflow-hidden">
        <div class="particles" id="particles-js"></div>
        
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="gradient-border-card">
                <div class="card-content">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}" id="edit-form">
                        @csrf
                        @method('PUT')

                        <!-- Sección 1: Datos Personales y Rol -->
                        <div class="animate-in">
                            <div class="flex items-center gap-3 mb-8">
                                <svg class="w-8 h-8 text-purple-400 icon-float" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                <h3 class="text-2xl font-bold text-gray-200">Identificación y Rol</h3>
                            </div>
                            <div class="space-y-8">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="input-group">
                                        <input id="name" type="text" name="name" class="form-input-v2" value="{{ old('name', $user->name) }}" placeholder=" " required />
                                        <label for="name" class="form-label-v2">Nombre Completo</label>
                                        <x-input-error :messages="$errors->get('name')" class="form-error-message" />
                                    </div>
                                    <div class="input-group">
                                        <input id="email" type="email" name="email" class="form-input-v2" value="{{ old('email', $user->email) }}" placeholder=" " required />
                                        <label for="email" class="form-label-v2">Correo Electrónico</label>
                                        <x-input-error :messages="$errors->get('email')" class="form-error-message" />
                                    </div>
                                </div>
                                
                                <div class="select-group">
                                    <select id="rol" name="rol" class="form-select-v2" required>
                                        {{-- Los values deben ser consistentes con los del formulario de creación (en minúsculas) --}}
                                        <option value="remitente" @selected(old('rol', strtolower($user->rol)) == 'remitente')>Remitente</option>
                                        <option value="operador" @selected(old('rol', strtolower($user->rol)) == 'operador')>Operador</option>
                                        <option value="transportista" @selected(old('rol', strtolower($user->rol)) == 'transportista')>Transportista</option>
                                        <option value="admin" @selected(old('rol', strtolower($user->rol)) == 'admin')>Administrador</option>
                                    </select>
                                    <label for="rol" class="form-label-v2">Tipo de cuenta</label>
                                    <x-input-error :messages="$errors->get('rol')" class="form-error-message" />
                                </div>
                            </div>
                        </div>

                        <!-- Divisor Estilizado -->
                        <div class="divider-gradient"></div>
                        
                        <!-- Sección 2: Credenciales -->
                        <div class="animate-in">
                            <div class="flex items-center gap-3 mb-8">
                                <svg class="w-8 h-8 text-purple-400 icon-float" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-200">Credenciales de Seguridad</h3>
                                    <p class="text-sm text-gray-400">Dejar en blanco para no cambiar la contraseña.</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="input-group">
                                    {{-- El atributo `required` se elimina intencionadamente --}}
                                    <input id="password" type="password" name="password" class="form-input-v2" placeholder=" " />
                                    <label for="password" class="form-label-v2">Nueva Contraseña</label>
                                    <x-input-error :messages="$errors->get('password')" class="form-error-message" />
                                </div>
                                <div class="input-group">
                                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-input-v2" placeholder=" " />
                                    <label for="password_confirmation" class="form-label-v2">Confirmar Contraseña</label>
                                </div>
                            </div>
                        </div>

                        <!-- Acciones Finales -->
                        <div class="mt-12 pt-8 border-t-2 border-dashed border-gray-700/50 flex items-center justify-end gap-4 animate-in">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary-ghost">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary-yellow" id="submit-button">
                                <span class="btn-text flex items-center">
                                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                                    Actualizar Usuario
                                </span>
                                <span class="btn-spinner hidden"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            
            document.querySelectorAll('.animate-in').forEach(el => observer.observe(el));
            
            const particlesContainer = document.getElementById('particles-js');
            if (particlesContainer) {
                const particleCount = 25;
                const colors = ['var(--color-primary)', 'var(--color-secondary)', 'var(--color-accent)'];
                for (let i = 0; i < particleCount; i++) {
                    const particle = document.createElement('div');
                    particle.classList.add('particle');
                    const size = Math.random() * 4 + 2;
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    particle.style.left = `${Math.random() * 100}%`;
                    particle.style.top = `${Math.random() * 100}%`;
                    const color = colors[Math.floor(Math.random() * colors.length)];
                    particle.style.backgroundColor = `rgba(${color}, 0.6)`;
                    particle.style.opacity = Math.random() * 0.5 + 0.2;
                    const duration = Math.random() * 15 + 10;
                    particle.style.animationDuration = `${duration}s`;
                    const delay = Math.random() * 5;
                    particle.style.animationDelay = `${delay}s`;
                    particlesContainer.appendChild(particle);
                }
            }

            const form = document.getElementById('edit-form');
            const submitButton = document.getElementById('submit-button');
            const buttonText = submitButton.querySelector('.btn-text');
            const buttonSpinner = submitButton.querySelector('.btn-spinner');

            if (form) {
                form.addEventListener('submit', (e) => {
                    if (submitButton.disabled) { e.preventDefault(); return; }
                    submitButton.disabled = true;
                    buttonText.classList.add('hidden');
                    buttonSpinner.classList.remove('hidden');
                    buttonSpinner.insertAdjacentText('afterend', ' Actualizando...');
                });
            }
        });
    </script>
</x-app-layout>