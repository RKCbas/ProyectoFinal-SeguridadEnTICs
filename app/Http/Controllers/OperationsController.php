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
     *
     * @var array<int, int[]>
     */
    private static array $fibonacciCache = [];

    public function addition(int $a, int $b): int
    {
        return $a + $b;
    }

    /**
     * Calcula la serie Fibonacci hasta una posición.
     *
     * @return array{error: string}|int[]
     */
    public function fibonacciRecursivo(int $position): array
    {
        if ($position < 0 || $position > self::MAX_FIBONACCI_POSITION) {
            return ['error' => 'Posición fuera de rango permitido'];
        }

        if ($position === 0) {
            return [0];
        }
        if ($position === 1) {
            return [0, 1];
        }

        if (isset(self::$fibonacciCache[$position])) {
            return self::$fibonacciCache[$position];
        }

        $previousSeries = $this->fibonacciRecursivo($position - 1);

        if (isset($previousSeries['error'])) {
            return $previousSeries;
        }

        $count = count($previousSeries);
        $nextNumber = $previousSeries[$count - 1] + $previousSeries[$count - 2];

        $previousSeries[] = $nextNumber;

        self::$fibonacciCache[$position] = $previousSeries;

        return $previousSeries;
    }
}
