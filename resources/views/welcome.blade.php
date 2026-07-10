{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="es-BO">
<head>
    @php
        $siteName = $projectName ?? 'Verifika';
        $seoTitle = $siteName . ' | Ejercicios de matemáticas y material educativo de IFE Educabol';
        $seoDescription = 'Genera ejercicios de matemáticas personalizados, soluciones paso a paso y material educativo en PDF para primaria y secundaria con IFE Educabol.';
        $canonicalUrl = url()->current();
        $seoImage = asset('images/logo-ife-educabol-ofical-instituto-de-formacion-educabol.png');
        $isologo = asset('images/isologo-ife-educabol-ofical-instituto-de-formacion-educabol.png');
    @endphp
        <!-- Fuentes corporativas -->
        <style>
            @font-face {
                font-family: 'GlyphaLTStd-Bold';
                src: url('/fonts/GlyphaLTStd-Bold.otf') format('opentype');
                font-weight: bold;
                font-style: normal;
            }
            @font-face {
                font-family: 'Montserrat';
                src: url('/fonts/Montserrat-Regular.otf') format('opentype');
                font-weight: normal;
                font-style: normal;
            }
            @font-face {
                font-family: 'Montserrat';
                src: url('/fonts/Montserrat-Bold.otf') format('opentype');
                font-weight: bold;
                font-style: normal;
            }
            body, html {
                font-family: 'Montserrat', Arial, sans-serif;
            }
            h1, h2, h3, .hero-title {
                font-family: 'GlyphaLTStd-Bold', Arial, sans-serif !important;
                color: rgb(55,95,122) !important;
            }
        </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="IFE Educabol, Instituto de Formación Educabol, ejercicios de matemáticas, matemáticas primaria, matemáticas secundaria, material educativo PDF, ejercicios paso a paso, apoyo escolar Bolivia, educación tecnológica">
    <meta name="author" content="IFE Educabol - Instituto de Formación Educabol">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    <meta name="theme-color" content="#26baa5">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <link rel="icon" type="image/png" href="{{ $isologo }}">
    <link rel="apple-touch-icon" href="{{ $isologo }}">

    <meta property="og:locale" content="es_BO">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="IFE Educabol">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:image:alt" content="Logo de IFE Educabol, Instituto de Formación Educabol">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">
    <meta name="twitter:image:alt" content="Logo de IFE Educabol, Instituto de Formación Educabol">

    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'EducationalOrganization',
                    '@id' => url('/#organization'),
                    'name' => 'IFE Educabol',
                    'alternateName' => 'Instituto de Formación Educabol',
                    'url' => url('/'),
                    'logo' => $seoImage,
                    'image' => $seoImage,
                    'description' => 'Instituto de formación y apoyo escolar en matemáticas, programación, robótica, computación, diseño gráfico e inteligencia artificial.',
                    'areaServed' => ['@type' => 'Country', 'name' => 'Bolivia'],
                    'contactPoint' => [
                        '@type' => 'ContactPoint',
                        'telephone' => '+59171324941',
                        'contactType' => 'customer service',
                        'availableLanguage' => 'Spanish',
                    ],
                ],
                [
                    '@type' => 'WebSite',
                    '@id' => url('/#website'),
                    'url' => url('/'),
                    'name' => $siteName,
                    'description' => $seoDescription,
                    'inLanguage' => 'es-BO',
                    'publisher' => ['@id' => url('/#organization')],
                ],
                [
                    '@type' => 'WebApplication',
                    '@id' => url('/#webapp'),
                    'name' => $siteName,
                    'url' => url('/'),
                    'applicationCategory' => 'EducationalApplication',
                    'operatingSystem' => 'Web',
                    'inLanguage' => 'es-BO',
                    'description' => $seoDescription,
                    'publisher' => ['@id' => url('/#organization')],
                ],
            ],
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    {{-- intl-tel-input --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.min.css" />

    {{-- Estilos internos para portabilidad (sin depender de corporativo.css) --}}
    <style>
        :root{
            --p: rgb(38,186,165);   /* corporativo */
            --s: rgb(55,95,122);    /* corporativo */
            --ink: #0b1220;
            --muted: #5b667a;
            --bg: #f6f8fb;
            --card: #ffffff;
            --stroke: rgba(15, 23, 42, .10);
            --shadow: 0 16px 40px rgba(15,23,42,.08);
            --radius: 18px;
        }

        html{ scroll-behavior:smooth; }
        body{
            background: radial-gradient(1200px 500px at 15% -10%, rgba(38,186,165,.20), transparent 55%),
                        radial-gradient(900px 500px at 90% 0%, rgba(55,95,122,.18), transparent 55%),
                        var(--bg);
            color: var(--ink);
        }

        /* Navbar */
        .navbar{
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            background: rgba(255,255,255,.85) !important;
            border-bottom: 1px solid var(--stroke);
        }
        .brand{
            display:flex; align-items:center; gap:.6rem;
            font-weight: 800;
            letter-spacing: .2px;
            color: var(--s) !important;
            text-decoration:none;
        }
        .brand-badge{
            width: 38px; height: 38px;
            border-radius: 12px;
            display:grid; place-items:center;
            background: linear-gradient(135deg, rgba(38,186,165,1), rgba(55,95,122,1));
            box-shadow: 0 10px 20px rgba(55,95,122,.18);
            color:white; font-weight:900;
        }
        .nav-link{
            color: rgba(11,18,32,.75) !important;
            font-weight: 600;
        }
        .nav-link:hover{ color: var(--s) !important; }

        /* Botones corporativos */
        .btn-corp{
            --bs-btn-color:#fff;
            --bs-btn-bg: var(--p);
            --bs-btn-border-color: transparent;
            --bs-btn-hover-bg: #20a996;
            --bs-btn-hover-border-color: transparent;
            --bs-btn-focus-shadow-rgb: 38,186,165;
            border-radius: 14px;
            padding: .8rem 1.1rem;
            font-weight: 700;
        }
        .btn-outline-corp{
            --bs-btn-color: var(--s);
            --bs-btn-border-color: rgba(55,95,122,.35);
            --bs-btn-hover-bg: rgba(55,95,122,.08);
            --bs-btn-hover-border-color: rgba(55,95,122,.55);
            --bs-btn-focus-shadow-rgb: 55,95,122;
            border-radius: 14px;
            padding: .8rem 1.1rem;
            font-weight: 700;
            background: rgba(255,255,255,.75);
        }

        /* Hero */
        .hero{
            padding: clamp(3.5rem, 6vw, 5.5rem) 0;
            position: relative;
        }
        .hero-card{
            background: linear-gradient(180deg, rgba(255,255,255,.92), rgba(255,255,255,.80));
            border: 1px solid var(--stroke);
            border-radius: calc(var(--radius) + 8px);
            box-shadow: var(--shadow);
            overflow:hidden;
        }
        .hero-left{
            padding: clamp(1.25rem, 3vw, 2.25rem);
        }
        .kicker{
            display:inline-flex; align-items:center; gap:.5rem;
            padding: .45rem .75rem;
            border-radius: 999px;
            background: rgba(38,186,165,.10);
            border: 1px solid rgba(38,186,165,.22);
            color: var(--s);
            font-weight: 700;
            font-size: .92rem;
        }
        .kicker .dot{
            width: 9px; height: 9px; border-radius: 999px;
            background: var(--p);
            box-shadow: 0 0 0 4px rgba(38,186,165,.20);
        }
        .hero-title{
            font-weight: 900;
            letter-spacing: -.6px;
            line-height: 1.05;
        }
        .hero-title span{
            background: linear-gradient(90deg, var(--p), var(--s));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .hero-text{
            color: var(--muted);
            font-size: 1.05rem;
            line-height: 1.6;
            max-width: 55ch;
        }
        .hero-metrics{
            display:flex; gap: 1rem; flex-wrap: wrap;
            margin-top: 1rem;
        }
        .metric{
            background: rgba(255,255,255,.75);
            border: 1px solid var(--stroke);
            border-radius: 16px;
            padding: .8rem .95rem;
            min-width: 170px;
        }
        .metric b{ display:block; font-size: 1.05rem; color: var(--ink); }
        .metric small{ color: var(--muted); }

        .hero-right{
            position: relative;
            padding: clamp(1.25rem, 3vw, 2.25rem);
            background:
                radial-gradient(400px 200px at 20% 0%, rgba(38,186,165,.25), transparent 60%),
                radial-gradient(420px 220px at 90% 30%, rgba(55,95,122,.22), transparent 60%),
                linear-gradient(135deg, rgba(55,95,122,.06), rgba(38,186,165,.06));
            border-left: 1px solid var(--stroke);
        }
        .mock{
            background: rgba(255,255,255,.88);
            border: 1px solid var(--stroke);
            border-radius: 22px;
            padding: 1rem;
            box-shadow: 0 18px 40px rgba(15,23,42,.10);
        }
        .mock-top{
            display:flex; align-items:center; justify-content:space-between;
            margin-bottom: .85rem;
        }
        .chip{
            display:inline-flex; align-items:center; gap:.5rem;
            padding: .35rem .6rem;
            border-radius: 999px;
            background: rgba(55,95,122,.08);
            border: 1px solid rgba(55,95,122,.16);
            color: var(--s);
            font-weight: 700;
            font-size: .85rem;
        }
        .lines{ display:grid; gap:.55rem; }
        .line{
            height: 12px;
            border-radius: 999px;
            background: linear-gradient(90deg, rgba(38,186,165,.25), rgba(55,95,122,.18));
        }
        .line.sm{ width: 65%; }
        .line.md{ width: 85%; }
        .line.lg{ width: 95%; }

        /* Secciones */
        .section{
            padding: clamp(3.25rem, 5vw, 4.5rem) 0;
        }
        .section-title{
            font-weight: 900;
            letter-spacing: -.4px;
        }
        .section-sub{
            color: var(--muted);
            max-width: 70ch;
            margin: 0 auto;
        }
        .cardx{
            background: rgba(255,255,255,.82);
            border: 1px solid var(--stroke);
            border-radius: var(--radius);
            box-shadow: 0 10px 26px rgba(15,23,42,.06);
            padding: 1.25rem;
            height: 100%;
        }
        .ico{
            width: 46px; height: 46px;
            border-radius: 16px;
            display:grid; place-items:center;
            background: rgba(38,186,165,.12);
            border: 1px solid rgba(38,186,165,.22);
            font-size: 1.2rem;
        }
        .cardx h5{ margin-top: .9rem; font-weight: 900; }
        .cardx p{ color: var(--muted); margin: 0; }

        /* CTA box */
        .cta{
            border-radius: calc(var(--radius) + 10px);
            border: 1px solid var(--stroke);
            background: linear-gradient(135deg, rgba(38,186,165,.14), rgba(55,95,122,.10));
            padding: clamp(1.25rem, 3vw, 2rem);
            box-shadow: var(--shadow);
        }

        /* Contact */
        .form-control, .form-select, textarea{
            border-radius: 14px !important;
            border: 1px solid rgba(15,23,42,.14) !important;
            padding: .85rem .95rem !important;
            background: rgba(255,255,255,.85) !important;
        }

        /* Mejorar visualización del input de teléfono con intl-tel-input */
        #phone.iti__tel-input {
            padding-left: 85px !important;
        }
        .iti {
            width: 100%;
        }
        /* Asegura que el código de país no se superponga con el select */
        .iti__selected-flag {
            z-index: 2;
            position: relative;
        }
        .iti__country-code {
            margin-left: 8px;
            font-weight: bold;
            background: #fff;
            padding: 0 4px;
        }
        }
        /* Espacio extra entre bandera y código */
        .iti__flag-container {
            width: 65px;
            margin-right: 0;
        }
        }
        }
        .form-control:focus, textarea:focus{
            box-shadow: 0 0 0 .22rem rgba(38,186,165,.18) !important;
            border-color: rgba(38,186,165,.5) !important;
        }

        /* WhatsApp floating */
        .wa-float{
            position: fixed;
            right: 18px;
            bottom: 18px;
            z-index: 1050;
        }
        .wa-btn{
            display:flex; align-items:center; gap:.55rem;
            text-decoration:none;
            background: #12b981;
            color: white;
            padding: .85rem 1rem;
            border-radius: 999px;
            box-shadow: 0 16px 32px rgba(18,185,129,.22);
            font-weight: 800;
        }
        .wa-btn:hover{ color:white; filter: brightness(.97); }

        /* Footer */
        footer{
            border-top: 1px solid var(--stroke);
            background: rgba(255,255,255,.70);
        }

        /* Responsive tweaks */
        @media (max-width: 991px){
            .hero-right{ border-left: 0; border-top: 1px solid var(--stroke); }
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container py-2">
        <a class="brand" href="#home" aria-label="Ir al inicio">
            <span style="display:grid;place-items:center;padding:0;">
                <img src="{{ asset('images/isologo-ife-educabol-ofical-instituto-de-formacion-educabol.png') }}" alt="Isologo de IFE Educabol" width="38" height="38" style="width:38px;height:38px;border-radius:12px;object-fit:contain;background:none;box-shadow:none;">
            </span>
            <span>{{ $projectName ?? 'Verifika' }}</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"
                aria-controls="nav" aria-expanded="false" aria-label="Abrir menú">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="#servicios">Servicios</a></li>
                <li class="nav-item"><a class="nav-link" href="#herramientas">Herramientas</a></li>
                <li class="nav-item"><a class="nav-link" href="#ife">IFE</a></li>
                <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>

                <li class="nav-item ms-lg-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-corp w-100 w-lg-auto">Iniciar sesión</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="btn btn-corp w-100 w-lg-auto">Registrarse</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- WhatsApp (cambia el número a tu número real) --}}
