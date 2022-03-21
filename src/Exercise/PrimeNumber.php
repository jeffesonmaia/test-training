<?php

namespace App\Exercise;

class PrimeNumber
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
        if ($this->number <= 1) {
            return false;
        }
        for ($i = 2; $i <= $this->number / 2; $i++) {
            if ($this->number % $i === 0) {
                return false;
            }
        }

        return true;
    }
}
