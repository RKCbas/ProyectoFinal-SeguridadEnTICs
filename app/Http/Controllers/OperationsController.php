<?php

namespace App\Http\Controllers;

class OperationsController extends Controller
{
    /**
     * Límite máximo de posición en la serie Fibonacci.
     */
    private const MAX_FIBONACCI_POSITION = 100;

    /**
     * Caché para almacenar valores ya calculados.
     *
     * @var array<int, int[]>
     */
    private static array $fibonacciCache = [];

    /**
     * Suma de dos números enteros.
     */
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

    /**
     * Genera todos los números primos hasta un límite dado
     * usando la Criba de Eratóstenes.
     *
     * @return array{error: string}|int[]
     */
    public function generarPrimos(int $limite): array
    {
        if ($limite < 2) {
            return ['error' => 'El límite debe ser mayor o igual a 2'];
        }

        // Inicializa array: true = posible primo
        $esPrimo = array_fill(0, $limite + 1, true);
        $esPrimo[0] = $esPrimo[1] = false;

        for ($i = 2; $i * $i <= $limite; $i++) {
            if ($esPrimo[$i]) {
                // Marcar múltiplos como no primos
                for ($j = $i * $i; $j <= $limite; $j += $i) {
                    $esPrimo[$j] = false;
                }
            }
        }

        // Construir lista de números primos
        $primos = [];
        for ($i = 2; $i <= $limite; $i++) {
            if ($esPrimo[$i]) {
                $primos[] = $i;
            }
        }

        return $primos;
    }

    /**
     * Calcula el factorial de un número con validaciones de seguridad.
     *
     * @param  int  $numero  El número para calcular el factorial
     * @return array{result: int, input: int}|array{error: string}
     */
    public function calcularFactorial(int $numero): array
    {
        // Validar que el número sea no negativo
        if ($numero < 0) {
            return ['error' => 'El factorial no está definido para números negativos'];
        }

        // Validar límite máximo para evitar desbordamiento
        if ($numero > 20) {
            return ['error' => 'El número debe ser menor o igual a 20 para evitar desbordamiento'];
        }

        // Casos base
        if ($numero === 0 || $numero === 1) {
            return ['result' => 1, 'input' => $numero];
        }

        // Calcular factorial iterativamente
        $resultado = 1;
        for ($i = 2; $i <= $numero; $i++) {
            $resultado *= $i;
        }

        return ['result' => $resultado, 'input' => $numero];
    }
}
