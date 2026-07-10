<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifika - Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <style>
        :root {
            --primary-color: rgb(38,186,165);
            --secondary-color: rgb(55,95,122);
            --white: #fff;
            --gray: #f4f6f8;
            --gray-dark: #bfc9d1;
        }
        /* Animación de zoom infinito para el logo */
        .logo-pulse {
            animation: pulseLogo 1.2s infinite;
        }
        @keyframes pulseLogo {
            0% { transform: scale(1); filter: brightness(1); }
            20% { transform: scale(1.18); filter: brightness(1.15); }
            40% { transform: scale(1.05); filter: brightness(1.08); }
            60% { transform: scale(1.18); filter: brightness(1.15); }
            80% { transform: scale(1); filter: brightness(1); }
            100% { transform: scale(1); filter: brightness(1); }
        }
        .operation-card {
            border: 2px solid var(--primary-color);
            border-radius: 1rem;
            transition: box-shadow .2s, border-color .2s, background .2s;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: var(--white);
        }
        .operation-card:hover {
            box-shadow: 0 12px 32px rgba(38,186,165,0.22), 0 2px 12px rgba(55,95,122,0.13);
            border-color: var(--primary-color);
            border-width: 4px;
            transform: translateY(-8px) scale(1.08);
            z-index: 2;
            background: linear-gradient(90deg, var(--white) 60%, var(--primary-color) 100%);
        }
        .operation-card.disabled {
            opacity: 1;
            pointer-events: auto;
            filter: grayscale(0.2);
        }
        .operation-card:hover {
            box-shadow: 0 8px 24px rgba(38,186,165,0.18), 0 1.5px 8px rgba(55,95,122,0.10);
            border-color: rgb(55,95,122);
            transform: translateY(-4px) scale(1.03);
            z-index: 2;
            background: linear-gradient(90deg, #f8fffc 60%, #eafaf7 100%);
        }
        .operation-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .operation-card:active {
            box-shadow: 0 2px 8px rgba(38,186,165,0.10);
            background: var(--gray);
            border-color: var(--secondary-color);
            transform: scale(0.97);
        }
        .btn-corporativo {
            background: var(--primary-color);
            color: #fff;
            border: none;
            box-shadow: 0 2px 8px rgba(38,186,165,0.10);
            transition: background .2s, box-shadow .2s, transform .1s;
        }
        .btn-corporativo:hover {
            background: var(--secondary-color);
            color: #fff;
        }
        .btn-corporativo:active {
            background: var(--primary-color);
            color: #fff;
            box-shadow: 0 1px 4px rgba(38,186,165,0.10);
            transform: scale(0.97);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container align-items-center d-flex">
            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                <span class="logo-circle position-relative logo-pulse" style="display:inline-block;width:48px;height:48px;background:#fff;border-radius:50%;box-shadow:0 2px 8px rgba(38,186,165,.10);overflow:hidden;vertical-align:middle;">
                    <img src="{{ asset('images/isologo-ife-educabol-ofical-instituto-de-formacion-educabol.png') }}" alt="Isologo de IFE Educabol" style="width:38px;height:38px;object-fit:contain;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);">
                </span>
                <span style="font-weight:900;letter-spacing:.5px;">Verifika</span>
            </a>
            <div class="ms-auto d-flex gap-2 align-items-center">
                <span class="navbar-text me-2">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <h2 class="mb-4 text-center">¿Qué tipo de ejercicios quieres trabajar en Verifika?</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
            <div class="col">
                <a href="{{ route('sumas.create') }}" class="operation-card text-decoration-none text-dark shadow-sm">
                    <div class="operation-icon" style="color:var(--primary-color);">➕</div>
                    <h4 class="fw-bold" style="color:var(--secondary-color);">Suma</h4>
                    <p class="mb-0 text-secondary">Generar ejercicios de sumas</p>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('restas.create') }}" class="operation-card text-decoration-none text-dark shadow-sm">
                    <div class="operation-icon" style="color:var(--secondary-color);">➖</div>
                    <h4 class="fw-bold" style="color:var(--primary-color);">Resta</h4>
                    <p class="mb-0 text-secondary">Generar ejercicios de restas</p>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('multiplicaciones.create') }}" class="operation-card text-decoration-none text-dark shadow-sm">
                    <div class="operation-icon" style="color:var(--primary-color);">✖️</div>
                    <h4 class="fw-bold" style="color:var(--secondary-color);">Multiplicación</h4>
                    <p class="mb-0 text-secondary">Generar ejercicios de multiplicaciones</p>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('divisiones.nueva.create') }}" class="operation-card text-decoration-none text-dark shadow-sm">
                    <div class="operation-icon" style="color:var(--secondary-color);">➗</div>
                    <h4 class="fw-bold" style="color:var(--primary-color);">División</h4>
                    <p class="mb-0 text-secondary">Generar ejercicios de divisiones</p>
                </a>
            </div>
            <div class="col">
                <a href="#" class="operation-card text-decoration-none text-dark shadow-sm disabled" onclick="showConstruccion(event)">
                    <div class="operation-icon" style="color:var(--primary-color);">¾</div>
                    <h4 class="fw-bold" style="color:var(--secondary-color);">Fracciones</h4>
                    <p class="mb-0 text-secondary">Próximamente</p>
                </a>
            </div>
            <div class="col">
                <a href="#" class="operation-card text-decoration-none text-dark shadow-sm disabled" onclick="showConstruccion(event)">
                    <div class="operation-icon" style="color:var(--secondary-color);">x²</div>
                    <h4 class="fw-bold" style="color:var(--primary-color);">Potenciación</h4>
                    <p class="mb-0 text-secondary">Próximamente</p>
                </a>
            </div>
            <div class="col">
                <a href="#" class="operation-card text-decoration-none text-dark shadow-sm disabled" onclick="showConstruccion(event)">
                    <div class="operation-icon" style="color:var(--primary-color);">√</div>
                    <h4 class="fw-bold" style="color:var(--secondary-color);">Radicación</h4>
                    <p class="mb-0 text-secondary">Próximamente</p>
                </a>
            </div>
            <div class="col">
                <a href="#" class="operation-card text-decoration-none text-dark shadow-sm disabled" onclick="showConstruccion(event)">
                    <div class="operation-icon" style="color:var(--secondary-color);">D</div>
                    <h4 class="fw-bold" style="color:var(--primary-color);">Descomposición</h4>
                    <p class="mb-0 text-secondary">Próximamente</p>
                </a>
            </div>
            <div class="col">
                <a href="#" class="operation-card text-decoration-none text-dark shadow-sm disabled" onclick="showConstruccion(event)">
                    <div class="operation-icon" style="color:var(--primary-color);">( ) [ ] { }</div>
                    <h4 class="fw-bold" style="color:var(--secondary-color);">Signos de agrupación</h4>
                    <p class="mb-0 text-secondary">Próximamente</p>
                </a>
            </div>
            <!-- Modal de En Construcción -->
            <div class="modal fade" id="modalConstruccion" tabindex="-1" aria-labelledby="modalConstruccionLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="border-radius:18px;">
                        <div class="modal-header" style="border-bottom:0;">
                            <h5 class="modal-title w-100 text-center" id="modalConstruccionLabel" style="font-weight:900;color:var(--primary-color);">
                                🚧 En construcción
                            </h5>
                        </div>
                        <div class="modal-body text-center">
                            <span class="logo-circle position-relative logo-pulse" style="display:inline-block;width:68px;height:68px;background:#fff;border-radius:50%;box-shadow:0 2px 12px rgba(38,186,165,.10);overflow:hidden;vertical-align:middle;margin-bottom:1rem;">
                                <img src="{{ asset('images/isologo-ife-educabol-ofical-instituto-de-formacion-educabol.png') }}" alt="Isologo de IFE Educabol" style="width:54px;height:54px;object-fit:contain;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);">
                            </span>
                            <p class="mb-0" style="color:var(--secondary-color);font-size:1.1rem;">Esta herramienta estará disponible muy pronto.<br>¡Gracias por tu interés!</p>
                        </div>
                        <div class="modal-footer justify-content-center" style="border-top:0;">
                            <button type="button" class="btn btn-corporativo px-4" data-bs-dismiss="modal">Entendido</button>
                        </div>
                    </div>
                </div>
            </div>
        </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
            <script>
            function showConstruccion(e) {
                e.preventDefault();
                var modal = new bootstrap.Modal(document.getElementById('modalConstruccion'));
                modal.show();
            }
            </script>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('practicos.index') }}" class="btn btn-lg btn-corporativo">Ver mis prácticos</a>
        </div>
    </div>
    <footer class="text-center text-muted small py-3 mt-4">
        &copy; {{ date('Y') }} Ejercicios Propuestos
    </footer>
</body>
</html>
