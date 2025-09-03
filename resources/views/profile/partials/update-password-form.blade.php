{{-- REEMPLAZA el contenido de este archivo con lo siguiente --}}
<section>
    <header>
        <h2 class="card-header-title">
            {{ __('Update Password') }}
        </h2>
        <p class="card-header-description">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
        <div class="mt-4 mb-6"><div class="animated-divider"></div></div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="current_password" class="form-label-dark">{{ __('Current Password') }}</label>
            <input id="current_password" name="current_password" type="password" class="form-input-dark mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="form-label-dark">{{ __('New Password') }}</label>
            <input id="password" name="password" type="password" class="form-input-dark mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="form-label-dark">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-input-dark mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary-yellow">{{ __('Save') }}</button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-green-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>