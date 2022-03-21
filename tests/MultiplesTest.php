<?php

use App\Exercise\Multiples;
use PHPUnit\Framework\TestCase;

class MultiplesTest extends TestCase
{
    public function testShouldBeReturnAValidSumOfScenarioOne()
    {
        $rangeStart = 0;
        $rangeEnd = 1000;
        $multipleOne = 3;
        $multipleTwo = 5;
        $expected = 233168;
        $operator = '||';
        $exercise = new Multiples($rangeStart, $rangeEnd, $operator, $multipleOne, $multipleTwo);
        $this->assertInstanceOf(
            Multiples::class,
            $exercise
        );
        $calculation = $exercise->calculate();
        $this->assertIsInt($calculation);
        $this->assertEquals($expected, $calculation);
    }

    public function testShouldBeReturnAValidSumOfScenarioTwo()
    {
        $rangeStart = 0;
        $rangeEnd = 1000;
        $multipleOne = 3;
        $multipleTwo = 5;
        $expected = 33165;
        $operator = '&&';
        $exercise = new Multiples($rangeStart, $rangeEnd, $operator, $multipleOne, $multipleTwo);
        $this->assertInstanceOf(
            Multiples::class,
            $exercise
        );
        $calculation = $exercise->calculate();
        $this->assertIsInt($calculation);
        $this->assertEquals($expected, $calculation);
    }

    public function testShouldBeReturnAValidSumOfScenarioThree()
    {
        $rangeStart = 0;
        $rangeEnd = 1000;
        $multipleOne = 3;
        $multipleTwo = 5;
        $multipleThree = 7;
        $expected = 33173;
        $operator = '&&||';
        $exercise = new Multiples($rangeStart, $rangeEnd, $operator, $multipleOne, $multipleTwo, $multipleThree);
        $this->assertInstanceOf(
            Multiples::class,
            $exercise
        );
        $calculation = $exercise->calculate();
        $this->assertIsInt($calculation);
        $this->assertEquals($expected, $calculation);
    }

    public function testShouldBeReturnAErrorOnInvalidRangeStart()
    {
        $rangeStart = -10;
        $rangeEnd = 50;
        $multipleOne = 3;
        $multipleTwo = 5;
        $operator = '&&';
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('The start value cannot be less than zero');
        new Multiples($rangeStart, $rangeEnd, $operator, $multipleOne, $multipleTwo);
    }

    public function testShouldBeReturnAErrorOnInvalidRangeEnd()
    {
        $rangeStart = 10;
        $rangeEnd = 8;
        $multipleOne = 3;
        $multipleTwo = 5;
        $operator = '&&';
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('The final value must be greater than the initial value');
        new Multiples($rangeStart, $rangeEnd, $operator, $multipleOne, $multipleTwo);
    }

    public function testShouldBeReturnAErrorOnInvalidOperator()
    {
        $rangeStart = 0;
        $rangeEnd = 50;
        $multipleOne = 3;
        $multipleTwo = 5;
        $operator = '&|';
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('Invalid operator');
        new Multiples($rangeStart, $rangeEnd, $operator, $multipleOne, $multipleTwo);
    }
}
