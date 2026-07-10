@section('title', 'Iniciar sesión | Verifika')

<x-guest-layout>
    <header class="auth-heading">
        <span class="auth-eyebrow">Bienvenido de nuevo</span>
        <h1>Iniciar sesión</h1>
        <p>Ingresa con tu número de teléfono para continuar.</p>
    </header>

    <x-auth-session-status class="auth-status" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

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
                    autofocus
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
                    autocomplete="current-password"
                    placeholder="Ingresa tu contraseña"
                />
            </div>
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="auth-options">
            <label class="remember-label" for="remember_me">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Recordarme</span>
            </label>

            @if (Route::has('password.request'))
                <a class="auth-text-link" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
            @endif
        </div>

        <button class="auth-submit" type="submit">
            Ingresar
            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
        </button>
    </form>

    <p class="auth-switch">
        ¿Aún no tienes una cuenta?
        <a href="{{ route('register') }}">Regístrate aquí</a>.
    </p>
</x-guest-layout>
