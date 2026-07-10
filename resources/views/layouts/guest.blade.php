<!DOCTYPE html>
<html lang="es-BO">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex, nofollow">
        <meta name="theme-color" content="#26BAA5">

        <title>@yield('title', 'Verifika')</title>

        <link rel="icon" type="image/png" href="{{ asset('images/icono-ife-educabol.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/icono-ife-educabol.png') }}">
        <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            @font-face {
                font-family: 'Glypha IFE';
                src: url('{{ asset('fonts/GlyphaLTStd-Bold.otf') }}') format('opentype');
                font-weight: 700;
                font-display: swap;
            }

            @font-face {
                font-family: 'Montserrat IFE';
                src: url('{{ asset('fonts/Montserrat-Regular.otf') }}') format('opentype');
                font-weight: 400;
                font-display: swap;
            }

            @font-face {
                font-family: 'Montserrat IFE';
                src: url('{{ asset('fonts/Montserrat-Bold.otf') }}') format('opentype');
                font-weight: 700;
                font-display: swap;
            }

            :root {
                --ife-primary: #26BAA5;
                --ife-primary-dark: #1c9f8d;
                --ife-secondary: #375F7A;
                --ife-ink: #17212b;
                --ife-muted: #667581;
                --ife-line: #dfe7eb;
                --ife-soft: #f3f7f8;
                --ife-white: #ffffff;
            }

            *, *::before, *::after { box-sizing: border-box; }

            html { min-width: 320px; background: var(--ife-soft); }

            body {
                min-width: 320px;
                min-height: 100vh;
                margin: 0;
                color: var(--ife-ink);
                background: var(--ife-soft);
                font-family: 'Montserrat IFE', Arial, sans-serif;
                -webkit-font-smoothing: antialiased;
            }

            button, input { font: inherit; }

            .auth-page {
                position: relative;
                display: grid;
                min-height: 100vh;
                place-items: center;
                overflow: hidden;
                padding: 28px;
                background:
                    radial-gradient(circle at 8% 12%, rgba(38, 186, 165, .16), transparent 30%),
                    radial-gradient(circle at 92% 88%, rgba(55, 95, 122, .13), transparent 32%),
                    #f4f7f8;
            }

            .auth-page::before,
            .auth-page::after {
                position: absolute;
                width: 280px;
                height: 280px;
                border: 1px solid rgba(55, 95, 122, .09);
                border-radius: 50%;
                content: '';
                pointer-events: none;
            }

            .auth-page::before { top: -145px; right: 8%; }
            .auth-page::after { bottom: -190px; left: 4%; width: 360px; height: 360px; }

            .auth-shell {
                position: relative;
                z-index: 1;
                display: grid;
                grid-template-columns: minmax(340px, .84fr) minmax(470px, 1.16fr);
                width: min(1080px, 100%);
                min-height: 680px;
                overflow: hidden;
                border: 1px solid rgba(55, 95, 122, .1);
                border-radius: 26px;
                background: var(--ife-white);
                box-shadow: 0 28px 70px rgba(23, 33, 43, .13);
            }

            .auth-visual {
                position: relative;
                display: flex;
                min-height: 680px;
                overflow: hidden;
                flex-direction: column;
                justify-content: space-between;
                padding: 34px 34px 0;
                color: #fff;
                background: linear-gradient(145deg, var(--ife-secondary) 0%, #294b63 100%);
            }

            .auth-visual::before {
                position: absolute;
                inset: auto -150px -120px auto;
                width: 430px;
                height: 430px;
                border-radius: 50%;
                background: rgba(38, 186, 165, .28);
                content: '';
            }

            .auth-visual::after {
                position: absolute;
                top: 110px;
                left: -90px;
                width: 220px;
                height: 220px;
                border: 1px solid rgba(255, 255, 255, .12);
                border-radius: 50%;
                content: '';
            }

            .back-home {
                position: relative;
                z-index: 3;
                display: inline-flex;
                width: fit-content;
                align-items: center;
                gap: 9px;
                color: rgba(255, 255, 255, .86);
                font-size: 13px;
                font-weight: 700;
                text-decoration: none;
                transition: color .2s ease, transform .2s ease;
            }

            .back-home:hover { color: #fff; transform: translateX(-2px); }

            .visual-copy { position: relative; z-index: 3; max-width: 330px; margin-top: 28px; }

            .visual-badge {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 7px 11px;
                border: 1px solid rgba(255, 255, 255, .22);
                border-radius: 999px;
                color: #fff;
                background: rgba(255, 255, 255, .08);
                font-size: 11px;
                font-weight: 700;
                letter-spacing: .09em;
                text-transform: uppercase;
            }

            .visual-badge::before {
                width: 7px;
                height: 7px;
                border-radius: 50%;
                background: var(--ife-primary);
                content: '';
                box-shadow: 0 0 0 4px rgba(38, 186, 165, .16);
            }

            .visual-copy h2 {
                margin: 18px 0 10px;
                color: #fff !important;
                font-family: 'Glypha IFE', Arial, sans-serif;
                font-size: clamp(27px, 3vw, 37px);
                line-height: 1.08;
            }

            .visual-copy p { margin: 0; color: rgba(255, 255, 255, .72); font-size: 14px; line-height: 1.6; }

            .david-photo {
                position: relative;
                z-index: 2;
                width: 112%;
                max-width: 470px;
                height: 405px;
                margin: -8px 0 0 -14px;
                background-image: url('{{ asset('images/david-flores-ife-educabol-instituto-formacion-educabol.png') }}');
                background-repeat: no-repeat;
                background-position: center bottom;
                background-size: contain;
                filter: drop-shadow(0 16px 20px rgba(6, 24, 36, .28));
            }

            .auth-main {
                display: flex;
                min-width: 0;
                flex-direction: column;
                justify-content: center;
                padding: 34px clamp(38px, 6vw, 76px) 28px;
            }

            .brand-link {
                display: flex;
                width: fit-content;
                align-items: center;
                gap: 14px;
                margin-bottom: 28px;
                color: inherit;
                text-decoration: none;
            }

            .brand-logo {
                width: 60px;
                height: 60px;
                flex: 0 0 auto;
                object-fit: contain;
            }

            .brand-name {
                display: block;
                color: var(--ife-secondary);
                font-family: 'Glypha IFE', Arial, sans-serif;
                font-size: 25px;
                line-height: 1;
            }

            .brand-tagline { display: block; margin-top: 6px; color: var(--ife-muted); font-size: 11px; line-height: 1.35; }

            .auth-form-container { width: 100%; max-width: 450px; }

            .auth-heading { margin-bottom: 22px; }

            .auth-eyebrow {
                display: block;
                margin-bottom: 7px;
                color: var(--ife-primary-dark);
                font-size: 11px;
                font-weight: 700;
                letter-spacing: .11em;
                text-transform: uppercase;
            }

            .auth-heading h1 {
                margin: 0;
                color: var(--ife-secondary) !important;
                font-family: 'Glypha IFE', Arial, sans-serif;
                font-size: clamp(28px, 4vw, 35px);
                line-height: 1.12;
            }

            .auth-heading p { margin: 8px 0 0; color: var(--ife-muted); font-size: 13px; line-height: 1.5; }

            .auth-form { display: grid; gap: 16px; }
            .auth-field { display: grid; gap: 7px; }

            .auth-label {
                color: #324755 !important;
                font-size: 12px !important;
                font-weight: 700 !important;
            }

            .input-shell { position: relative; }

            .input-shell > i {
                position: absolute;
                z-index: 1;
                top: 50%;
                left: 15px;
                color: #91a1aa;
                font-size: 14px;
                transform: translateY(-50%);
                pointer-events: none;
            }

            .auth-input {
                width: 100% !important;
                height: 46px !important;
                padding: 0 14px 0 42px !important;
                border: 1px solid var(--ife-line) !important;
                border-radius: 11px !important;
                color: var(--ife-ink) !important;
                background: #fafcfc !important;
                font-size: 14px !important;
                outline: 0 !important;
                box-shadow: none !important;
                transition: border-color .2s ease, background .2s ease, box-shadow .2s ease !important;
            }

            .auth-input::placeholder { color: #a4b0b7; }

            .auth-input:focus {
                border-color: var(--ife-primary) !important;
                background: #fff !important;
                box-shadow: 0 0 0 4px rgba(38, 186, 165, .12) !important;
            }

            .auth-options { display: flex; align-items: center; justify-content: space-between; gap: 16px; }

            .remember-label { display: inline-flex; align-items: center; gap: 8px; color: var(--ife-muted); font-size: 12px; cursor: pointer; }

            .remember-label input {
                width: 16px;
                height: 16px;
                border: 1px solid #bdc9cf;
                border-radius: 4px;
                color: var(--ife-primary);
            }

            .remember-label input:focus { box-shadow: 0 0 0 3px rgba(38, 186, 165, .16); }

            .auth-text-link { color: var(--ife-secondary); font-size: 12px; font-weight: 700; text-decoration: none; }
            .auth-text-link:hover { color: var(--ife-primary-dark); text-decoration: underline; text-underline-offset: 3px; }

            .auth-submit {
                display: inline-flex;
                width: 100%;
                height: 47px;
                align-items: center;
                justify-content: center;
                gap: 10px;
                border: 0;
                border-radius: 11px;
                color: #fff;
                background: var(--ife-primary);
                font-size: 13px;
                font-weight: 700;
                cursor: pointer;
                box-shadow: 0 10px 22px rgba(38, 186, 165, .2);
                transition: background .2s ease, transform .2s ease, box-shadow .2s ease;
            }

            .auth-submit:hover { background: var(--ife-primary-dark); box-shadow: 0 12px 26px rgba(38, 186, 165, .27); transform: translateY(-1px); }
            .auth-submit:focus-visible { outline: 3px solid rgba(38, 186, 165, .3); outline-offset: 3px; }

            .auth-switch { margin: 18px 0 0; color: var(--ife-muted); font-size: 12px; text-align: center; }
            .auth-switch a { color: var(--ife-secondary); font-weight: 700; text-decoration: none; }
            .auth-switch a:hover { color: var(--ife-primary-dark); text-decoration: underline; text-underline-offset: 3px; }

            .auth-footer {
                width: 100%;
                max-width: 450px;
                margin-top: 24px;
                padding-top: 18px;
                border-top: 1px solid #edf1f3;
            }

            .support-row { display: flex; align-items: center; justify-content: space-between; gap: 14px; }

            .social-links { display: flex; align-items: center; gap: 7px; }

            .social-link {
                display: inline-flex;
                width: 32px;
                height: 32px;
                align-items: center;
                justify-content: center;
                border: 1px solid var(--ife-line);
                border-radius: 9px;
                color: var(--ife-secondary);
                background: #fff;
                font-size: 14px;
                text-decoration: none;
                transition: color .2s ease, border-color .2s ease, background .2s ease, transform .2s ease;
            }

            .social-link:hover { border-color: var(--ife-primary); color: #fff; background: var(--ife-primary); transform: translateY(-2px); }

            .whatsapp-link {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                color: var(--ife-secondary);
                font-size: 11px;
                font-weight: 700;
                text-decoration: none;
            }

            .whatsapp-link i { color: var(--ife-primary-dark); font-size: 19px; }
            .whatsapp-link:hover { color: var(--ife-primary-dark); }

            .auth-status { margin-bottom: 16px; border-radius: 10px; background: rgba(38, 186, 165, .1); padding: 11px 13px; color: #167e70; font-size: 12px; }

            @media (max-width: 860px) {
                .auth-page { padding: 18px; }
                .auth-shell { grid-template-columns: minmax(260px, .72fr) minmax(420px, 1.28fr); }
                .auth-visual { padding-inline: 24px; }
                .visual-copy h2 { font-size: 28px; }
                .david-photo { width: 126%; margin-left: -50px; }
                .auth-main { padding-inline: 38px; }
            }

            @media (max-width: 720px) {
                .auth-page { display: block; min-height: 100svh; padding: 0; background: #fff; }
                .auth-page::before, .auth-page::after { display: none; }
                .auth-shell { display: block; width: 100%; min-height: 100svh; border: 0; border-radius: 0; box-shadow: none; }
                .auth-visual { display: none; }
                .auth-main { min-height: 100svh; justify-content: center; padding: 30px max(22px, env(safe-area-inset-left)) 24px; }
                .brand-link, .auth-form-container, .auth-footer { width: 100%; max-width: 440px; margin-right: auto; margin-left: auto; }
                .brand-link { margin-bottom: 28px; }
                .brand-logo { width: 53px; height: 53px; }
                .brand-name { font-size: 23px; }
            }

            @media (max-width: 420px) {
                .auth-main { justify-content: flex-start; padding-top: 24px; }
                .brand-link { margin-bottom: 24px; }
                .brand-tagline { max-width: 220px; }
                .auth-heading { margin-bottom: 18px; }
                .auth-form { gap: 14px; }
                .auth-options { align-items: flex-start; flex-direction: column; gap: 10px; }
                .support-row { align-items: flex-start; flex-direction: column; }
                .whatsapp-link { order: -1; }
            }

            @media (prefers-reduced-motion: reduce) {
                *, *::before, *::after { scroll-behavior: auto !important; transition: none !important; }
            }
        </style>
    </head>
    <body>
        <main class="auth-page">
            <section class="auth-shell" aria-label="Acceso a Verifika">
                <aside class="auth-visual" aria-label="IFE Educabol">
                    <a class="back-home" href="{{ url('/') }}">
                        <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                        Volver al inicio
                    </a>

                    <div class="visual-copy">
                        <span class="visual-badge">IFE Educabol</span>
                        <h2>Aprender se vuelve más simple.</h2>
                        <p>Práctica educativa creada para avanzar con claridad, confianza y buenos resultados.</p>
                    </div>

                    <div
                        class="david-photo"
                        role="img"
                        aria-label="David Flores de IFE Educabol"
                    ></div>
                </aside>

                <div class="auth-main">
                    <a class="brand-link" href="{{ url('/') }}" aria-label="Verifika, ir al inicio">
                        <img
                            class="brand-logo"
                            src="{{ asset('images/logo-ife-educabol-ofical-instituto-de-formacion-educabol.png') }}"
                            alt="Logo de IFE Educabol"
                            width="60"
                            height="60"
                        >
                        <span>
                            <strong class="brand-name">Verifika</strong>
                            <small class="brand-tagline">Genera ejercicios, practica y verifica tus respuestas.</small>
                        </span>
                    </a>

                    <div class="auth-form-container">
                        {{ $slot }}
                    </div>

                    <footer class="auth-footer">
                        <div class="support-row">
                            <div class="social-links" aria-label="Redes sociales de IFE Educabol">
                                <a class="social-link" href="https://www.tiktok.com/@ife_educabol" target="_blank" rel="noopener noreferrer" aria-label="IFE Educabol en TikTok" title="TikTok @ife_educabol">
                                    <i class="fa-brands fa-tiktok" aria-hidden="true"></i>
                                </a>
                                <a class="social-link" href="https://www.facebook.com/ife.educabol" target="_blank" rel="noopener noreferrer" aria-label="IFE Educabol en Facebook" title="Facebook IFE Educabol">
                                    <i class="fa-brands fa-facebook-f" aria-hidden="true"></i>
                                </a>
                                <a class="social-link" href="https://www.youtube.com/@ife_educabol" target="_blank" rel="noopener noreferrer" aria-label="IFE Educabol en YouTube" title="YouTube @ife_educabol">
                                    <i class="fa-brands fa-youtube" aria-hidden="true"></i>
                                </a>
                                <a class="social-link" href="https://www.instagram.com/ife_educabol/" target="_blank" rel="noopener noreferrer" aria-label="IFE Educabol en Instagram" title="Instagram @ife_educabol">
                                    <i class="fa-brands fa-instagram" aria-hidden="true"></i>
                                </a>
                            </div>

                            <a
                                class="whatsapp-link"
                                href="https://wa.me/59175553338?text={{ rawurlencode('Hola, vengo de Verifika y quisiera más información.') }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="Contactar a IFE Educabol por WhatsApp"
                            >
                                <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                                <span>¿Necesitas ayuda?<br>+591 75553338</span>
                            </a>
                        </div>
                    </footer>
                </div>
            </section>
        </main>
    </body>
</html>
