<?php

namespace App\Exercise;

class HappyNumber
{
    private int $number;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function check(): bool
    {
        if ($this->number <= 0) {
            throw new \InvalidArgumentException('Invalid number');
        }
        $slow = $fast = $this->number;
        do {
            $slow = $this->numSquareSum($slow);
            $fast = $this->numSquareSum($this->numSquareSum($fast));
        } while ($slow !== $fast);

        return $slow === 1;
    }

    private function numSquareSum(int $num): int
    {
        $squareSum = 0;
        while ($num) {
            $squareSum += ($num % 10) * ($num % 10);
            $num /= 10;
        }

        return $squareSum;
    }
}
