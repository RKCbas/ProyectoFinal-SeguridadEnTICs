<?php

namespace Tests\Unit;

use App\Http\Controllers\OperationsController;
use PHPUnit\Framework\TestCase;

class FactorialTest extends TestCase
{
    /**
     * Instancia del controlador para pruebas.
     */
    private OperationsController $controller;

    /**
     * Configuración inicial antes de cada prueba.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new OperationsController;
    }

    /**
     * Prueba que el factorial de 0 es 1.
     */
    public function test_factorial_of_zero_returns_one(): void
    {
        $resultado = $this->controller->calcularFactorial(0);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('result', $resultado);
        $this->assertArrayHasKey('input', $resultado);
        $this->assertEquals(1, $resultado['result']);
        $this->assertEquals(0, $resultado['input']);
    }

    /**
     * Prueba que el factorial de 1 es 1.
     */
    public function test_factorial_of_one_returns_one(): void
    {
        $resultado = $this->controller->calcularFactorial(1);

        $this->assertIsArray($resultado);
        $this->assertEquals(1, $resultado['result']);
        $this->assertEquals(1, $resultado['input']);
    }

    /**
     * Prueba que el factorial de 5 es 120.
     */
    public function test_factorial_of_five_returns_120(): void
    {
        $resultado = $this->controller->calcularFactorial(5);

        $this->assertIsArray($resultado);
        $this->assertEquals(120, $resultado['result']);
        $this->assertEquals(5, $resultado['input']);
    }

    /**
     * Prueba que el factorial de 10 es 3628800.
     */
    public function test_factorial_of_ten_returns_correct_value(): void
    {
        $resultado = $this->controller->calcularFactorial(10);

        $this->assertIsArray($resultado);
        $this->assertEquals(3628800, $resultado['result']);
        $this->assertEquals(10, $resultado['input']);
    }

    /**
     * Prueba que el factorial de 20 es 2432902008176640000.
     */
    public function test_factorial_of_twenty_returns_correct_value(): void
    {
        $resultado = $this->controller->calcularFactorial(20);

        $this->assertIsArray($resultado);
        $this->assertEquals(2432902008176640000, $resultado['result']);
        $this->assertEquals(20, $resultado['input']);
    }

    /**
     * Prueba que números negativos retornan un error.
     */
    public function test_negative_number_returns_error(): void
    {
        $resultado = $this->controller->calcularFactorial(-5);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('error', $resultado);
        $this->assertEquals('El factorial no está definido para números negativos', $resultado['error']);
    }

    /**
     * Prueba que números mayores a 20 retornan un error.
     */
    public function test_number_greater_than_20_returns_error(): void
    {
        $resultado = $this->controller->calcularFactorial(21);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('error', $resultado);
        $this->assertEquals('El número debe ser menor o igual a 20 para evitar desbordamiento', $resultado['error']);
    }

    /**
     * Prueba que números muy grandes retornan un error.
     */
    public function test_very_large_number_returns_error(): void
    {
        $resultado = $this->controller->calcularFactorial(100);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('error', $resultado);
    }

    /**
     * Prueba que el factorial de 2 es 2.
     */
    public function test_factorial_of_two_returns_two(): void
    {
        $resultado = $this->controller->calcularFactorial(2);

        $this->assertIsArray($resultado);
        $this->assertEquals(2, $resultado['result']);
        $this->assertEquals(2, $resultado['input']);
    }

    /**
     * Prueba que el factorial de 3 es 6.
     */
    public function test_factorial_of_three_returns_six(): void
    {
        $resultado = $this->controller->calcularFactorial(3);

        $this->assertIsArray($resultado);
        $this->assertEquals(6, $resultado['result']);
        $this->assertEquals(3, $resultado['input']);
    }

    /**
     * Prueba que el resultado contiene las claves esperadas.
     */
    public function test_result_array_has_required_keys(): void
    {
        $resultado = $this->controller->calcularFactorial(5);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('result', $resultado);
        $this->assertArrayHasKey('input', $resultado);
        $this->assertCount(2, $resultado);
    }

    /**
     * Prueba que el valor del resultado es un entero.
     */
    public function test_result_value_is_integer(): void
    {
        $resultado = $this->controller->calcularFactorial(7);

        $this->assertIsInt($resultado['result']);
    }
}
