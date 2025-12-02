<?php

namespace App\Http\Controllers;

class OperationsController extends Controller
{
    /**
     * Límite máximo de posición en la serie Fibonacci
     */
    private const MAX_FIBONACCI_POSITION = 100;

    /**
     * Caché para almacenar valores ya calculados
     */
    private static array $fibonacciCache = [];

    public function addition(int $a, int $b): int
    {
        return $a + $b;
    }

    private function fibonacciRecursivo(int $position): array
    {
        // Validar que la posición esté dentro del límite permitido
        if ($position < 0 || $position > self::MAX_FIBONACCI_POSITION) {
            return ['error' => 'Posición fuera de rango permitido'];
        }

        // Casos base
        if ($position === 0) {
            return [0];
        }
        if ($position === 1) {
            return [0, 1];
        }

        // Verificar si ya está en caché
        if (isset(self::$fibonacciCache[$position])) {
            return self::$fibonacciCache[$position];
        }

        // Obtener la serie anterior recursivamente
        $previousSeries = $this->fibonacciRecursivo($position - 1);

        // Calcular el siguiente número de Fibonacci
        $count = count($previousSeries);
        $nextNumber = $previousSeries[$count - 1] + $previousSeries[$count - 2];

        // Agregar el nuevo número a la serie
        $previousSeries[] = $nextNumber;

        // Guardar en caché
        self::$fibonacciCache[$position] = $previousSeries;

        return $previousSeries;
    }
}
