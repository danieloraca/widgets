<?php
declare(strict_types=1);

namespace App\Project\WidgetBundle\Tests\Utility;

use App\Project\WidgetBundle\Utility\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testCalculatorWhen1(): void
    {
        $expected = [250];
        $calculator = new Calculator();
        $response = $calculator->calculate(1);
        $this->assertEquals($expected, $response);
    }

    public function testCalculatorWhen250(): void
    {
        $expected = [250];
        $calculator = new Calculator();
        $response = $calculator->calculate(250);
        $this->assertEquals($expected, $response);
    }

    public function testCalculatorWhen251(): void
    {
        $expected = [500];
        $calculator = new Calculator();
        $response = $calculator->calculate(251);
        $this->assertEquals($expected, $response);
    }

    public function testCalculatorWhen501(): void
    {
        $expected = [500, 250];
        $calculator = new Calculator();
        $response = $calculator->calculate(501);
        $this->assertEquals($expected, $response);
    }

    public function testCalculatorWhen12001(): void
    {
        $expected = [5000, 5000, 2000, 250];
        $calculator = new Calculator();
        $response = $calculator->calculate(12001);
        $this->assertEquals($expected, $response);
    }
}
