<?php

use App\Exercise\HappyNumber;
use PHPUnit\Framework\TestCase;

class HappyNumberTest extends TestCase
{
    public function testShouldReturnTrue() : void
    {
        $exercise = new HappyNumber(7);
        $this->assertTrue($exercise->check());
    }

    public function testShouldReturnFalse() : void
    {
        $exercise = new HappyNumber(8);
        $this->assertFalse($exercise->check());
    }

    public function testShouldBeReturnAErrorOnInvalidNumber() : void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('Invalid number');
        $exercise = new HappyNumber(-1);
        $exercise->check();
    }
}
