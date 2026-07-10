<?php

namespace Tests\Feature;

use App\Models\Ejercicio;
use App\Models\Operando;
use App\Models\Practico;
use App\Models\User;
use App\Services\DivisionLatinoamericana;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Mpdf\Mpdf;
use Tests\TestCase;

class PdfRenderingTest extends TestCase
{
    use DatabaseTransactions;

    /** @dataProvider pdfCases */
    public function test_pdf_templates_render_valid_documents(string $view, string $operation, string $variant): void
    {
        $practico = $this->makePractico($operation);
        $data = $view === 'practicos.pdfmultiplicacion'
            ? ['practicos' => collect([$practico]), 'tipo' => $variant]
            : ['practico' => $practico, 'tipo' => $variant];

        if ($view === 'practicos.divisionprocedimiento') {
            $data['pasosEjercicios'] = $practico->ejercicios
                ->map(fn (Ejercicio $ejercicio) => DivisionLatinoamericana::resolver(
                    (string) $ejercicio->operandos[0]->valor,
                    (int) $ejercicio->operandos[1]->valor,
                ))
                ->all();
        }

        $html = view($view, $data)->render();

        if ($operation === 'multiplicacion' && $variant === 'propuestos') {
            $this->assertStringNotContainsString('Resultado: 5535', $html);
        }

        if ($operation === 'multiplicacion' && $variant === 'respuestas') {
            $this->assertStringContainsString('Resultado: 5535', $html);
        }

        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
        $mpdf->WriteHTML($html);
        $pdf = $mpdf->Output('', 'S');

        $this->assertStringStartsWith('%PDF-', $pdf);
        $this->assertGreaterThan(10_000, strlen($pdf));
    }

    public static function pdfCases(): array
    {
        return [
            'sumas propuestas' => ['practicos.pdf', 'suma', 'propuestos'],
            'sumas respuestas' => ['practicos.pdf', 'suma', 'respuestas'],
            'sumas ambos' => ['practicos.pdf', 'suma', 'ambos'],
            'restas propuestas' => ['practicos.pdf', 'resta', 'propuestos'],
            'multiplicaciones propuestas' => ['practicos.pdfmultiplicacion', 'multiplicacion', 'propuestos'],
            'multiplicaciones respuestas' => ['practicos.pdfmultiplicacion', 'multiplicacion', 'respuestas'],
            'multiplicaciones con procedimiento' => ['practicos.pdfmultiplicacion', 'multiplicacion', 'ambos'],
            'divisiones propuestas' => ['practicos.divisionpdf', 'division', 'propuestos'],
            'divisiones respuestas' => ['practicos.divisionpdf', 'division', 'respuestas'],
            'divisiones procedimiento' => ['practicos.divisionprocedimiento', 'division', 'procedimiento'],
        ];
    }

    /** @dataProvider controllerCases */
    public function test_controller_selects_the_template_for_each_operation(string $operation, string $filenamePart): void
    {
        $phone = (string) random_int(60000000, 79999999);
        $user = User::create([
            'name' => 'Usuario PDF',
            'phone' => $phone,
            'email' => $phone . '@verifika.ife.com.bo',
            'password' => Hash::make('password'),
        ]);
        $practico = Practico::create([
            'nombre' => ucfirst($operation) . ' PDF',
            'user_id' => $user->id,
        ]);

        $source = $this->makePractico($operation)->ejercicios;
        foreach ($source as $sourceExercise) {
            $exercise = $practico->ejercicios()->create($sourceExercise->only([
                'tipo', 'enunciado', 'respuesta', 'grado', 'cociente', 'resto',
            ]));
            foreach ($sourceExercise->operandos as $operand) {
                $exercise->operandos()->create(['valor' => $operand->valor]);
            }
        }

        $response = $this->actingAs($user)->get(route('practicos.imprimir', [
            'id' => $practico->id,
            'tipo' => 'propuestos',
        ]));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/pdf');
        $this->assertStringContainsString($filenamePart, $response->headers->get('Content-Disposition'));
        $this->assertStringStartsWith('%PDF-', $response->getContent());
    }

    public static function controllerCases(): array
    {
        return [
            'controlador de sumas' => ['suma', '_suma_propuestos.pdf'],
            'controlador de restas' => ['resta', '_resta_propuestos.pdf'],
            'controlador de multiplicaciones' => ['multiplicacion', 'multiplicaciones_'],
            'controlador de divisiones' => ['division', 'division_'],
        ];
    }

    private function makePractico(string $operation): Practico
    {
        $values = match ($operation) {
            'suma' => [[123, 45, 168], [77, 22, 99]],
            'resta' => [[583, 127, 456], [940, 315, 625]],
            'multiplicacion' => [[123, 45, 5535], [67, 8, 536]],
            'division' => [[456, 4, 114], [1002, 9, 111]],
        };

        $practico = new Practico(['nombre' => ucfirst($operation) . ' de prueba']);
        $practico->id = 1;

        $ejercicios = collect($values)->map(function (array $value) use ($operation) {
            $ejercicio = new Ejercicio([
                'tipo' => $operation,
                'enunciado' => 'Ejercicio de prueba',
                'respuesta' => $operation === 'division' ? '' : (string) $value[2],
                'grado' => 'NORMAL',
                'cociente' => $operation === 'division' ? (string) $value[2] : null,
                'resto' => $operation === 'division' ? (string) ($value[0] % $value[1]) : null,
            ]);

            $ejercicio->setRelation('operandos', new Collection([
                new Operando(['valor' => $value[0]]),
                new Operando(['valor' => $value[1]]),
            ]));

            return $ejercicio;
        });

        $practico->setRelation('ejercicios', $ejercicios);

        return $practico;
    }
}
