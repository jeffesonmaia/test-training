<?php

use App\Exercise\WordInNumber;
use PHPUnit\Framework\TestCase;

class WordInNumberTest extends TestCase
{
    public function testShouldConvertAWordInNumber() : void
    {
        $exercise = new WordInNumber('foo');
        $this->assertIsInt($exercise->getNumber());
        $this->assertEquals(36, $exercise->getNumber());
        $this->assertFalse($exercise->isPrimeNumber());
        $this->assertFalse($exercise->isHappyNumber());
        $this->assertTrue($exercise->isMultipleOfThreeAndFive());
    }

    public function testShouldReturnAExceptionWithWrongParam() : void
    {
        $exercise = new WordInNumber('a0 b4');
        $this->assertEquals(3, $exercise->getNumber());
        $this->assertTrue($exercise->isPrimeNumber());
        $this->assertFalse($exercise->isHappyNumber());
        $this->assertTrue($exercise->isMultipleOfThreeAndFive());
    }
}
