<?php

namespace Tests\Unit;

use App\Http\Controllers\OperationsController;
use PHPUnit\Framework\TestCase;

class PrimeNumbersTest extends TestCase
{
    /**
     * Prueba que la función genere correctamente los números primos hasta un límite dado.
     */
    public function test_generar_primos_correctamente(): void
    {
        $controller = new OperationsController;

        $result = $controller->generarPrimos(20);

        $this->assertIsArray($result);

        // Primos esperados hasta 20
        $expected = [2, 3, 5, 7, 11, 13, 17, 19];

        $this->assertEquals($expected, $result);
    }

    /**
     * Prueba que devuelva error si el límite es menor que 2.
     */
    public function test_generar_primos_con_limite_invalido(): void
    {
        $controller = new OperationsController;

        $result = $controller->generarPrimos(1);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('error', $result);
        $this->assertEquals('El límite debe ser mayor o igual a 2', $result['error']);
    }

    /**
     * Prueba que genere correctamente un solo número primo cuando el límite es pequeño.
     */
    public function test_generar_primos_hasta_2(): void
    {
        $controller = new OperationsController;

        $result = $controller->generarPrimos(2);

        $this->assertEquals([2], $result);
    }

    /**
     * Prueba que la salida no sea nula y sea consistente.
     */
    public function test_generar_primos_no_retorna_valores_invalidos(): void
    {
        $controller = new OperationsController;

        $result = $controller->generarPrimos(10);

        $this->assertNotNull($result);
        $this->assertContains(7, $result);
        $this->assertNotContains(9, $result); // 9 no es primo
    }
}
