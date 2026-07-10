<!-- resources/views/division.blade.php -->
<!-- resources/views/division.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIVPAD - División Paso a Paso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
/* Estilos generales */
body {
    font-family: 'Arial', sans-serif;
    background-color: #ffffff;
    margin: 0;
    padding: 0;
    color: rgb(55, 95, 122);
    line-height: 1.6;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
    color: rgb(55, 95, 122);
    font-size: 2.5rem;
    margin-bottom: 20px;
}

h4 {
    color: rgb(55, 95, 122);
    font-size: 1.5rem;
    margin-bottom: 15px;
}

/* Formulario */
.formulario {
    background-color: rgb(38, 186, 165);
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    display: flex;
    gap: 10px;
    align-items: center;
}

.grupo {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 10px;
}

.grupo label {
    font-weight: bold;
    color: white;
    white-space: nowrap; /* Evita que el texto se divida en varias líneas */
}

.grupo input {
    width: 100%;
    padding: 10px;
    border: 1px solid rgb(55, 95, 122);
    border-radius: 4px;
    font-size: 1rem;
    background-color: white;
    color: rgb(55, 95, 122);
    flex: 1;
}

/*%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  BOTON DIVIDIR %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%*/

.grupo.boton button {
    background-color: rgb(55, 95, 122);
    color: white;
    border: none;
    height: 50px;
    padding: 10px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

.grupo.boton button:hover {
    background-color: rgb(22, 179, 14);
}

/* Tabla de división */
table {
    width: auto; /* Ajustar al contenido */
    border-collapse: collapse;
    margin-bottom: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

table td {
    padding: 0;
    border: 1px solid rgb(227, 226, 227);
    text-align: center;
    vertical-align: middle;
    font-size: 1.5rem; /* Tamaño de fuente más grande */
    width: 50px; /* Tamaño fijo para celdas cuadradas */
    height: 50px; /* Tamaño fijo para celdas cuadradas */
    position: relative;
}

/* Símbolo de división */
.simbolo-division {
    position: relative;
}

.simbolo-division::after {
    content: "";
    position: absolute;
    bottom: -1px; /* Borde inferior */
    left: 0;
    right: 0;
    height: 2px;
    background-color: rgb(55, 95, 122);
}
/* Estilos para la tabla */
#cuadriculas {
    border-collapse: collapse;
    margin: 20px auto;
}

#cuadriculas td {
    width: 50px;
    height: 50px;
    text-align: center;
    vertical-align: middle;
    border: 1px solid #ccc;
    position: relative;
}

/* Borde izquierdo e inferior */
.izquierda-abajo {
    border-left: 2px solid rgb(55, 95, 122) !important;
    border-bottom: 2px solid rgb(55, 95, 122) !important;
}

/* Solo borde inferior */
.abajo {
    border-bottom: 2px solid rgb(55, 95, 122) !important;
}

/* Ajustar tamaño de fuente al 90% del área */
table td span {
    display: inline-block;
    width: 90%;
    height: 90%;
    line-height: 45px; /* Centrar verticalmente */
    font-size: 90%; /* Ajustar tamaño de fuente */
}

