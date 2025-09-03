{{-- REEMPLAZA el contenido de este archivo con lo siguiente --}}
<section class="space-y-6">
    <header>
        <h2 class="card-header-title text-red-400">
            {{ __('Delete Account') }}
        </h2>
        <p class="card-header-description !text-gray-500">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
        <div class="mt-4 mb-6"><div class="animated-divider !bg-gradient-to-r from-red-900/10 via-red-500/70 to-red-900/10"></div></div>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn-danger-red" 
    >{{ __('Delete Account') }}</x-danger-button>

    {{-- Aquí, en lugar de reemplazar x-danger-button, le añadimos nuestra clase para no romper la lógica del modal. --}}

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-gray-800 border border-gray-700 rounded-lg">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <label for="password_delete" class="sr-only">{{ __('Password') }}</label>
                <input
                    id="password_delete"
                    name="password"
                    type="password"
                    class="form-input-dark mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <button type="submit" class="btn-danger-red ml-3">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>