<?php

namespace Tests\Unit;

use App\Http\Controllers\OperationsController;
use PHPUnit\Framework\TestCase;

class FibonacciTest extends TestCase
{
    public function test_fibonacci_position_zero(): void
    {
        $controller = new OperationsController;

        $result = $this->invokeMethod($controller, 'fibonacciRecursivo', [0]);

        $this->assertIsArray($result);
        $this->assertEquals([0], $result);
    }

    public function test_fibonacci_position_one(): void
    {
        $controller = new OperationsController;

        $result = $this->invokeMethod($controller, 'fibonacciRecursivo', [1]);

        $this->assertIsArray($result);
        $this->assertEquals([0, 1], $result);
    }

    public function test_fibonacci_position_five(): void
    {
        $controller = new OperationsController;

        $result = $this->invokeMethod($controller, 'fibonacciRecursivo', [5]);

        $this->assertIsArray($result);
        $this->assertEquals([0, 1, 1, 2, 3, 5], $result);
    }

    public function test_fibonacci_position_ten(): void
    {
        $controller = new OperationsController;

        $result = $this->invokeMethod($controller, 'fibonacciRecursivo', [10]);

        $this->assertIsArray($result);
        $this->assertEquals([0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 55], $result);
    }

    public function test_fibonacci_negative_position(): void
    {
        $controller = new OperationsController;

        $result = $this->invokeMethod($controller, 'fibonacciRecursivo', [-1]);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('error', $result);
        $this->assertEquals('Posición fuera de rango permitido', $result['error']);
    }

    public function test_fibonacci_position_exceeds_limit(): void
    {
        $controller = new OperationsController;

        $result = $this->invokeMethod($controller, 'fibonacciRecursivo', [101]);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('error', $result);
        $this->assertEquals('Posición fuera de rango permitido', $result['error']);
    }

    public function test_fibonacci_cache_works(): void
    {
        $controller = new OperationsController;

        // Primera llamada
        $result1 = $this->invokeMethod($controller, 'fibonacciRecursivo', [7]);

        // Segunda llamada (debería usar caché)
        $result2 = $this->invokeMethod($controller, 'fibonacciRecursivo', [7]);

        $this->assertEquals($result1, $result2);
        $this->assertEquals([0, 1, 1, 2, 3, 5, 8, 13], $result2);
    }

    /**
     * Helper method para invocar métodos privados
     */
    protected function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
