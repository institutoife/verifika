@section('title', 'Crear cuenta | Verifika')

<x-guest-layout>
    <header class="auth-heading">
        <span class="auth-eyebrow">Comienza gratis</span>
        <h1>Crear una cuenta</h1>
        <p>Completa tus datos y empieza a practicar.</p>
    </header>

    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <x-input-label for="name" :value="__('Nombre completo')" class="auth-label" />
            <div class="input-shell">
                <i class="fa-solid fa-user" aria-hidden="true"></i>
                <x-text-input
                    id="name"
                    class="auth-input"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Tu nombre"
                />
            </div>
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="auth-field">
            <x-input-label for="phone" :value="__('Número de teléfono')" class="auth-label" />
            <div class="input-shell">
                <i class="fa-solid fa-phone" aria-hidden="true"></i>
                <x-text-input
                    id="phone"
                    class="auth-input"
                    type="tel"
                    name="phone"
                    :value="old('phone')"
                    required
                    autocomplete="tel"
                    inputmode="tel"
                    placeholder="Ej.: 71234567"
                />
            </div>
            <x-input-error :messages="$errors->get('phone')" />
        </div>

        <div class="auth-field">
            <x-input-label for="password" :value="__('Contraseña')" class="auth-label" />
            <div class="input-shell">
                <i class="fa-solid fa-lock" aria-hidden="true"></i>
                <x-text-input
                    id="password"
                    class="auth-input"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Crea una contraseña"
                />
            </div>
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="auth-field">
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" class="auth-label" />
            <div class="input-shell">
                <i class="fa-solid fa-shield-alt" aria-hidden="true"></i>
                <x-text-input
                    id="password_confirmation"
                    class="auth-input"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Repite tu contraseña"
                />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <button class="auth-submit" type="submit">
            Crear mi cuenta
            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
        </button>
    </form>

    <p class="auth-switch">
        ¿Ya tienes una cuenta?
        <a href="{{ route('login') }}">Inicia sesión</a>.
    </p>
</x-guest-layout>