<div class="wa-float">
    <a class="wa-btn" href="https://wa.me/59171324941" target="_blank" rel="noopener" title="Escríbenos por WhatsApp">
        <span aria-hidden="true">💬</span> WhatsApp
    </a>
</div>

<section id="home" class="hero">
    <div class="container">
        <div class="hero-card">
            <div class="row g-0 align-items-stretch">
                <div class="col-lg-7">
                    <div class="hero-left">
                        <div class="kicker mb-3">
                            <span class="dot" aria-hidden="true"></span>
                            Hecho para apoyo escolar (Primaria y Secundaria)
                        </div>

                        <h1 class="hero-title display-5 mb-3">
                            {{ $projectName ?? 'Verifika' }}: <span>práctica inteligente</span> para mejorar en matemáticas
                        </h1>

                        <p class="hero-text mb-4">
                            Genera ejercicios a medida, incluye respuestas y desarrollo paso a paso.
                            Ideal para padres, docentes y estudiantes que quieren practicar sin perder tiempo.
                        </p>

                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('register') }}" class="btn btn-corp btn-lg">Comenzar gratis</a>
                            <a href="#herramientas" class="btn btn-outline-corp btn-lg">Ver herramientas</a>
                        </div>

                        <div class="hero-metrics">
                            <div class="metric">
                                <b>📌 A medida</b>
                                <small>elige tema y dificultad</small>
                            </div>
                            <div class="metric">
                                <b>🧠 Paso a paso</b>
                                <small>explicación lista para revisar</small>
                            </div>
                            <div class="metric">
                                <b>🖨️ Imprimible</b>
                                <small>material para casa o aula</small>
                            </div>
                        </div>

                        <div class="mt-4 text-muted small">
                            <span class="fw-bold" style="color:var(--s);">Tip:</span>
                            Si tu hijo “pasó raspando”, aquí nivelamos desde la base.
                            Si pasó bien, aquí lo preparamos para la próxima gestión.
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="hero-right">
                        <div class="mock">
                            <div class="mock-top">
                                <div class="chip">🧮 Generador</div>
                                <div class="chip">📄 PDF</div>
                            </div>
                            <div class="lines" aria-hidden="true">
                                <div class="line lg"></div>
                                <div class="line md"></div>
                                <div class="line lg"></div>
                                <div class="line sm"></div>
                                <div class="line md"></div>
                                <div class="line lg"></div>
                            </div>
                            <hr class="my-3" style="border-color: rgba(15,23,42,.10);">
                            <div class="d-flex align-items-center justify-content-between">
                                <small class="text-muted">Listo para practicar hoy</small>
                                <span class="chip">✅ Respuestas</span>
                            </div>
                        </div>

                        <div class="mt-3 p-3 rounded-4" style="background: rgba(255,255,255,.75); border:1px solid var(--stroke);">
                            <div class="d-flex align-items-start gap-2">
                                <div class="ico" style="width:42px;height:42px;border-radius:14px;">⚡</div>
                                <div>
                                    <div class="fw-bold">Minimalista y rápido</div>
                                    <div class="text-muted small">Diseño limpio, responsivo y con tus colores corporativos.</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="servicios" class="section">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title">Servicios</h2>
            <p class="section-sub mt-2">Apoyo real para avanzar con confianza, sin presión y con seguimiento.</p>
        </div>

        <div class="row g-3 g-lg-4">
            <div class="col-md-6 col-lg-4">
                <div class="cardx">
                    <div class="ico">📚</div>
                    <h5>Apoyo escolar</h5>
                    <p>Matemáticas, lenguaje, lectura, dictado y escritura con ejercicios guiados.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="cardx">
                    <div class="ico">🎯</div>
                    <h5>Nivelación</h5>
                    <p>Reforzamos bases (sumas, restas, multiplicación, división) y cerramos vacíos.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="cardx">
                    <div class="ico">🚀</div>
                    <h5>Preparación</h5>
                    <p>Si pasó con buenas notas, trabajamos para que inicie fuerte la siguiente gestión.</p>
                </div>
            </div>
        </div>

        <div class="mt-4 cta">
            <div class="row align-items-center g-3">
                <div class="col-lg-8">
                    <h3 class="mb-1 fw-black" style="font-weight:900;">¿Tu hijo se frustra con matemáticas?</h3>
                    <div class="text-muted">No es falta de capacidad: muchas veces es falta de acompañamiento. Aquí lo construimos paso a paso.</div>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a class="btn btn-corp btn-lg w-100 w-lg-auto" href="https://wa.me/59171324941" target="_blank" rel="noopener">
                        Hablar por WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="herramientas" class="section">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title">Herramientas</h2>
            <p class="section-sub mt-2">Tecnología simple, útil y enfocada en resultados.</p>
        </div>

        <div class="row g-3 g-lg-4">
            <div class="col-md-6 col-lg-4">
                <div class="cardx">
                    <div class="ico">🧮</div>
                    <h5>Generador de ejercicios</h5>
                    <p>Elige tema, dificultad y cantidad. Obtienes práctica lista para usar.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="cardx">
                    <div class="ico">🧠</div>
                    <h5>Soluciones paso a paso</h5>
                    <p>Perfecto para revisar rápido y enseñar “cómo se hace”, no solo el resultado.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="cardx">
                    <div class="ico">🖨️</div>
                    <h5>Exportación a PDF</h5>
                    <p>Imprime para casa o aula. Ideal para rutina diaria de 15–20 minutos.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="ife" class="section">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title">¿Qué es IFE?</h2>
            <p class="section-sub mt-2">
                En IFE Educabol, el Instituto de Formación Educabol, impulsamos el aprendizaje con cursos de apoyo escolar, programación, robótica, computación, diseño gráfico e inteligencia artificial. Nuestro objetivo es acercar la tecnología y el conocimiento a estudiantes de todas las edades, de forma práctica y creativa.
            </p>
        </div>

        <div class="row g-3 g-lg-4">
            <div class="col-md-6 col-lg-4">
                <div class="cardx">
                    <div class="ico">✅</div>
                    <h5>Claridad</h5>
                    <p>Menos ruido. Más práctica útil y explicación directa.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="cardx">
                    <div class="ico">📈</div>
                    <h5>Progreso</h5>
                    <p>Rutinas cortas que se notan en tareas, exámenes y confianza.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="cardx">
                    <div class="ico">🤝</div>
                    <h5>Comunidad</h5>
                    <p>Padres, docentes y estudiantes trabajando en el mismo objetivo.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contacto" class="section">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title">Contacto</h2>
            <p class="section-sub mt-2">
                Déjanos tu mensaje. Si es para apoyo escolar, dinos el curso y en qué tema necesita refuerzo.
            </p>
        </div>

        <div class="row justify-content-center g-3">
            <div class="col-lg-7">
                {{-- Nota: por ahora solo visual. Luego lo conectas a un route/controller --}}
                <form class="cardx">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nombre</label>
                        <input type="text" class="form-control" placeholder="Ej: María Rodríguez" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Teléfono</label>
                        <input id="phone" type="tel" class="form-control" required name="phone_number" placeholder="Ej: 7XXXXXXX">
                        <div class="form-text text-muted">Selecciona tu país y escribe tu número. El código se agrega automáticamente.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Mensaje</label>
                        <textarea class="form-control" rows="4" placeholder="Ej: Mi hijo está en 1ro de primaria y necesita nivelar multiplicación." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-corp w-100">Enviar</button>

                    <div class="text-center mt-3 small text-muted">
                        O si prefieres: <a href="https://wa.me/59171324941" target="_blank" rel="noopener" style="color:var(--s); font-weight:800;">escríbenos al 71324941</a>
                    </div>
                </form>
            </div>

            <div class="col-lg-5">
                <div class="cardx h-100">
                    <div class="d-flex align-items-start gap-2">
                        <div class="ico" style="background: rgba(55,95,122,.10); border-color: rgba(55,95,122,.18);">🕒</div>
                        <div>
                            <div class="fw-bold">Respuesta rápida</div>
                            <div class="text-muted">Coordinamos horario y objetivo: nivelar, preparar o reforzar.</div>
                        </div>
                    </div>

                    <hr class="my-3" style="border-color: rgba(15,23,42,.10);">

                    <div class="d-flex align-items-start gap-2">
                        <div class="ico">🧩</div>
                        <div>
                            <div class="fw-bold">Plan simple</div>
                            <div class="text-muted">15–20 min diarios de práctica bien elegida hace la diferencia.</div>
                        </div>
                    </div>

                    <div class="mt-4 cta">
                        <div class="fw-bold mb-1">¿Te gustaría unirte al proyecto?</div>
                        <div class="text-muted mb-3">Si enseñas o apoyas estudiantes, tu aporte suma muchísimo.</div>
                        <a href="https://wa.me/59171324941" target="_blank" rel="noopener" class="btn btn-corp w-100">
                            Unirme por WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="py-4">
    <div class="container text-center">
        <div class="small text-muted">
            © {{ date('Y') }} {{ $projectName ?? 'Verifika' }} · Hecho con 💚 en IFE Educabol
        </div>
    </div>
