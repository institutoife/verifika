<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mpdf\Mpdf;

class FraccionesController extends Controller
{
    public function generarEjercicio(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'denominador' => 'required|integer|min:1',
        ]);

        $denominador = $request->input('denominador');

        // Generar dos numeradores aleatorios
        $numerador1 = rand(1, 10);
        $numerador2 = rand(1, 10);

        // Crear el ejercicio de suma de fracciones
        $fraccion1 = "$numerador1/$denominador";
        $fraccion2 = "$numerador2/$denominador";

        // Calcular el resultado
        $resultado = $this->sumarFracciones($numerador1, $numerador2, $denominador);

        // Retornar la vista con el ejercicio generado
        return view('fracciones.ejercicio', compact('fraccion1', 'fraccion2', 'resultado'));
    }

    private function sumarFracciones($numerador1, $numerador2, $denominador)
    {
        $numeradorResultado = $numerador1 + $numerador2;
        return "$numeradorResultado/$denominador"; // Resultado en forma de fracción
    }
    public function ImprimirFracciones(Request $request)
{
    // Obtener los parámetros de la solicitud
    $unaDificultad = $request->dificultad;
    $unDenominador = $request->denominador;
    $imagenURL = public_path('images/logo-ife-educabol-ofical-instituto-de-formacion-educabol.png');
    $html = '';

    $html .= '<body><div>';
    $html .= '<link rel="stylesheet" href="' . public_path('css/estilosite.css') . '">';
    $encabezado = '<img src="' . $imagenURL . '">';
    $html .= '<div>';

    $resultados = [];

    for ($k = 0; $k < 6; $k++) { 
        $html .= '<p class="text-right">' . ($k + 1) . ').- Una con una línea la respuesta correcta</p>';	
        $html .= '<table class="tabla">';
        $html .= '<tr>';

        for ($i = 0; $i < 2; $i++) { 
            // Generar fracciones
            $numerador = rand(1, 10); // Numerador aleatorio
            $numerador2 = rand(1, 10); // Otro numerador aleatorio
            
            // Crear las fracciones
            $fraccion1 = "$numerador/$unDenominador";
            $fraccion2 = "$numerador2/$unDenominador";
            
            // Calcular el resultado
            $resultado = $this->sumarFracciones($numerador, $numerador2, $unDenominador);
            
            // Agregar la fracción a la tabla
            $html .= '<td class="mediano derecha"> + </td>';
            $html .= '<td class="mediano centrar" colspan="2">';
            $html .= $fraccion1 . "<br>";
            $html .= $fraccion2 . "<br>";
            $resultados[$i] = $resultado; // Guardar el resultado
            $html .= '<hr></td>';
        }

        $html .= '</tr></table><br>';
        $html .= '<div class="respuestasuma"><table class="tabla"><tr>' .
                    '<td class="pequenio">Resultado: ' . $resultados[0] . '</td>' .
                    '<td class="pequenio">Resultado: ' . $resultados[1] . '</td>' .
                    '</tr></table></div>';
    }

    $html .= '</div></body>';
    $mpdf = new Mpdf();
    $mpdf->SetMargins(10, 50, 30);
    $mpdf->SetHeader($encabezado);
    $mpdf->SetFooter('www.ife.com.bo| www.tools.ife.com.bo |IFE Educabol');
    $mpdf->WriteHTML($html);
    
    // Devolver el PDF generado
    return $mpdf->Output("suma_fracciones.pdf", "I");
}
}
