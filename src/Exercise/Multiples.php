<?php

namespace App\Exercise;

class Multiples
{
    private string $operator;
    private int $rangeStart;
    private int $rangeEnd;
    private int $multipleOne;
    private int $multipleTwo;
    private ?int $multipleThree;

    public function __construct(int $rangeStart, int $rangeEnd, string $operator, int $multipleOne, int $multipleTwo, int $multipleThree = null)
    {
        $this->rangeStart = $rangeStart;
        $this->rangeEnd = $rangeEnd;
        $this->validateRange();
        $this->operator = $operator;
        $this->validateOperators();
        $this->multipleOne = $multipleOne;
        $this->multipleTwo = $multipleTwo;
        $this->multipleThree = $multipleThree;
    }

    public function calculate(): int
    {
        $sum = 0;
        for ($i = $this->rangeStart; $i < $this->rangeEnd; $i++) {
            if ($this->operator === '||') {
                if ($i % $this->multipleOne === 0 || $i % $this->multipleTwo === 0) {
                    $sum += $i;
                }
            }
            if ($this->operator === '&&') {
                if ($i % $this->multipleOne === 0 && $i % $this->multipleTwo === 0) {
                    $sum += $i;
                }
            }
            if ($this->multipleThree !== null && $this->operator === '&&||') {
                if (($i % $this->multipleOne === 0 || $i % $this->multipleTwo === 0) && $i % $this->multipleThree === 0) {
                    $sum += $i;
                }
            }
        }

        return $sum;
    }

    private function validateRange(): void
    {
        if ($this->rangeStart < 0) {
            throw new \InvalidArgumentException('The start value cannot be less than zero');
        }

        if ($this->rangeStart > $this->rangeEnd) {
            throw new \InvalidArgumentException('The final value must be greater than the initial value');
        }
    }

    private function validateOperators(): void
    {
        $validOperators = ['&&', '||', '&&||'];
        if (!in_array($this->operator, $validOperators)) {
            throw new \InvalidArgumentException('Invalid operator');
        }
    }
}
