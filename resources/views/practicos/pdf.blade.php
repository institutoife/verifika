<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Práctico PDF</title>

    <style>
        @page { margin: 2cm; } /* Márgenes de 2cm en PDF */

        :root {
            --primary-color: rgb(38,186,165);
            --secondary-color: rgb(55,95,122);
            --text-light: #fff;
        }

        html, body { margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; }

        /* 🔴 Evitar FLEX en PDF: mejor tabla/bloques */
        .membrete {
            width: 100%;
            margin: 0 0 8px 0;
            background: linear-gradient(90deg, #26baa5, #375f7a);
            color: #ffffff;
            padding: 10px 12px;
            box-sizing: border-box;
        }

        .membrete-table {
            width: 100%;
            border-collapse: collapse;
        }

        .membrete-table td {
            border: none;
            vertical-align: middle;
            padding: 0;
        }

        .membrete-title {
            font-size: 14px;
            font-weight: bold;
            white-space: nowrap;
        }

        .membrete-info {
            font-size: 12px;
            padding-left: 12px;
            white-space: nowrap;
        }

        .membrete-redes {
            text-align: right;
            white-space: nowrap;
        }

        .membrete-redes a {
            text-decoration: none;
            display: inline-block;
            width: 18px;
            height: 18px;
            margin-left: 6px;
            background: #fff;
            border-radius: 50%;
            line-height: 18px;
            text-align: center;
        }

        .membrete-redes svg {
            width: 12px;
            height: 12px;
            vertical-align: middle;
        }

        .membrete-redes .svg-facebook { color: #3b5998; }
        .membrete-redes .svg-instagram { color: #e1306c; }
        .membrete-redes .svg-whatsapp { color: #25d366; }
        .membrete-redes .svg-tiktok { color: #010101; }

        h2 {
            color: #26baa5;
            margin: 6px 0 10px 0;
            font-size: 16px;
        }

        /* ✅ NO uses avoid en todo el ejercicio (causa páginas en blanco) */
        .ejercicio {
            margin: 0 0 14px 0;
            page-break-inside: auto;
        }

        .grado { font-size: 11px; color: #888; }

        .suma-matriz {
            border-collapse: collapse;
            margin: 6px auto;
            page-break-inside: auto;
        }

        .suma-matriz tr { page-break-inside: avoid; } /* ✅ Evitar cortar FILAS */
        .suma-matriz td {
            border: none;
            width: 26px;
            height: 26px;
            text-align: center;
            font-size: 22px;
            padding: 2px 4px;
            background: #fff;
        }

        .suma-matriz .borde-suma { border-bottom: 2px solid rgb(38,186,165) !important; }
        .suma-matriz .signo { 
            font-weight: bold;
            color: rgb(38,186,165);
            font-size: 18px;
         }

        .inciso-label {
            font-weight: bold;
            font-size: 12px;
            text-align: center;
            background: transparent;
        }

        .respuesta {
            color: #375f7a;
            font-weight: bold;
            font-size: 20px;
            text-align: center;
            margin-top: 4px;
        }

        .incisos-col { display: block; }
        .inciso { margin-bottom: 10px; }

        /* Footer normal (sin reglas raras) */
        .footer-pdf {
            width: 100%;
            margin-top: 14px;
            padding: 10px 8px;
            background: linear-gradient(90deg, #375f7a, #26baa5);
            color: #ffffff;
            text-align: center;
            font-size: 12px;
            box-sizing: border-box;
        }

        /* CSS SOLO del membrete (clases nuevas) */
        .pdf-membrete{
            width: 100%;
            background: #375f7a;
            color: #ffffff;
            margin: 0 0 6px 0;
            border-spacing: 0;
            border-collapse: collapse;
        }

        .pdf-membrete__logo-wrap{ display: inline-block; background:#eef9ff; border:1px solid #cfe8f2; border-radius:50%; width:44px; height:44px; padding:4px; box-sizing:border-box; overflow:hidden; }

        .pdf-membrete__row{ }

        .pdf-membrete__left{
        vertical-align: top;
        padding: 8px 10px;
        }

        .pdf-membrete__title{
        font-size: 1.5em;
        font-weight: bold;
        margin: 0;
        padding: 0;
        line-height: 1.1;
        }

        .pdf-membrete__info{
        font-size: 1.05em;
        margin: 4px 0 0 0;
        padding: 0;
        line-height: 1.2;
        }

        .pdf-membrete__email{
        font-size: 0.95em;
        }

        .pdf-membrete__icons{
        margin-top: 6px;
        line-height: 1;
        }

        .pdf-membrete__right{
        width: 80px;
        text-align: right;
        vertical-align: top;
        padding: 6px 8px 0 0; /* baja a 0 si lo quieres más pegado arriba */
        font-size: 0;         /* elimina espacio fantasma */
        line-height: 0;       /* elimina espacio fantasma */
        }

        .pdf-membrete__logo{
        display: block;
        margin: 0;
        padding: 0;
        border: 0;
        vertical-align: top;
        height: 44px;      /* ajusta tamaño */
        width: auto;
        max-width: 80px;
        }

    </style>
</head>

<body>
    {{-- MEMBRETE (UNA SOLA VEZ) --}}
    <table class="pdf-membrete">
  <tr class="pdf-membrete__row">

    <!-- Texto a la izquierda -->
    <td class="pdf-membrete__left">
      <div class="pdf-membrete__title">{{ ucfirst($practico->ejercicios->first()->tipo ?? 'Ejercicios') }} · {{ ucfirst($tipo ?? 'propuestos') }}</div>

      <div class="pdf-membrete__info">
        Ningún niño fracasa por falta de capacidad, 
        &nbsp; | &nbsp; <span class="pdf-membrete__email"> IFE Educabol · +591 75553338</span>
      </div>
    </td>

    <!-- Logo arriba a la derecha (SIN ESPACIOS) -->
        <td class="pdf-membrete__right">
            <div class="pdf-membrete__logo-wrap">
                <img
                    class="pdf-membrete__logo"
                    src="{{ public_path('images/logo-ife-educabol-ofical-instituto-de-formacion-educabol.png') }}"
                    alt="Logo"
                    width="31"
                    height="31"
                >
            </div>
        </td>

  </tr>
  
</table>

    <h2>Práctico: {{ $practico->nombre }}</h2>

    {{-- LOOP PRINCIPAL --}}
    @for($i = 0; $i < count($practico->ejercicios); $i += 2)
        @php
            $ejA = $practico->ejercicios[$i] ?? null;
            $ejB = $practico->ejercicios[$i+1] ?? null;

            $operandosA = $ejA ? $ejA->operandos : [];
            $operandosB = $ejB ? $ejB->operandos : [];

            $respuestaA = $ejA->respuesta ?? '';
            $respuestaB = $ejB->respuesta ?? '';

            $maxDigitosA = 0; $maxDigitosB = 0;
            foreach($operandosA as $op) { $maxDigitosA = max($maxDigitosA, strlen((string)$op->valor)); }
            foreach($operandosB as $op) { $maxDigitosB = max($maxDigitosB, strlen((string)$op->valor)); }
            $maxDigitosA = max($maxDigitosA, strlen((string)$respuestaA));
            $maxDigitosB = max($maxDigitosB, strlen((string)$respuestaB));

            $n = max(count($operandosA), count($operandosB));
            $filaSignoA = intdiv(count($operandosA),2);
            $filaSignoB = intdiv(count($operandosB),2);
            $usarVertical = ($maxDigitosA > 6 || $maxDigitosB > 6);
        @endphp

        <div class="ejercicio">
            <div>
                <strong>Ejercicio {{ intdiv($i,2)+1 }}</strong>
                <span class="grado">[{{ $practico->ejercicios[$i]->grado ?? '' }}]</span>
            </div>

            @if($tipo === 'respuestas')
                <div class="respuesta">a) {{ $respuestaA }} &nbsp;&nbsp; b) {{ $respuestaB }}</div>

            @elseif(!$usarVertical)
                <table class="suma-matriz">
                    <tr>
                        <td colspan="{{ 1 + $maxDigitosA }}" class="inciso-label">a)</td>
                        <td style="width:20px;"></td>
                        <td colspan="{{ 1 + $maxDigitosB }}" class="inciso-label">b)</td>
                    </tr>

                    @for($row = 0; $row < $n; $row++)
                        <tr>
                            {{-- a) --}}
                            @if($row < count($operandosA))
                                <td class="{{ $row == $filaSignoA ? 'signo' : '' }}">
                                    @if($row == $filaSignoA)
                                        @if($ejA && $ejA->tipo === 'multiplicacion')
                                            x
                                        @elseif($ejA && $ejA->tipo === 'resta')
                                            -
                                        @else
                                            +
                                        @endif
                                    @endif
                                </td>
                                @php $digitosA = str_pad($operandosA[$row]->valor, $maxDigitosA, ' ', STR_PAD_LEFT); @endphp
                                @for($d = 0; $d < $maxDigitosA; $d++)
                                    <td @if($row == $n-1) class="borde-suma" @endif>{{ $digitosA[$d] }}</td>
                                @endfor
                            @else
                                @for($d = 0; $d < 1 + $maxDigitosA; $d++) <td></td> @endfor
                            @endif

                            <td></td>

                            {{-- b) --}}
                            @if($row < count($operandosB))
                                <td class="{{ $row == $filaSignoB ? 'signo' : '' }}">
                                    @if($row == $filaSignoB)
                                        @if($ejB && $ejB->tipo === 'multiplicacion')
                                            x
                                        @elseif($ejB && $ejB->tipo === 'resta')
                                            -
                                        @else
                                            +
                                        @endif
                                    @endif
                                </td>
                                @php $digitosB = str_pad($operandosB[$row]->valor, $maxDigitosB, ' ', STR_PAD_LEFT); @endphp
                                @for($d = 0; $d < $maxDigitosB; $d++)
                                    <td @if($row == $n-1) class="borde-suma" @endif>{{ $digitosB[$d] }}</td>
                                @endfor
                            @else
                                @for($d = 0; $d < 1 + $maxDigitosB; $d++) <td></td> @endfor
                            @endif
                        </tr>
                    @endfor

                    @if($tipo === 'ambos')
                        {{-- Mostrar respuestas justo debajo de cada ejercicio, sin filas vacías ni espacios extra --}}
                        <tr>
                            {{-- Respuesta a) debajo del ejercicio a) --}}
                            <td></td>
                            @php $resA = str_pad($respuestaA, $maxDigitosA, ' ', STR_PAD_LEFT); @endphp
                            @for($d = 0; $d < $maxDigitosA; $d++) <td class="respuesta">{{ $resA[$d] }}</td> @endfor
                            <td></td>
                            {{-- Respuesta b) debajo del ejercicio b) --}}
                            <td></td>
                            @php $resB = str_pad($respuestaB, $maxDigitosB, ' ', STR_PAD_LEFT); @endphp
                            @for($d = 0; $d < $maxDigitosB; $d++) <td class="respuesta">{{ $resB[$d] }}</td> @endfor
                        </tr>
                    @endif
                </table>

            @else
                <div class="incisos-col">
                    @foreach([
                        ['inciso'=>'a','ej'=>$ejA,'maxDigitos'=>$maxDigitosA],
                        ['inciso'=>'b','ej'=>$ejB,'maxDigitos'=>$maxDigitosB]
                    ] as $data)

                        @php
                            $inciso = $data['inciso'];
                            $ej = $data['ej'];
                            $operandos = $ej ? $ej->operandos : [];
                            $respuesta = $ej->respuesta ?? '';
                            $maxDigitos = max($data['maxDigitos'], strlen((string)$respuesta));
                            $nLocal = count($operandos);
                            $filaSigno = intdiv($nLocal, 2);
                        @endphp

                        <div class="inciso">
                            @if($tipo === 'respuestas')
                                @if($ej && $ej->tipo === 'division')
                                    <div class="respuesta">{{ $inciso }}) Cociente: {{ $ej->cociente }}, Resto: {{ $ej->resto }}</div>
                                @else
                                    <div class="respuesta">{{ $inciso }}) {{ $respuesta }}</div>
                                @endif
                            @else
                                <span class="inciso-label">{{ $inciso }})</span>
                                <table class="suma-matriz">
                                    @foreach($operandos as $j => $op)
                                        <tr>
                                            <td class="{{ $j == $filaSigno ? 'signo' : '' }}">
                                                @if($j == $filaSigno)
                                                    @if($ej && $ej->tipo === 'multiplicacion')
                                                        x
                                                    @elseif($ej && $ej->tipo === 'resta')
                                                        -
                                                    @else
                                                        +
                                                    @endif
                                                @endif
                                            </td>
                                            @php $digitos = str_pad($op->valor, $maxDigitos, ' ', STR_PAD_LEFT); @endphp
                                            @for($d = 0; $d < $maxDigitos; $d++)
                                                <td @if($j == $nLocal-1) class="borde-suma" @endif>{{ $digitos[$d] }}</td>
                                            @endfor
                                        </tr>
                                    @endforeach

                                    @if($tipo === 'ambos')
                                        <tr>
                                            <td></td>
                                            @php $res = str_pad($respuesta, $maxDigitos, ' ', STR_PAD_LEFT); @endphp
                                            @for($d = 0; $d < $maxDigitos; $d++)
                                                <td class="respuesta">{{ $res[$d] }}</td>
                                            @endfor
                                        </tr>
                                    @endif
                                </table>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endfor

    <div class="footer-pdf">
        Verifika · IFE Educabol · WhatsApp +591 75553338 · @ife_educabol · ife.com.bo
    </div>

</body>
</html>
