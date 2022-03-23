<?php

use App\Exercise\PrimeNumber;
use PHPUnit\Framework\TestCase;

class PrimeNumberTest extends TestCase
{
    public function testShouldReturnTrue() : void
    {
        $number = new PrimeNumber(2);
        $this->assertTrue($number->check());
    }

    public function testShouldReturnFalse() : void
    {
        $number = new PrimeNumber(10);
        $this->assertFalse($number->check());
    }

    public function testShouldBeReturnAErrorOnInvalidNumber() : void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('Invalid number');
        $exercise = new PrimeNumber(-1);
        $exercise->check();
    }
}
