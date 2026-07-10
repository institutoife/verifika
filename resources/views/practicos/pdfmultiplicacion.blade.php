
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Multiplicaciones - {{ ucfirst($tipo ?? 'ambos') }}</title>
    <style>
        @page { margin: 2cm; }
        :root {
            --primary-color: rgb(38,186,165);
            --secondary-color: rgb(55,95,122);
            --text-light: #fff;
        }
        body { font-family: Arial, sans-serif; }
        table.matriz-multi { border-collapse: collapse; margin-bottom: 18px; }
        table.matriz-multi td { border: none; padding: 2px 4px; text-align: right; font-size: 1.1em; }
        .respuesta { color: #26baa5; font-weight: bold; }
        .inciso-label { font-weight: bold; text-align: left; padding-right: 8px; }
        .hr-op { border: none; border-bottom: 2px solid #26baa5; height: 0; margin: 2px 0; }
        .pdf-membrete{
            width: 100%;
            background: #375f7a;
            color: #ffffff;
            border-radius: 1.2em 1.2em 0 0;
            margin: 0 0 6px 0;
            border-spacing: 0;
            border-collapse: collapse;
        }
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
        .pdf-membrete__right{ width: 66px; text-align: right; vertical-align: top; padding: 6px 8px 0 0; font-size: 0; line-height: 0; }
        .pdf-membrete__logo-wrap{ display: inline-block; background:#eef9ff; border:1px solid #cfe8f2; border-radius:50%; width:44px; height:44px; padding:4px; box-sizing:border-box; overflow:hidden; }
        .pdf-membrete__logo{ display:block; margin:0 auto; padding:0; border:0; vertical-align:middle; width:31px; height:31px; }
        .ej-titulo {
            font-size: 1.1em;
            font-weight: bold;
            margin: 18px 0 4px 0;
        }
        .ej-grado {
            font-size: 0.95em;
            color: #888;
            margin-left: 8px;
        }
        .respuesta-resumen { color: #375f7a; font-size: 1.15em; font-weight: bold; padding: 8px 0; }
        .espacio-respuesta { height: 28px; border-bottom: 1px solid #cfd8dc; }
        .footer-pdf { margin-top: 12px; padding-top: 8px; border-top: 2px solid #375f7a; color: #546e7a; font-size: 10px; text-align: center; }
    </style>
</head>
<body>
    <!-- MEMBRETE -->
    <table class="pdf-membrete">
      <tr>
        <td class="pdf-membrete__left">
          <div class="pdf-membrete__title">Multiplicaciones · {{ ucfirst($tipo ?? 'ambos') }}</div>
          <div class="pdf-membrete__info">
            Ningún niño fracasa por falta de capacidad,
            &nbsp; | &nbsp; <span class="pdf-membrete__email"> IFE Educabol · +591 75553338</span>
          </div>
        </td>
                <td class="pdf-membrete__right">
                    <div class="pdf-membrete__logo-wrap">
                        <img class="pdf-membrete__logo" src="{{ public_path('images/logo-ife-educabol-ofical-instituto-de-formacion-educabol.png') }}" alt="Logo de IFE Educabol" width="31" height="31">
                    </div>
                </td>
      </tr>
    </table>








@php $ejercicioNum = 1; @endphp
@foreach($practicos as $practico)
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
                <td style="vertical-align:top; width:49%;">
                @if($ejA && $ejA->tipo === 'multiplicacion' && isset($ejA->operandos[0]) && isset($ejA->operandos[1]) && is_numeric($ejA->operandos[0]->valor) && is_numeric($ejA->operandos[1]->valor))
                    @php
                        $multiplicandoA = $ejA->operandos[0]->valor;
                        $multiplicadorA = $ejA->operandos[1]->valor;
                        $digitosMultiplicadorA = array_reverse(str_split($multiplicadorA));
                        $parcialesA = [];
                        foreach ($digitosMultiplicadorA as $pos => $digito) {
                            $parcial = $multiplicandoA * $digito;
                            $parcialStr = str_pad($parcial, strlen($multiplicandoA), '0', STR_PAD_LEFT) . str_repeat(' ', $pos);
                            $parcialesA[] = $parcialStr;
                        }
                        $maxLenA = max(strlen($multiplicandoA), strlen($multiplicadorA) + count($digitosMultiplicadorA) - 1, strlen((string)$ejA->respuesta), ...array_map('strlen', $parcialesA));
                    @endphp
                    <table class="matriz-multi">
                        <tr>
                            <td class="inciso-label">a)</td>
                            @foreach(str_split(str_pad($multiplicandoA, $maxLenA, ' ', STR_PAD_LEFT)) as $dig)
                                <td>{{ $dig }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="inciso-label">x</td>
                            @foreach(str_split(str_pad($multiplicadorA, $maxLenA, ' ', STR_PAD_LEFT)) as $dig)
                                <td>{{ $dig }}</td>
                            @endforeach
                        </tr>
                        <tr><td colspan="{{ $maxLenA+1 }}"><hr class="hr-op"></td></tr>
                        @if(($tipo ?? 'ambos') === 'propuestos')
                            <tr><td colspan="{{ $maxLenA+1 }}" class="espacio-respuesta">&nbsp;</td></tr>
                        @elseif(($tipo ?? 'ambos') === 'respuestas')
                            <tr><td colspan="{{ $maxLenA+1 }}" class="respuesta-resumen">Resultado: {{ $ejA->respuesta }}</td></tr>
                        @else
                            @foreach($parcialesA as $parcial)
                            <tr>
                                <td class="inciso-label"></td>
                                @foreach(str_split(str_pad($parcial, $maxLenA, ' ', STR_PAD_LEFT)) as $dig)
                                    <td>{{ $dig }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                            <tr><td colspan="{{ $maxLenA+1 }}"><hr class="hr-op"></td></tr>
                            <tr>
                                <td class="inciso-label">=</td>
                                @foreach(str_split(str_pad($ejA->respuesta, $maxLenA, ' ', STR_PAD_LEFT)) as $dig)
                                    <td class="respuesta">{{ $dig }}</td>
                                @endforeach
                            </tr>
                        @endif
                    </table>
                @endif
                </td>
                <td style="vertical-align:top; width:2%;"></td>
                <td style="vertical-align:top; width:49%;">
                @if($ejB && $ejB->tipo === 'multiplicacion' && isset($ejB->operandos[0]) && isset($ejB->operandos[1]) && is_numeric($ejB->operandos[0]->valor) && is_numeric($ejB->operandos[1]->valor))
                    @php
                        $multiplicandoB = $ejB->operandos[0]->valor;
                        $multiplicadorB = $ejB->operandos[1]->valor;
                        $digitosMultiplicadorB = array_reverse(str_split($multiplicadorB));
                        $parcialesB = [];
                        foreach ($digitosMultiplicadorB as $pos => $digito) {
                            $parcial = $multiplicandoB * $digito;
                            $parcialStr = str_pad($parcial, strlen($multiplicandoB), '0', STR_PAD_LEFT) . str_repeat(' ', $pos);
                            $parcialesB[] = $parcialStr;
                        }
                        $maxLenB = max(strlen($multiplicandoB), strlen($multiplicadorB) + count($digitosMultiplicadorB) - 1, strlen((string)$ejB->respuesta), ...array_map('strlen', $parcialesB));
                    @endphp
                    <table class="matriz-multi">
                        <tr>
                            <td class="inciso-label">b)</td>
                            @foreach(str_split(str_pad($multiplicandoB, $maxLenB, ' ', STR_PAD_LEFT)) as $dig)
                                <td>{{ $dig }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="inciso-label">x</td>
                            @foreach(str_split(str_pad($multiplicadorB, $maxLenB, ' ', STR_PAD_LEFT)) as $dig)
                                <td>{{ $dig }}</td>
                            @endforeach
                        </tr>
                        <tr><td colspan="{{ $maxLenB+1 }}"><hr class="hr-op"></td></tr>
                        @if(($tipo ?? 'ambos') === 'propuestos')
                            <tr><td colspan="{{ $maxLenB+1 }}" class="espacio-respuesta">&nbsp;</td></tr>
                        @elseif(($tipo ?? 'ambos') === 'respuestas')
                            <tr><td colspan="{{ $maxLenB+1 }}" class="respuesta-resumen">Resultado: {{ $ejB->respuesta }}</td></tr>
                        @else
                            @foreach($parcialesB as $parcial)
                            <tr>
                                <td class="inciso-label"></td>
                                @foreach(str_split(str_pad($parcial, $maxLenB, ' ', STR_PAD_LEFT)) as $dig)
                                    <td>{{ $dig }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                            <tr><td colspan="{{ $maxLenB+1 }}"><hr class="hr-op"></td></tr>
                            <tr>
                                <td class="inciso-label">=</td>
                                @foreach(str_split(str_pad($ejB->respuesta, $maxLenB, ' ', STR_PAD_LEFT)) as $dig)
                                    <td class="respuesta">{{ $dig }}</td>
                                @endforeach
                            </tr>
                        @endif
                    </table>
                @endif
                </td>
            </tr>
        </table>
        <hr style="border: none; border-top: 2px solid #888; margin: 18px 0 0 0;">
        @php $ejercicioNum++; @endphp
    @endfor
@endforeach

<div class="footer-pdf">Verifika · IFE Educabol · WhatsApp +591 75553338 · ife.com.bo</div>

</body>
</html>
