<?php

namespace App\Exercise;

class WordInNumber
{
    private string $word;
    private int $number = 0;

    public function __construct(string $word)
    {
        $this->word = $word;
        $this->setNumber();
    }

    public function setNumber(): void
    {
        $firstRange = range('a', 'z');
        $secondRange = range('A', 'Z');
        $letters = array_merge($firstRange, $secondRange);
        $numbers = array_flip($letters);
        $sum = 0;
        for ($i = 0; $i < strlen($this->word); $i++) {
            $letter = $this->word[$i];
            if (!isset($numbers[$letter])) {
                continue;
            }
            $sum += $numbers[$letter] + 1;
        }

        $this->number = $sum;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function isPrimeNumber(): bool
    {
        $primeNumber = new PrimeNumber($this->number);

        return $primeNumber->check();
    }

    public function isHappyNumber(): bool
    {
        $happyNumber = new HappyNumber($this->number);

        return $happyNumber->check();
    }

    public function isMultipleOfThreeAndFive(): bool
    {
        return ($this->number % 3 === 0) || ($this->number % 5 === 0);
    }
}
