<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>División - Procedimiento</title>
    <style>
        @page { margin: 2cm; }
        body {
            font-family: Arial, sans-serif;
            /* Fondo limpio sin trama para mejor legibilidad */
            background: #fff;
        }
        /* Encabezado estilo PDF (igual que multiplicación) */
        .pdf-membrete{
            width: 100%;
            background: transparent; /* sin fondo */
            color: #333; /* texto visible sobre blanco */
            margin: 0;
            border-spacing: 0;
            border-collapse: collapse;
        }
        .pdf-membrete__left{ vertical-align: top; padding: 8px 10px; }
        .pdf-membrete__title{ font-size: 1.5em; font-weight: bold; margin: 0; padding: 0; line-height: 1.1; }
        .pdf-membrete__info{ font-size: 1.05em; margin: 4px 0 0 0; padding: 0; line-height: 1.2; }
        .pdf-membrete__email{ font-size: 0.95em; }
        .pdf-membrete__right{ width: 80px; text-align: right; vertical-align: top; padding: 6px 8px 0 0; font-size: 0; line-height: 0; }
        .pdf-membrete__logo-wrap{
            display: inline-block;
            background: transparent; /* sin fondo */
            border: none;            /* sin borde */
            border-radius: 0;       /* sin círculo */
            padding: 0;
            box-sizing: border-box;
        }
        .pdf-membrete__logo{
            display: block;
            margin: 0;
            padding: 0;
            border: 0;
            vertical-align: top;
            width: 100px;   /* controla el ancho (más grande) */
            height: auto;  /* preserva proporción original */
        }
        .cuadricula {
            border-collapse: collapse;
            margin: 10px 0 18px 0;
        }
        .cuadricula td {
            border: 1px solid #bbb;
            width: 1.2em;
            height: 1.2em;
            text-align: center;
            font-size: 1.2em;
            font-family: monospace;
        }
        .inciso-label { font-weight: bold; text-align: left; padding-right: 8px; }
        .ej-titulo { font-size: 1.1em; font-weight: bold; margin: 18px 0 4px 0; }

        /* Separadores encabezado/body */
        .sep-primary { height: 4px; background: rgb(38,186,165); }
        .sep-secondary { height: 2px; background: rgb(55,95,122); margin-top: 2px; }

        /* Pie de página creativo y limpio */
        .footer-bars { margin-top: 12px; }
        .footer-bar-primary { height: 2px; background: rgb(55,95,122); }
        .footer-bar-secondary { height: 1px; background: rgb(38,186,165); margin-top: 2px; }
        .footer-content { text-align: center; font-size: 12px; color: #555; padding: 6px 0; }
        .ej-grado { font-size: 0.95em; color: #888; margin-left: 8px; }
    </style>
</head>
<body>
        <!-- Encabezado -->
        <table class="pdf-membrete">
            <tr class="pdf-membrete__row">
                <td class="pdf-membrete__left">
                    <div class="pdf-membrete__title">Ejercicios Propuestos</div>
                    <div class="pdf-membrete__info">
                        Ningún niño fracasa por falta de capacidad,
                        &nbsp; | &nbsp; <span class="pdf-membrete__email"> IFE Educabol · +591 75553338</span>
                    </div>
                </td>
                <td class="pdf-membrete__right">
                    <div class="pdf-membrete__logo-wrap">
                        <img class="pdf-membrete__logo" src="{{ public_path('images/logo-ife-educabol-ofical-instituto-de-formacion-educabol.png') }}" alt="Logo de IFE Educabol">
                    </div>
                </td>
            </tr>
        </table>
        <!-- Separadores del encabezado -->
        <div class="sep-primary"></div>
        <div class="sep-secondary"></div>
    <h2>División con procedimiento</h2>

    @php $ejercicioNum = 1; @endphp

    @for($i = 0; $i < count($practico->ejercicios); $i += 2)
        @php
            $ejA = $practico->ejercicios[$i] ?? null;
            $ejB = $practico->ejercicios[$i+1] ?? null;
        @endphp

        <div class="ej-titulo">Ejercicio {{ $ejercicioNum }}
            <span class="ej-grado">[{{ $ejA->grado ?? ($ejB->grado ?? '') }}]</span>
        </div>

        <table style="width:100%; border-collapse:collapse;">
            <tr>
                {{-- ======================= INCISO A ======================= --}}
                <td style="vertical-align:top; width:49%;">
                    @php $pasosA = $pasosEjercicios[$i] ?? null; @endphp

                    @if($ejA && $pasosA)
                        <div class="inciso-label">a)</div>

                        @php
                            $divisorStrA = strval($pasosA['divisor']);
                            $divLenA = strlen($pasosA['dividendo']);
                            $st0 = $pasosA['steps'][0] ?? null;
                        @endphp

                        <table class="cuadricula" style="margin-bottom:10px;">
                            {{-- FILA 0: Dividendo L Divisor --}}
                            <tr>
                                @for($d=0; $d < $divLenA; $d++)
                                    <td style="font-weight:bold; background:#f2f2f2;">
                                        {{ $pasosA['dividendo'][$d] }}
                                    </td>
                                @endfor

                                @for($d=0; $d < strlen($divisorStrA); $d++)
                                    <td style="background:#f2f2f2; font-weight:bold; border-left:{{ $d==0 ? '2px solid #000' : 'none' }}; border-bottom:2px solid #000;">
                                        {{ $divisorStrA[$d] }}
                                    </td>
                                @endfor
                            </tr>

                            {{-- FILA 1: reach del paso 0 (multi-dígito) + primera bajada + cociente --}}
                            <tr>
                                @for($d=0; $d < $divLenA; $d++)
                                    <td style="background:#fff; font-family:monospace; text-align:center;">
                                        @if($st0)
                                            @php
                                                $reachStr0 = strval($st0['reach']);     // ej "16"
                                                $reachLen0 = strlen($reachStr0);
                                                $rightCol0 = intval($st0['index']);     // donde debe terminar
                                                $startCol0 = $rightCol0 - $reachLen0 + 1;
                                            @endphp

                                            {{-- DIBUJAR reach repartido por celdas --}}
                                            @if($reachLen0 > 0 && $d >= $startCol0 && $d <= $rightCol0)
                                                @php $pos0 = $d - $startCol0; @endphp
                                                {{ $reachStr0[$pos0] }}
                                            {{-- primera bajada en esta misma fila del cociente --}}
                                            @elseif(($st0['bringDown'] ?? false) && ($st0['nextDigit'] ?? null) !== null && $d == $rightCol0 + 1)
                                                <span style="color:#007; font-weight:bold;">↓{{ $st0['nextDigit'] }}</span>
                                            @endif
                                        @endif
                                    </td>
                                @endfor

                                {{-- Cociente debajo del divisor --}}
                                @for($d=0; $d < strlen($pasosA['cociente']); $d++)
                                    <td style="background:#fff; font-family:monospace; font-size:1.2em; text-align:center; font-weight:bold;">
                                        {{ $pasosA['cociente'][$d] }}
                                    </td>
                                @endfor
                            </tr>

                            {{-- DESARROLLO: pasos 1..n (reach multi-dígito + bajada) --}}
                            @for($s=1; $s < count($pasosA['steps']); $s++)
                                @php $step = $pasosA['steps'][$s]; @endphp
                                <tr>
                                    @for($d=0; $d < $divLenA; $d++)
                                        <td style="background:#fff; font-family:monospace; text-align:center;">
                                            @php
                                                $reachStr = strval($step['reach']);
                                                $reachLen = strlen($reachStr);
                                                $rightCol = intval($step['index']);
                                                $startCol = $rightCol - $reachLen + 1;
                                            @endphp

                                            {{-- reach repartido por celdas --}}
                                            @if($reachLen > 0 && $d >= $startCol && $d <= $rightCol)
                                                @php $pos = $d - $startCol; @endphp
                                                {{ $reachStr[$pos] }}
                                            {{-- bajada (en la MISMA fila, a la derecha del reach) --}}
                                            @elseif(($step['bringDown'] ?? false) && ($step['nextDigit'] ?? null) !== null && $d == $rightCol + 1)
                                                <span style="color:#007; font-weight:bold;">↓{{ $step['nextDigit'] }}</span>
                                            @endif
                                        </td>
                                    @endfor

                                    {{-- relleno bajo el divisor --}}
                                    @for($d=0; $d < strlen($divisorStrA); $d++)
                                        <td style="background:#fff;"></td>
                                    @endfor
                                </tr>
                            @endfor
                        </table>

                        <div style="margin-bottom: 0.5em;">
                            Resto final: <b>{{ $pasosA['residuo'] }}</b>
                        </div>
                    @endif
                </td>

                {{-- ======================= INCISO B ======================= --}}
                @if($ejB && isset($pasosEjercicios[$i+1]) && $pasosEjercicios[$i+1] && isset($pasosEjercicios[$i+1]['steps']) && is_array($pasosEjercicios[$i+1]['steps']))
                    <td style="vertical-align:top; width:2%;"></td>
                    <td style="vertical-align:top; width:49%;">
                        <div class="inciso-label">b)</div>

                        @php
                            $pasosB = $pasosEjercicios[$i+1] ?? null;
                            $divisorStrB = strval($pasosB['divisor']);
                            $divLenB = strlen($pasosB['dividendo']);
                            $st0b = $pasosB['steps'][0] ?? null;
                        @endphp

                        <table class="cuadricula" style="margin-bottom:10px;">
                            {{-- FILA 0 --}}
                            <tr>
                                @for($d=0; $d < $divLenB; $d++)
                                    <td style="font-weight:bold; background:#f2f2f2;">
                                        {{ $pasosB['dividendo'][$d] }}
                                    </td>
                                @endfor

                                @for($d=0; $d < strlen($divisorStrB); $d++)
                                    <td style="background:#f2f2f2; font-weight:bold; border-left:{{ $d==0 ? '2px solid #000' : 'none' }}; border-bottom:2px solid #000;">
                                        {{ $divisorStrB[$d] }}
                                    </td>
                                @endfor
                            </tr>

                            {{-- FILA 1 --}}
                            <tr>
                                @for($d=0; $d < $divLenB; $d++)
                                    <td style="background:#fff; font-family:monospace; text-align:center;">
                                        @if($st0b)
                                            @php
                                                $reachStr0b = strval($st0b['reach']);
                                                $reachLen0b = strlen($reachStr0b);
                                                $rightCol0b = intval($st0b['index']);
                                                $startCol0b = $rightCol0b - $reachLen0b + 1;
                                            @endphp

                                            @if($reachLen0b > 0 && $d >= $startCol0b && $d <= $rightCol0b)
                                                @php $pos0b = $d - $startCol0b; @endphp
                                                {{ $reachStr0b[$pos0b] }}
                                            @elseif(($st0b['bringDown'] ?? false) && ($st0b['nextDigit'] ?? null) !== null && $d == $rightCol0b + 1)
                                                <span style="color:#007; font-weight:bold;">↓{{ $st0b['nextDigit'] }}</span>
                                            @endif
                                        @endif
                                    </td>
                                @endfor

                                {{-- cociente --}}
                                @for($d=0; $d < strlen($pasosB['cociente']); $d++)
                                    <td style="background:#fff; font-family:monospace; font-size:1.2em; text-align:center; font-weight:bold;">
                                        {{ $pasosB['cociente'][$d] }}
                                    </td>
                                @endfor
                            </tr>

                            {{-- Pasos restantes --}}
                            @for($s=1; $s < count($pasosB['steps']); $s++)
                                @php $stepB = $pasosB['steps'][$s]; @endphp
                                <tr>
                                    @for($d=0; $d < $divLenB; $d++)
                                        <td style="background:#fff; font-family:monospace; text-align:center;">
                                            @php
                                                $reachStrB = strval($stepB['reach']);
                                                $reachLenB = strlen($reachStrB);
                                                $rightColB = intval($stepB['index']);
                                                $startColB = $rightColB - $reachLenB + 1;
                                            @endphp

                                            @if($reachLenB > 0 && $d >= $startColB && $d <= $rightColB)
                                                @php $posB = $d - $startColB; @endphp
                                                {{ $reachStrB[$posB] }}
                                            @elseif(($stepB['bringDown'] ?? false) && ($stepB['nextDigit'] ?? null) !== null && $d == $rightColB + 1)
                                                <span style="color:#007; font-weight:bold;">↓{{ $stepB['nextDigit'] }}</span>
                                            @endif
                                        </td>
                                    @endfor

                                    @for($d=0; $d < strlen($divisorStrB); $d++)
                                        <td style="background:#fff;"></td>
                                    @endfor
                                </tr>
                            @endfor
                        </table>

                        <div style="margin-bottom: 0.5em;">
                            Resto final: <b>{{ $pasosB['residuo'] }}</b>
                        </div>
                    </td>
                @endif
            </tr>
        </table>

        <hr style="border: none; border-top: 2px solid #888; margin: 18px 0 0 0;">

        @php $ejercicioNum++; @endphp
    @endfor

    <!-- Pie de página (mantener datos completos, estilo limpio) -->
    <div class="footer-bars">
        <div class="footer-bar-primary"></div>
        <div class="footer-bar-secondary"></div>
    </div>
    <div class="footer-content">
        Verifika · IFE Educabol · WhatsApp +591 75553338 · @ife_educabol · ife.com.bo
    </div>
</body>
</html>
