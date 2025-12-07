<?php

namespace Tests\Unit;

use App\Http\Controllers\OperationsController;
use PHPUnit\Framework\TestCase;

class DuplicatedTest extends TestCase
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
     * Prueba que encuentra duplicados y elementos no repetidos correctamente.
     */
    public function test_encuentra_duplicados_y_no_repetidos(): void
    {
        $numeros = [1, 2, 2, 3, 3, 3, 4];
        $resultado = $this->controller->encontrarDuplicados($numeros);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('duplicados', $resultado);
        $this->assertArrayHasKey('noRepetidos', $resultado);
        $this->assertEquals([2 => 2, 3 => 3], $resultado['duplicados']);
        $this->assertEquals([1, 4], $resultado['noRepetidos']);
    }

    /**
     * Prueba que un arreglo vacío retorna un error.
     */
    public function test_arreglo_vacio_retorna_error(): void
    {
        $resultado = $this->controller->encontrarDuplicados([]);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('error', $resultado);
        $this->assertEquals('El arreglo no puede estar vacío', $resultado['error']);
    }

    /**
     * Prueba que un arreglo sin duplicados retorna solo noRepetidos.
     */
    public function test_arreglo_sin_duplicados(): void
    {
        $numeros = [1, 2, 3, 4];
        $resultado = $this->controller->encontrarDuplicados($numeros);

        $this->assertIsArray($resultado);
        $this->assertEmpty($resultado['duplicados']);
        $this->assertEquals([1, 2, 3, 4], $resultado['noRepetidos']);
    }

    /**
     * Prueba que un arreglo con todos elementos duplicados.
     */
    public function test_arreglo_con_todos_duplicados(): void
    {
        $numeros = [1, 1, 2, 2, 3, 3];
        $resultado = $this->controller->encontrarDuplicados($numeros);

        $this->assertIsArray($resultado);
        $this->assertEquals([1 => 2, 2 => 2, 3 => 2], $resultado['duplicados']);
        $this->assertEmpty($resultado['noRepetidos']);
    }

    /**
     * Prueba que un arreglo con un solo elemento.
     */
    public function test_arreglo_con_un_solo_elemento(): void
    {
        $numeros = [5];
        $resultado = $this->controller->encontrarDuplicados($numeros);

        $this->assertIsArray($resultado);
        $this->assertEmpty($resultado['duplicados']);
        $this->assertEquals([5], $resultado['noRepetidos']);
    }

    /**
     * Prueba que el resultado contiene las claves esperadas.
     */
    public function test_resultado_tiene_claves_esperadas(): void
    {
        $numeros = [1, 2, 2];
        $resultado = $this->controller->encontrarDuplicados($numeros);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('duplicados', $resultado);
        $this->assertArrayHasKey('noRepetidos', $resultado);
        $this->assertCount(2, $resultado);
    }
}
