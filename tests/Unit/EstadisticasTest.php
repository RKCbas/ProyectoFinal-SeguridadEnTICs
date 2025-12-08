<?php

namespace Tests\Unit;

use App\Http\Controllers\OperationsController;
use PHPUnit\Framework\TestCase;

class EstadisticasTest extends TestCase
{
    /**
     * Instancia del controlador para pruebas.
     */
    private OperationsController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new OperationsController;
    }

    public function test_mediana_and_moda_with_odd_count(): void
    {
        $datos = [3, 1, 2, 2, 5];
        $resultado = $this->controller->calcularEstadisticas($datos);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('mediana', $resultado);
        $this->assertArrayHasKey('moda', $resultado);
        $this->assertEquals(2, $resultado['mediana']);
        $this->assertEquals([2], $resultado['moda']);
        $this->assertEquals([1, 2, 2, 3, 5], $resultado['valores']);
    }

    public function test_mediana_with_even_count_returns_float_and_moda_all_when_tie(): void
    {
        $datos = [4, 1, 3, 2];
        $resultado = $this->controller->calcularEstadisticas($datos);

        $this->assertIsArray($resultado);
        $this->assertEquals(2.5, $resultado['mediana']);
        // Cuando todos tienen frecuencia 1, todas son consideradas moda
        $this->assertEquals([1, 2, 3, 4], $resultado['moda']);
        $this->assertEquals([1, 2, 3, 4], $resultado['valores']);
    }

    public function test_multiple_modas_and_median(): void
    {
        $datos = [2, 1, 2, 1, 3];
        $resultado = $this->controller->calcularEstadisticas($datos);

        $this->assertIsArray($resultado);
        // Mediana del array ordenado [1,1,2,2,3] es 2
        $this->assertEquals(2, $resultado['mediana']);
        // Modas esperadas: 1 y 2
        $this->assertEquals([1, 2], $resultado['moda']);
    }

    public function test_empty_array_returns_error(): void
    {
        $resultado = $this->controller->calcularEstadisticas([]);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('error', $resultado);
        $this->assertEquals('El arreglo no puede estar vacío', $resultado['error']);
    }

    public function test_non_numeric_returns_error(): void
    {
        $resultado = $this->controller->calcularEstadisticas([1, 'a', 3]);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('error', $resultado);
        $this->assertEquals('Todos los elementos deben ser números', $resultado['error']);
    }
}