</footer>

{{-- JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.querySelector("#phone");
    if (input) {
        const iti = window.intlTelInput(input, {
            initialCountry: "bo",
            preferredCountries: ["bo","ar","cl","pe","co","mx","es","us","br","uy","ec"],
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
            nationalMode: false,
            autoPlaceholder: "polite"
        });
        // Forzar el foco y el cursor después del código
        function moveCursorAfterCode() {
            const code = iti.getSelectedCountryData().dialCode;
            const prefix = '+' + code;
            if (!input.value.startsWith(prefix)) {
                input.value = prefix;
            }
            setTimeout(function() {
                input.setSelectionRange(input.value.length, input.value.length);
            }, 10);
        }

        input.addEventListener('focus', moveCursorAfterCode);

        // Validar solo números después del código y mantener el cursor después del código
        input.addEventListener('input', function(e) {
            const code = iti.getSelectedCountryData().dialCode;
            const prefix = '+' + code;
            let val = input.value;
            if (!val.startsWith(prefix)) {
                val = prefix + val.replace(/[^0-9]/g, '');
            }
            let rest = val.slice(prefix.length);
            rest = rest.replace(/[^0-9]/g, '');
            input.value = prefix + rest;
            // Si el cursor está antes del código, lo mueve al final del prefijo
            const pos = input.selectionStart;
            if (pos <= prefix.length) {
                input.setSelectionRange(input.value.length, input.value.length);
            }
        });

        // Si el usuario cambia de país, mantener el cursor después del código
        input.addEventListener('countrychange', moveCursorAfterCode);
    }
});
</script>
</body>
</html>
