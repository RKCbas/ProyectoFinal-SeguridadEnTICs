<?php

namespace Tests\Unit;

use App\Http\Controllers\OperationsController;
use PHPUnit\Framework\TestCase;

class McdMcmTest extends TestCase
{
    private OperationsController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new OperationsController;
    }

    // ==================== Pruebas para MCD ====================

    /**
     * Prueba que el MCD de 12 y 18 es 6.
     */
    public function test_mcd_of_12_and_18_returns_6(): void
    {
        $resultado = $this->controller->calcularMCD(12, 18);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('mcd', $resultado);
        $this->assertEquals(6, $resultado['mcd']);
    }

    /**
     * Prueba que el MCD de números coprimos (8, 15) es 1.
     */
    public function test_mcd_of_coprimes_returns_1(): void
    {
        $resultado = $this->controller->calcularMCD(8, 15);

        $this->assertIsArray($resultado);
        $this->assertEquals(1, $resultado['mcd']);
    }

    /**
     * Prueba que el MCD de números iguales (7, 7) es el número mismo.
     */
    public function test_mcd_of_equal_numbers_returns_the_number(): void
    {
        $resultado = $this->controller->calcularMCD(7, 7);

        $this->assertIsArray($resultado);
        $this->assertEquals(7, $resultado['mcd']);
    }

    /**
     * Prueba que el MCD de números negativos funciona correctamente.
     */
    public function test_mcd_with_negative_numbers(): void
    {
        $resultado = $this->controller->calcularMCD(-12, 18);

        $this->assertIsArray($resultado);
        $this->assertEquals(6, $resultado['mcd']);
    }

    /**
     * Prueba que el MCD cuando un número es cero devuelve el otro número.
     */
    public function test_mcd_with_zero(): void
    {
        $resultado = $this->controller->calcularMCD(0, 12);

        $this->assertIsArray($resultado);
        $this->assertEquals(12, $resultado['mcd']);
    }

    /**
     * Prueba que el MCD de (0, 0) retorna error.
     */
    public function test_mcd_of_zero_and_zero_returns_error(): void
    {
        $resultado = $this->controller->calcularMCD(0, 0);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('error', $resultado);
        $this->assertEquals('El MCD no está definido cuando ambos números son cero', $resultado['error']);
    }

    /**
     * Prueba que el MCD de (100, 50) es 50.
     */
    public function test_mcd_of_100_and_50_returns_50(): void
    {
        $resultado = $this->controller->calcularMCD(100, 50);

        $this->assertIsArray($resultado);
        $this->assertEquals(50, $resultado['mcd']);
    }

    // ==================== Pruebas para MCM ====================

    /**
     * Prueba que el MCM de 12 y 18 es 36.
     */
    public function test_mcm_of_12_and_18_returns_36(): void
    {
        $resultado = $this->controller->calcularMCM(12, 18);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('mcm', $resultado);
        $this->assertEquals(36, $resultado['mcm']);
    }

    /**
     * Prueba que el MCM de números coprimos (8, 15) es 120.
     */
    public function test_mcm_of_coprimes_returns_product(): void
    {
        $resultado = $this->controller->calcularMCM(8, 15);

        $this->assertIsArray($resultado);
        $this->assertEquals(120, $resultado['mcm']);
    }

    /**
     * Prueba que el MCM de números iguales (7, 7) es el número mismo.
     */
    public function test_mcm_of_equal_numbers_returns_the_number(): void
    {
        $resultado = $this->controller->calcularMCM(7, 7);

        $this->assertIsArray($resultado);
        $this->assertEquals(7, $resultado['mcm']);
    }

    /**
     * Prueba que el MCM con números negativos funciona correctamente.
     */
    public function test_mcm_with_negative_numbers(): void
    {
        $resultado = $this->controller->calcularMCM(-12, 18);

        $this->assertIsArray($resultado);
        $this->assertEquals(36, $resultado['mcm']);
    }

    /**
     * Prueba que el MCM cuando uno de los números es cero devuelve 0.
     */
    public function test_mcm_with_zero_returns_0(): void
    {
        $resultado = $this->controller->calcularMCM(0, 12);

        $this->assertIsArray($resultado);
        $this->assertEquals(0, $resultado['mcm']);
    }

    /**
     * Prueba que el MCM de (0, 0) retorna error.
     */
    public function test_mcm_of_zero_and_zero_returns_error(): void
    {
        $resultado = $this->controller->calcularMCM(0, 0);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('error', $resultado);
        $this->assertEquals('El MCM no está definido cuando ambos números son cero', $resultado['error']);
    }

    /**
     * Prueba que el MCM de (100, 50) es 100.
     */
    public function test_mcm_of_100_and_50_returns_100(): void
    {
        $resultado = $this->controller->calcularMCM(100, 50);

        $this->assertIsArray($resultado);
        $this->assertEquals(100, $resultado['mcm']);
    }

    // ==================== Pruebas para MCD y MCM combinado ====================

    /**
     * Prueba que calcularMCDyMCM de (12, 18) devuelve mcd=6 y mcm=36.
     */
    public function test_mcd_and_mcm_of_12_and_18(): void
    {
        $resultado = $this->controller->calcularMCDyMCM(12, 18);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('mcd', $resultado);
        $this->assertArrayHasKey('mcm', $resultado);
        $this->assertEquals(6, $resultado['mcd']);
        $this->assertEquals(36, $resultado['mcm']);
    }

    /**
     * Prueba que calcularMCDyMCM de (8, 15) devuelve mcd=1 y mcm=120.
     */
    public function test_mcd_and_mcm_of_coprimes(): void
    {
        $resultado = $this->controller->calcularMCDyMCM(8, 15);

        $this->assertIsArray($resultado);
        $this->assertEquals(1, $resultado['mcd']);
        $this->assertEquals(120, $resultado['mcm']);
    }

    /**
     * Prueba que calcularMCDyMCM retorna error cuando ambos son cero.
     */
    public function test_mcd_and_mcm_of_zero_and_zero_returns_error(): void
    {
        $resultado = $this->controller->calcularMCDyMCM(0, 0);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('error', $resultado);
        $this->assertEquals('MCD y MCM no están definidos cuando ambos números son cero', $resultado['error']);
    }

    /**
     * Prueba que calcularMCDyMCM cuando uno es cero devuelve mcd correcto y mcm=0.
     */
    public function test_mcd_and_mcm_with_zero(): void
    {
        $resultado = $this->controller->calcularMCDyMCM(0, 15);

        $this->assertIsArray($resultado);
        $this->assertEquals(15, $resultado['mcd']);
        $this->assertEquals(0, $resultado['mcm']);
    }

    /**
     * Prueba que el array resultante contiene las claves esperadas.
     */
    public function test_mcd_and_mcm_result_has_required_keys(): void
    {
        $resultado = $this->controller->calcularMCDyMCM(12, 18);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('mcd', $resultado);
        $this->assertArrayHasKey('mcm', $resultado);
        $this->assertArrayHasKey('input_a', $resultado);
        $this->assertArrayHasKey('input_b', $resultado);
    }

    /**
     * Prueba que calcularMCDyMCM con números negativos funciona.
     */
    public function test_mcd_and_mcm_with_negative_numbers(): void
    {
        $resultado = $this->controller->calcularMCDyMCM(-12, -18);

        $this->assertIsArray($resultado);
        $this->assertEquals(6, $resultado['mcd']);
        $this->assertEquals(36, $resultado['mcm']);
    }

    /**
     * Prueba que los valores del MCD y MCM son siempre números enteros.
     */
    public function test_mcd_and_mcm_are_integers(): void
    {
        $resultado = $this->controller->calcularMCDyMCM(12, 18);

        $this->assertIsInt($resultado['mcd']);
        $this->assertIsInt($resultado['mcm']);
    }

    /**
     * Prueba que MCD * MCM = |a * b| (propiedad matemática).
     */
    public function test_mcd_times_mcm_equals_product_of_numbers(): void
    {
        $a = 12;
        $b = 18;
        $resultado = $this->controller->calcularMCDyMCM($a, $b);

        $producto = abs($a * $b);
        $mcdPorMcm = $resultado['mcd'] * $resultado['mcm'];

        $this->assertEquals($producto, $mcdPorMcm);
    }
}
