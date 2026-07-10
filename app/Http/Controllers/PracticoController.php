<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Practico;

use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use App\Services\DivisionLatinoamericana;

class PracticoController extends Controller
   
{
    public function index()
    {
        $user = Auth::user();
        $practicos = Practico::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('practicos.index', compact('practicos'));
    }

     public function edit($id)
    {
        $practico = Practico::findOrFail($id);
        return view('practicos.edit', compact('practico'));
    }

    public function update(Request $request, $id)
    {
        $practico = Practico::findOrFail($id);
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
        $practico->nombre = $request->nombre;
        // No actualizar la fecha de creación
        $practico->save();
        return redirect()->route('practicos.index')->with('success', 'Práctico actualizado correctamente.');
    }
    
    public function ejercicios($id)
    {
        $practico = Practico::with('ejercicios.operandos')->findOrFail($id);
        return view('practicos.ejercicios', compact('practico'));
    }

    public function imprimir($id, $tipo = 'propuestos')
    {
        $practico = Practico::with('ejercicios.operandos')->findOrFail($id);

        $primerEjercicio = $practico->ejercicios->first();
        abort_if(!$primerEjercicio, 404, 'El práctico no contiene ejercicios para imprimir.');

        $operacion = $primerEjercicio->tipo;
        $variante = match ($tipo) {
            'multiplicacion' => 'ambos',
            'division' => 'propuestos',
            default => $tipo,
        };

        abort_unless(in_array($variante, ['propuestos', 'respuestas', 'ambos'], true), 404);

        if ($operacion === 'division') {
            return $this->pdfResponse(
                'practicos.divisionpdf',
                compact('practico') + ['tipo' => $variante],
                "division_{$practico->id}_{$variante}.pdf",
                'Divisiones - ' . ucfirst($variante),
            );
        }

        if ($operacion === 'multiplicacion') {
            $practicos = collect([$practico]);

            return $this->pdfResponse(
                'practicos.pdfmultiplicacion',
                compact('practicos') + ['tipo' => $variante],
                "multiplicaciones_{$practico->id}_{$variante}.pdf",
                'Multiplicaciones - ' . ucfirst($variante),
            );
        }

        return $this->pdfResponse(
            'practicos.pdf',
            compact('practico') + ['tipo' => $variante],
            "practico_{$practico->id}_{$operacion}_{$variante}.pdf",
            ucfirst($operacion) . ' - ' . ucfirst($variante),
        );
    }
     /**
     * Genera el PDF de división con desarrollo paso a paso (formato latinoamericano).
     */
    public function imprimirDivisionProcedimiento($id)
    {
        $practico = Practico::with('ejercicios.operandos')->findOrFail($id);
        $esDivision = $practico->ejercicios->first() && $practico->ejercicios->first()->tipo === 'division';
        if (!$esDivision) {
            abort(404, 'Este práctico no es de división.');
        }
        $pasosEjercicios = [];
        foreach ($practico->ejercicios as $ej) {
            if ($ej->tipo === 'division' && isset($ej->operandos[0]) && isset($ej->operandos[1])) {
                $dividendo = (string)$ej->operandos[0]->valor;
                $divisor = (int)$ej->operandos[1]->valor;
                $pasosEjercicios[] = DivisionLatinoamericana::resolver($dividendo, $divisor);
            } else {
                $pasosEjercicios[] = null;
            }
        }
        // Si se pasa ?debug=1 en la URL, mostrar el JSON en vez del PDF
        if (request()->has('debug')) {
            return response()->json($pasosEjercicios);
        }
        return $this->pdfResponse(
            'practicos.divisionprocedimiento',
            compact('practico', 'pasosEjercicios'),
            'division_procedimiento_' . $practico->id . '.pdf',
            'División con procedimiento',
        );
    }
    
    public function destroy($id)
    {
        $practico = Practico::findOrFail($id);
        $practico->delete();
        return redirect()->route('practicos.index')->with('success', 'Práctico eliminado correctamente.');
    }

    private function pdfResponse(string $view, array $data, string $filename, string $title)
    {
        try {
            $tempDir = storage_path('app/mpdf');
            File::ensureDirectoryExists($tempDir);

            $html = view($view, $data)->render();
            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                'tempDir' => $tempDir,
                'margin_left' => 16,
                'margin_right' => 16,
                'margin_top' => 16,
                'margin_bottom' => 16,
            ]);
            $mpdf->SetTitle($title . ' | Verifika');
            $mpdf->SetAuthor('IFE Educabol');
            $mpdf->SetCreator('Verifika');
            $mpdf->WriteHTML($html);

            return response($mpdf->Output('', Destination::STRING_RETURN), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $filename . '"',
                'Cache-Control' => 'private, no-store, max-age=0',
                'X-Content-Type-Options' => 'nosniff',
            ]);
        } catch (\Throwable $exception) {
            report($exception);
            abort(500, 'No se pudo generar el PDF. Inténtalo nuevamente.');
        }
    }
}