/* Botones de navegación */
form[method="POST"] {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

form[method="POST"] button {
    background-color: rgb(55, 95, 122);
    color: white;
    border: none;
    padding: 10px 10px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease;
    flex: 1;
    min-width: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1px;
}

form[method="POST"] button[name="accion"][value="reiniciar"] {
    background-color: rgb(38, 186, 165);
}

form[method="POST"] button[name="accion"][value="atras"] {
    background-color: rgb(55, 95, 122);
}

form[method="POST"] button[name="accion"][value="siguiente"] {
    background-color: rgb(55, 95, 122);
}

form[method="POST"] button[name="accion"][value="resolver"] {
    background-color: rgb(38, 186, 165);
}

form[method="POST"] button:hover {
    opacity: 0.9;
}

/* Iconos de FontAwesome */
@import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css");

/* Texto de paso actual */
p {
    text-align: center;
    font-size: 1.2rem;
    color: rgb(55, 95, 122);
    margin-bottom: 20px;
}

/* Responsividad */
@media (max-width: 768px) {
    .formulario {
        flex-direction: row; /* Siempre en una fila */
    }

    .grupo {
        flex-direction: row;
        width: auto;
    }

    .grupo.boton {
        width: auto;
    }

    .grupo.boton button {
        width: auto;
    }

    form[method="POST"] {
        flex-direction: row;
    }

    form[method="POST"] button {
        width: auto;
    }
}

/*sds*/
/* Estilos base para los botones */
form[method="POST"] button {
    background-color: rgb(55, 95, 122);
    color: white;
    border: none;
    padding: 10px 20px; /* Ajusta el padding para pantallas grandes */
    border-radius: 4px; /* Bordes redondeados para pantallas grandes */
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease;
    flex: 1;
    min-width: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
}

/* Estilos específicos para pantallas pequeñas (menos de 768px) */
@media (max-width: 768px) {
    form[method="POST"] button {
        padding: 10px; /* Reduce el padding para pantallas pequeñas */
        border-radius: 50%; /* Hace que los botones sean circulares */
        width: 50px; /* Tamaño fijo para botones circulares */
        height: 100px; /* Tamaño fijo para botones circulares */
        min-width: auto; /* Elimina el ancho mínimo */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    form[method="POST"] button i {
        margin: 0; /* Elimina el margen de los íconos */
    }

    form[method="POST"] button span {
        display: none; /* Oculta el texto en pantallas pequeñas */
    }
}

/* Estilos específicos para pantallas grandes (más de 768px) */
@media (min-width: 769px) {
    form[method="POST"] button {
        padding: 10px 20px; /* Ajusta el padding para pantallas grandes */
        border-radius: 4px; /* Bordes redondeados para pantallas grandes */
        width: auto; /* Ancho automático para botones rectangulares */
        height: auto; /* Altura automática para botones rectangulares */
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    form[method="POST"] button span {
        display: inline; /* Muestra el texto en pantallas grandes */
    }
}

/* Estilos para botones específicos */
form[method="POST"] button[name="accion"][value="reiniciar"] {
    background-color: rgb(38, 186, 165);
}

form[method="POST"] button[name="accion"][value="atras"] {
    background-color: rgb(55, 95, 122);
}

form[method="POST"] button[name="accion"][value="siguiente"] {
    background-color: rgb(55, 95, 122);
}

form[method="POST"] button[name="accion"][value="resolver"] {
    background-color: rgb(38, 186, 165);
}

form[method="POST"] button:hover {
    opacity: 0.9;
}
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>IFE SOLVE</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('division.dividir') }}" class="formulario">
            @csrf
           
            <div class="grupo">
                <label for="dividendo"></label>
                <input type="number" id="dividendo" name="dividendo" value="1234" required placeholder="Dividendo">
            </div>
            <div class="grupo">
                <label for="divisor"></label>
                <input type="number" id="divisor" name="divisor" value="5" required placeholder="Divisor">
            </div>
            <div class="grupo boton">
                <button id="dividir" type="submit">Dividir</button>
            </div>
        </form>
        @isset($cuadricula)
            <div class="">
                <div class="mt-3">
                    <form method="POST" action="{{ route('division.navegar') }}">
                        @csrf
                        <button type="submit" name="accion" value="reiniciar">
                            <i class="fas fa-sync-alt"></i> <span>Reiniciar</span>
                        </button>
                        <button type="submit" name="accion" value="atras">
                            <i class="fas fa-arrow-left"></i> <span>Atrás</span>
                        </button>
                        <button type="submit" name="accion" value="siguiente">
                            <i class="fas fa-arrow-right"></i> <span>Siguiente</span>
                        </button>
                        <button type="submit" name="accion" value="resolver">
                            <i class="fas fa-fast-forward"></i> <span>Resolver Todo</span>
                        </button>
                    </form>
                </div>
    
                <div class="mt-3">
                    <p>Paso {{ $pasoActual + 1 }} de {{ $totalPasos }}</p>
                </div>
                

                <table id="cuadriculas">
                    @php
                    $i = 0; // Contador de filas
                @endphp
                @foreach($cuadricula as $fila)
                    <tr>
                        @php
                            $j = 0; // Contador de columnas
                        @endphp
                        @foreach($fila as $celda)
                            @if($i == 0) <!-- Solo aplicamos estilos a la primera fila -->
                                @if($j == $count_digitos_divisor) <!-- Primera celda del divisor -->
                                    <td class="izquierda-abajo">
                                        <span>{{ $celda }}</span>
                                    </td>
                                @elseif($j > $count_digitos_divisor) <!-- Celdas restantes del divisor -->
                                    <td class="abajo">
                                        <span>{{ $celda }}</span>
                                    </td>
                                @else <!-- Celdas del dividendo -->
                                    <td>
                                        <span>{{ $celda }}</span>
                                    </td>
                                @endif
                            @else <!-- Otras filas -->
                                <td>
                                    <span>{{ $celda }}</span>
                                </td>
                            @endif
                            @php
                                $j++; // Incrementar contador de columnas
                            @endphp
                        @endforeach
                    </tr>
                    @php
                        $i++; // Incrementar contador de filas
                    @endphp
                @endforeach
                </table>
            </div>
        @endisset
    </div>
    <script>
        // Función para dibujar el símbolo de división
        function dibujarSimboloDivision(indiceDivisor) {
            // Obtener la tabla por su ID
            const tabla = document.getElementById("cuadriculas");
    
            // Verificar que la tabla existe
            if (!tabla) {
                console.error("No se encontró la tabla con id='cuadriculas'");
                return;
            }
    
            // Obtener la primera fila de la tabla (fila 0)
            const fila = tabla.rows[0];
    
            // Verificar que el índice del divisor es válido
            if (indiceDivisor < 0 || indiceDivisor >= fila.cells.length) {
                console.error("Índice del divisor fuera de rango");
                return;
            }
    
            // Aplicar estilos a las celdas para dibujar el símbolo de división
            for (let i = indiceDivisor; i < fila.cells.length; i++) {
                const celda = fila.cells[i];
    
                // Aplicar borde inferior a todas las celdas
                celda.style.borderBottom = "2px solid rgb(55, 95, 122)";
    
                // Aplicar borde izquierdo solo a la primera celda
                if (i === indiceDivisor) {
                    celda.style.borderLeft = "2px solid rgb(55, 95, 122)";
                }
            }
        }
    
        // Obtener el índice del divisor desde PHP
        const countDigitosDivisor = <?php echo json_encode($count_digitos_divisor ?? null); ?>;
    
        // Dibujar el símbolo de división si el índice es válido
        if (countDigitosDivisor !== null) {
            dibujarSimboloDivision(countDigitosDivisor);
        }
    </script>
</body>
</html>
